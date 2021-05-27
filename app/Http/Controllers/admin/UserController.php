<?php

/*
|--------------------------------------------------------------------------
| Author: Anthony Garcia Moncada
| Email:  agarciam@eafit.edu.co
|--------------------------------------------------------------------------
*/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function show($id)
    {
        try {
            $data = []; //to be sent to the view
            $user = User::findOrFail($id);

            $breadlist = array();
            $breadlist[0] = array('Home', "user.petItem.list", null, "0");
            $breadlist[1] = array('List Users', "admin.user.list", null, "0");
            $breadlist[2] = array($user->getUsername(), "admin.user.show", ['id' => $id], "1");
            $data["breadlist"] = $breadlist;
            $data["title"] = $user->getUsername();
            $data["user"] = $user;
            return view('admin.user.show')->with("data", $data);
        } catch (\Throwable $th) {
            return redirect()->route('admin.user.list')->with('danger', 'User Id not found!');
        }
    }

    public function list()
    {
        try {

            $data = []; //to be sent to the view
            $breadlist = array();
            $breadlist[0] = array('Home', "user.petItem.list", null, "0");
            $breadlist[1] = array('List Users', "admin.user.list", null, "1");
            $data["breadlist"] = $breadlist;

            $data["title"] = "List users";
            $data["users"] = User::all()->sortBy('id');

            return view('admin.user.list')->with("data", $data);
        } catch (\Throwable $th) {
            return view('admin.user.list')->with('danger', "Couldn't get the list!");
        }
    }

    public function create()
    {
        $data = []; //to be sent to the view

        $breadlist = array();
        $breadlist[0] = array('Home', "user.petItem.list", null, "0");
        $breadlist[1] = array('Create User', "admin.user.create", null, "1");
        $data["breadlist"] = $breadlist;

        $data["title"] = "Create user";

        return view('admin.user.create')->with("data", $data);
    }

    public function save(Request $request)
    {
        try {
            User::validate($request);
            User::create(
                [
                'username' => $request['username'],
                'type' => $request['type'],
                'firstName' => $request['firstName'],
                'lastName' => $request['lastName'],
                'email' => $request['email'],
                'password' => Hash::make($request['password'])
                ]
            );
            return back()->with('success', 'User created successfully!');
        } catch (\Throwable $th) {
            return back()->with('danger', 'User was not created!');
        }
    }

    public function delete($id)
    {
        try {
            User::destroy($id);
            return redirect()->route('user.list')->with('success', 'User deleted succesfully!');
        } catch (\Throwable $th) {
            return back()->with('danger', 'User Id not found!');
        }
    }
}

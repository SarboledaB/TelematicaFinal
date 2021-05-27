<?php

/*
|--------------------------------------------------------------------------
| Author: Anthony Garcia Moncada
| Email:  agarciam@eafit.edu.co
|--------------------------------------------------------------------------
*/

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function register()
    {
        $data = []; //to be sent to the view
        $data["title"] = "Create user";

        $breadlist = array();
        $breadlist[0] = array('Home', "user.petItem.list", null, "0");
        $breadlist[1] = array('Register', "user.register", null, "1"); 
        $data["breadlist"] = $breadlist;

        return view('auth.register')->with("data", $data);
    }

    public function save(Request $request)
    {
            User::validate($request);
            
            User::create([
                'username' => $request['username'], 
                'firstName' => $request['firstName'],
                'lastName' => $request['lastName'],
                'email' => $request['email'],
                'password' => Hash::make($request['password'])
            ]);
            return redirect()->route('login')->with('success', 'User created successfully!');
    }
}

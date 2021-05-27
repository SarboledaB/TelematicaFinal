<?php

/** 
|--------------------------------------------------------------------------
| Author: Manuela Zapata Giraldo
| Email:  mzapatag1@eafit.edu.co
|--------------------------------------------------------------------------
**/

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Foundation;
use App\Models\Donation;

class FoundationController extends Controller
{
    public function list()
    {
        
        $data = []; //to be sent to the view
        $breadlist = array();
        $breadlist[0] = array('Home', "user.petItem.list", null, "0");
        $breadlist[1] = array('Foundations', "user.foundations.list", null, "1");
        $data["breadlist"] = $breadlist;
        try{

            $data["foundations"] = Foundation::all();
            return view('user.foundations.list')->with("data", $data);
            
        } catch (\Throwable $th){
            return view('user.foundations.list')->with('danger', "Couldn't get the list!");
        }
        
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        $breadlist = array();
        $breadlist[0] = array('Home', "user.petItem.list", null, "0");
        $breadlist[1] = array('Foundations', "user.foundations.list", null, "0");        
        $foundation = Foundation::findOrFail($id);
        $breadlist[2] = array($foundation->getName(), "user.foundations.show", ['id'=>$id], "1");
        $data["breadlist"] = $breadlist;
        $data["foundation"] = $foundation;
        return view('user.foundations.show')->with("data", $data);
    }

}
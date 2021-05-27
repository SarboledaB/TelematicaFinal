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
use App\Models\Donation;
use App\Models\Foundation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DonationController extends Controller
{
    public function create($foundationId) //pase el id del foundation para cuando cree la donation mandar a db el id del foundation
    {
        $foundation = Foundation::findOrFail($foundationId);
        $data = [];
        $breadlist = array();
        $breadlist[0] = array('Home', "user.petItem.list", null, "0");
        $breadlist[1] = array('Foundations', "user.foundations.list", null, "0");
        $breadlist[2] = array($foundation->getName(), "user.foundations.show", ['id'=>$foundationId], "0");
        $breadlist[3] = array('Donate', "user.donations.create", null, "1");
        $data["breadlist"] = $breadlist;

        $data["title"] = "Donar";
        $data["foundationId"] = $foundationId;
        $data["userId"] = Auth::id();
        return view('user.donations.create')->with("data", $data);
    }


    public function save(Request $request)
    {   
 
        try{
            Donation::validate($request);
            $donation = new Donation();
            $donation->setPayment($request->input('payment'));
            $donation->setValue($request->input('value'));
            $donation->setFoundationId($request->input('foundation_id'));
            $donation->setUserId($request->input('user_id'));
            $donation->save();
            return back()->with('success', __('donation.ty_donating'));
            
        } catch(\Throwable $th){
            return back()->with('danger', 'Error, could not donate!');
        }
        
    }

    public function list()
    {
        $data = [];
        $breadlist = array();
        $breadlist[0] = array('Home', "user.petItem.list", null, "0");
        $breadlist[1] = array('Profile', "user.profile.show", null, "0");
        $breadlist[2] = array('My Donations', "user.donations.list", null, "1");
        $data["breadlist"] = $breadlist;

        try {
            $id = Auth::id();
            $data["title"] = "My donations";
            $data["donations"] = Donation::all()->where('user_id', $id);

            return view('user.donations.list')->with("data", $data);
        } catch (\Throwable $th) {
            return view('user.donations.list')->with('danger', "Couldn't get the list!");
        }
    }


}
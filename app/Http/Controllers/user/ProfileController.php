<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $data = []; //to be sent to the view
        $breadlist = array();
        $breadlist[0] = array('Home', "user.petItem.list", null, "0");
        $breadlist[1] = array('Profile', "user.profile.show", null, "1");
        $data["breadlist"] = $breadlist;
        $user = User::with(['orders' => function ($query) {
        }])
            ->where('id', Auth::id())
            ->first();
        $data["title"] = $user->getUsername();
        $data["user"] = $user;

        return view('user.profile.show')->with("data", $data);
    }
}

<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\PetItem;

class PetItemController extends Controller
{
    public function list()
    {
        $data = []; //to be sent to the view
        $breadlist = array();
        $breadlist[0] = array('Home', "user.petItem.list", null, "1");
        $data["title"] = "Products";
        $data["categories"] = Category::with('pet_items')->get();
        $data["breadlist"] = $breadlist;
        // dd($data);
        return view('user.petItem.list')->with("data", $data);     
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        $breadlist = array();
        
        try {
            $breadlist[0] = array('Home', "user.petItem.list", null, "0");
            $petItem = PetItem::findOrFail($id);
            $breadlist[1] = array($petItem->getName(), "user.petItem.show", ['id'=>$id], "1");
            $data["breadlist"] = $breadlist;
            //$petItem = PetItem::findOrFail($id);
            $data["title"] = $petItem->getName();
            $data["petItem"] = $petItem;
            //dd($data["petItem"]);
            return view('user.petItem.show')->with("data", $data);
        } catch (\Throwable $th) {
            return back()->with('danger', 'Pet Item not found!');
            // __('general.PI_not_found')
        }
    }
}

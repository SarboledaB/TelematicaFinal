<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecipesController extends Controller
{
    public function list()
    {
        $response = Http::get('http://fteam.tk/api/foodAvailable');
        $data = []; //to be sent to the view
        $data["title"] = "Recipes";
        $data["recipes"] = $response->json();
        /* dd($data["recipes"]); */
        return view('user.recipes.list')->with("data", $data);
    }
}

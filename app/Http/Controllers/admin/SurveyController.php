<?php
/*
|--------------------------------------------------------------------------
| Author: Sebastian Arboleda Botero
| Email:  sarboledab@eafit.edu.co
|--------------------------------------------------------------------------
*/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Interfaces\ImageStorage;
use Illuminate\Support\Facades\URL;

class SurveyController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }


    public function create()
    {
        $data = []; //to be sent to the view

        $data["title"] = "Create product";
        $data["categories"] = $data["petItems"] = [];
        return view('admin.survey.create')->with("data", $data);
    }

    public function save(Request $request)
    {
        /* try { */
        Survey::validate($request);
        $storeInterface = app(ImageStorage::class);
        $storeInterface->store($request);
        $name = $request->file('image')->getClientOriginalName();
        $path = URL::asset('storage/' . $name);
        Survey::create(["name" => strtoupper($request->name), "details" => $request->details, "category_id" => $request->category_id, "value" => $request->value, "rating" => $request->rating, "image" => $path]);
        return back()->with('success', 'Pet Item created successfully!');
        /* } catch (\Throwable $th) {
            return back()->with('danger', 'Pet Item was not create!');
        } */
    }
}

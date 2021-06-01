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
use Illuminate\Support\Facades\Auth;

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
        return view('admin.survey.create')->with("data", $data);
    }

    public function save(Request $request)
    {
        /* try { */
        Survey::validate($request);
        Survey::create(["name" => strtoupper($request->name), "career" => $request->career, "commune" => $request->commune, "user_id" => Auth::id()]);
        return back()->with('success', 'Se ha guardado la encuesta!');
        /* } catch (\Throwable $th) {
            return back()->with('danger', 'Pet Item was not create!');
        } */
    }
}

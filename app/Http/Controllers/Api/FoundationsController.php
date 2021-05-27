<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\FoundationsResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Foundation;

class FoundationsController extends Controller
{
    public function list()
    {
        $data = FoundationsResource::collection(Foundation::all());
        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }
}

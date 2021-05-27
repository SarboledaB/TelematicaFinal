<?php

namespace App\Util;

use App\Interfaces\ImageStorage;
use Illuminate\Support\Facades\Storage;

class ImageLocalStorage implements ImageStorage
{

    public function store($request)
    {   
        if ($request->hasFile('image')) {
            Storage::disk('public')->put($request->file('image')->getClientOriginalName(), file_get_contents($request->file('image')->getRealPath()));
        }
    }
}

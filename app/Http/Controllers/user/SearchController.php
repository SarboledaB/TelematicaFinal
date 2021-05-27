<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PetItem;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $search = strtoupper($request->search); //to be sent to the view
            $petItem = PetItem::where(
                [
                    ['name', '=', $search]
                ]
            )
                ->first();
            $data["title"] = $petItem->getName();
            $data["petItem"] = $petItem;
            return redirect()->route('user.petItem.show', ['id' => $petItem->getId()]);
        } catch (\Throwable $th) {
            return back()->with('danger', 'search not found!');
        }
    }
}

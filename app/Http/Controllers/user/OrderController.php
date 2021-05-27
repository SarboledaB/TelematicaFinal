<?php

/** 
|--------------------------------------------------------------------------
| Author: Anthony Garcia Moncada
| Email:  agarciam@eafit.edu.co
|--------------------------------------------------------------------------
 **/

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PetItem;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Exports\OrdersExport;
use App\Interfaces\DownloadFile;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = "Create user";

        return view('admin.user.create')->with("data", $data);
    }

    public function show($id)
    {
        $data = []; //to be sent to the view
        $data["title"] = "Orders";
        $data["user"] = User::findOrFail(Auth::id());
        $data["order"] = Order::with(['items'])
            ->where('id', $id)
            ->first();
        $data["products"] = [];
        /* dd($data["order"]->items); */
        foreach ($data["order"]->items as $key => $value) {
            $petItems = PetItem::where('id', $value->pet_item_id)->first();
            array_push($data["products"], $petItems);
        }

        return view('user.order.show')->with("data", $data);
    }

    public function save(Request $request)
    {
        try {
            $products = $request->session()->get("products");
            dd($products);
            /* Order::validate($request);
            Order::create($request->only(['id', 'status', 'total', 'paymentMethod', 'user', 'items'])); */
        } catch (\Throwable $th) {
            return back()->with('danger', 'Order was not created!');
        }
    }

    public function list($id)
    {
        try {

            $data = []; //to be sent to the view
            $data["title"] = "List orders";
            $data["orders"] = Order::all()->where('user_id', $id);

            return view('user.order.list')->with("data", $data);
        } catch (\Throwable $th) {
            return view('user.order.list')->with('danger', "Couldn't get the list!");
        }
    }

    public function export()
    {
        $downloadInterface = app(DownloadFile::class);
        return $downloadInterface->download('Orders.xlsx');
    }
}

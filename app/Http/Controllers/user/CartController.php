<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;
use App\Models\PetItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PhpOption\None;

class CartController extends Controller
{
    public function show(Request $request)
    {   
        $data = [];
        $breadlist = array();
        $breadlist[0] = array('Home', "user.petItem.list", null, "0");
        $breadlist[1] = array('Cart', "user.cart.show", null, "1");
        $data["breadlist"] = $breadlist;

        $data["title"] = "Cart Products";
        $listProductsInCart = array();
        $ids = $request->session()->get("products");
        if($ids) {
            $listProductsInCart = PetItem::findMany($ids);
        }
        $data["products"] = $listProductsInCart;
        return view('user.cart.show')->with("data", $data);

    }


    public function add($id, Request $request)
    {   
        $products = $request->session()->get("products"); 
        $products[$id] = $id;
        $request->session()->put('products', $products);
        return back();     
    }

    public function remove($id, Request $request)
    {
        $request->session()->forget('products');
        return back();
    }

    public function buy(Request $request)
    {
        $data = []; //to be sent to the view

        $breadlist = array();
        $breadlist[0] = array('Home', "user.petItem.list", null, "0");
        $breadlist[1] = array('Cart', "user.cart.show", null, "0");
        $breadlist[2] = array('Billing', "user.cart.buy", null, "1");
        $data["breadlist"] = $breadlist;

        $data["title"] = "Order";
        $data["user"] = User::findOrFail(Auth::id());

        $order = new Order();
        $order->setTotal(0);
        $order->setStatus(0);
        $order->setPayment('');
        $order->setUserId(Auth::id());
        $order->save();

        $total = 0;
        $ids = $request->session()->get("products");
        $listProductsInCart = [];
        if($ids) {
            $listProductsInCart = PetItem::findMany($ids);
            foreach ($listProductsInCart as $product) {
                $item = new Item();
                $item->setQuantity(1);
                $item->setvalue($product->getValue());
                $item->setPetItemId($product->getId());
                $item->setOrderId($order->getId());
                $item->save();
                $total = $total + $product->getValue();
            }
        }

        $order->setTotal($total);
        $order->save();
        $data["order"] = $order;
        $data["products"] = PetItem::findMany($ids);;
        $request->session()->forget('products');
        return view('user.order.show')->with("data", $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart_list()
    {
        $cart = Cart::with('product')->get();
        return view('home.cart.cart', ['cart' => $cart]);
    }

    public function add_cart(Request $request, $id)
    {

        $cart = Cart::with('product')->where('product_id', $request->pid )->first();
        // dd($cart);
        if ($cart) {
            $product_quantity = $cart->product_quantity;
            $quantity = $request->quantity;
            $cart = DB::table('carts')
                ->where('product_id', $request->pid)
                ->update(['product_quantity' => $product_quantity + $quantity]);
            return redirect('/clist')->with('success', 'Item Added successfully!');
        } else {

            // $product = Product::find($id);

            // $product->save();
            $cart = new Cart();
            $cart->product_id = $request->pid;
            $cart->product_quantity = $request->quantity;
            $cart->email = Auth()->user()->email;
            $cart->user_id = Auth()->user()->id;
            $cart->save();
            return redirect('/clist')->with('success', 'Item Added successfully!');
        }
    }

    public function cart_update(Request $request, $id)
    {
        $cart = Cart::find($id);
        $cart->product_quantity = $request->quantity;
        $cart->save();
        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect('/clist');
    }

    public function cart_delete($id)
    {
        $cart = Cart::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Item Removed successfully!');
    }

    public function all_delete()
    {
        DB::table('cart')->truncate();

        return redirect()->back()->with('success', 'All Item Removed successfully!');
    }
}

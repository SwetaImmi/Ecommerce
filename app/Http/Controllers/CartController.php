<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;


class CartController extends Controller
{
    private function findItemIndex($cart, $pid)
    {
        foreach ($cart as $index => $item) {
            if ($item['product_id'] === $pid) {
                return $index;
            }
        }
        return false;
    }

    public function cart_list()
    {
        if (Auth::user()) {
            $cart = Cart::with('product')->get();

            return view('home.cart.cart', ['cart' => $cart]);
        }
        $cart = json_decode(request()->cookie('cart'), true) ?? [];
        return view('home.cart.cart', ['cart' => $cart]);
    }

    public function add_cart(Request $request, $pid)
    {
        if (Auth::user() == NULL) {
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            $existingItemIndex = $this->findItemIndex($cart, $pid);
            if ($existingItemIndex !== false) {
                $cart[$existingItemIndex]['product_quantity'] += 1;
            } else {
                $cart[] = [
                    'product_id' => $pid,
                    'product_quantity' => 1,
                    'product_name' => $request->product_name,
                    'product_price' =>  $request->product_price,
                    'product_image' =>  $request->product_image,
                ];
            }
            return redirect()->back()->withCookie('cart', json_encode($cart), 60 * 24 * 7)->withSuccess('Cart Added successfully');
        } else {
            $cart = Cart::with('product')->where('product_id', $request->pid)
                ->where('user_id', Auth::id())
                ->first();
            if ($cart) {
                $product_quantity = $cart->product_quantity;
                $quantity = $request->quantity;
                $cart = DB::table('carts')
                    ->where('product_id', $request->pid)
                    ->update(['product_quantity' => $product_quantity + $quantity]);
                return redirect()->back()->with('success', 'Item Added successfully!');
            } else {
                $cart = new Cart();
                $cart->product_id = $request->pid;
                $cart->product_quantity = $request->quantity;
                $cart->email = Auth()->user()->email;
                $cart->user_id = Auth()->user()->id;
                $cart->save();
                return redirect()->back()->with('success', 'Item Added successfully!');
            }
        }
    }

    public function removeFromCart($pid)
    {
        $cart = json_decode(request()->cookie('cart'), true) ?? [];
        $index = $this->findItemIndex($cart, $pid);
        if ($index !== false) {
            unset($cart[$index]);
            $cart = array_values($cart);
            return redirect('clist')->withCookie('cart', json_encode($cart), 60 * 24 * 7);
        }
        return redirect('clist');
    }

    public function removeAllFromCart()
    {
        $cookie = Cookie::forget('cart');
        return redirect('/')->withCookie($cookie);
    }

    public function cart_update(Request $request, $id)
    {
        if ($request->cid) {
            $cart = Cart::find($id);
            $cart->product_quantity = $request->quantity;
            $cart->save();
            session()->flash('success', 'Item Cart is Updated Successfully !');

            return redirect()->back();
        }
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

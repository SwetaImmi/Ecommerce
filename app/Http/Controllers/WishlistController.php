<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    private function findItemIndex($wishlist, $pid)
    {
        foreach ($wishlist as $index => $item) {
            if ($item['product_id'] === $pid) {
                return $index;
            }
        }
        return false;
    }

    public function index(Request $request)
    {
        // return $request->all();
        $wishlist = json_decode(request()->cookie('wishlist'), true) ?? [];

        $wishlist[] = [
            'product_id' => $request->pid,
            'product_name' => $request->product_name,
            'product_price' =>  $request->product_price,
            'product_image' =>  $request->product_image,
        ];
        return redirect()->back()->withCookie('wishlist', json_encode($wishlist), 60 * 24 * 7)->withSuccess('Wishlist Added successfully');
    }


    public function wishlist_chart()
    {
        $product = Product::all();
        $wishlist = json_decode(request()->cookie('wishlist'), true) ?? [];
        // return $cart;
        return view('home.cart.wishlist', ['wishlist' => $wishlist, 'products' => $product]);
    }


    public function removeFromWishlist($pid)
    {
        $wishlist = json_decode(request()->cookie('wishlist'), true) ?? [];
        $index = $this->findItemIndex($wishlist, $pid);
        if ($index !== false) {
            unset($wishlist[$index]);
            $wishlist = array_values($wishlist);
            return redirect()->back()->withCookie('wishlist', json_encode($wishlist), 60 * 24 * 7);
        }
        return 2;
        return redirect('clist');
    }
}

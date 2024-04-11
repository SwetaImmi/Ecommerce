<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Gallery;
use Illuminate\Http\Request;


class FrontendController extends Controller
{
    public function index()
    {
        // dd(Auth::user()->name);
        $product = Product::latest()->paginate(100);
        $banner = Banner::latest()->paginate(4);
        return view('home.dash.index', ['banner' => $banner, 'product' => $product]);
    }

    public function products_show(Request $request)
    {
        $search = $request['search'] ?? "";

        if ($search != "") {
            $product = Product::where('product_name', 'like', '%' . $search . '%')
                ->orWhere('category_id', 'like', '%' . $search . '%')
                // ->orWhere('product_description', 'like', '%' . $search . '%')
                ->orWhere('product_price', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orderby('id', 'desc')
                // ->unique('products','category_id')
                ->paginate(10);
            $product->append(array('search ' =>  $search));
        } else {
            $product = Product::all();
        }

        return view('home.products', compact('product'));
    }

    public function single_product(Request $request ,$id)
    {
        $item = Product::latest()->paginate(4);
        $product = Product::find($id);
        $gallery = Gallery::all();
        // $notify = Notification::all();
        // print_r($notify);
        // dd($notify);
        return view('home.single-product', ['product' => $product, 'item' => $item, 'gallery' => $gallery ]);
    }
}

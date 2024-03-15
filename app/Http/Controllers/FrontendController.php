<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Buy;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class FrontendController extends Controller
{
    public function index()
    {
        // dd(Auth::user()->name);
        $product = Product::latest()->paginate(8);
        $banner = Banner::latest()->paginate(4);
        return view('home.dash.index', ['banner' => $banner, 'product' => $product]);
    }

    public function products_show(Request $request)
    {
        $search = $request['search'] ?? "";

        if ($search != "") {
            // return 1;

            $product = Product::where('product_name', 'like', '%' . $search . '%')
                ->orWhere('product_category', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orderby('id', 'desc')
                // ->unique('products','product_category')
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
        $notify = Notification::all();
        // print_r($notify);
        // dd($notify);
        return view('home.single-product', ['product' => $product, 'item' => $item, 'gallery' => $gallery , 'notify' => $notify]);
    }




    public function notification(Request $request)
    {
        $notify = new Notification();
        $notify->user_id  = Auth::user()->id;
        $notify->product_id   = $request->message;
        $notify->type      = 1;
        $notify->read  = 1;
        $notify->save();
        // return $notify;

        event(new \App\Events\PostLiked($request->message));
        // return $message;
        return [
            'success' => true,
            'msg' => Auth::user()->name . ":liked your status",
            'name' => Auth::user()->name,
            'notify' => $notify,
        ];
        // $product = Product::all();
        // return view('notification',['product' =>  $product]);
    }




    public function newxxx(Request $request)
    // {
    //     $product = Product::all();
    //     return view('Rough.test',compact('product'));
    // }
    {
        // return 1;
        $products = Product::find(1)->buy;
        $product = Buy::find(1)->produts();
        $gallery =  Buy::with('produts')->get();
        // $products = Product::find(2)->gallery;
        // $product = Gallery::find(2)->product()->get();
        dd($product);
        $cart = Cart::find(1)->product()->get();
        dd($products);
        //  $product->id;
        // $cart = Cart::with('product')->get( );
        $cart = Category::with('product_category')->get();

        // echo "<pre>";
        // print_r($cart);
        // die();

        return view('welcome', compact('cart'));

        // $cart = Cart::find(1)->products()->product_name;
        // $cat


    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function banner_list()
    {
        $banner = Banner::all();
        return view('admin.pages.banner_list', ['banner' =>  $banner]);
    }

    public function banner_view()
    {
        return view('admin.pages.banner');
    }

    public function banner_add(Request $request)
    {
        $request->validate([
            'banner_content' => 'required',
            'first_banner_content' => 'required',
            'second_banner_content' => 'required',
            'third_banner_content' => 'required',
            'last_banner_content' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'second_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'third_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'last_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
      
            // main image
            if ($request->main_image != "") {
                $image = rand() . '.' . $request->main_image->extension();
                $request->main_image->move(('banners'), $image);
            } else {
                $image = "0";
            }
            // 1st side image
            if ($request->first_banner_image != "") {
                $first = rand() . '.' . $request->first_banner_image->extension();               
                $request->first_banner_image->move(('banners'), $first);
            } else {
                $first_full = "0";
            }
            // 2nd side image
            if ($request->second_banner_image != "") {
                // $image_n = rand(1000,10000);/
                $second = rand() . '.' . $request->second_banner_image->extension();
                // $second_full  =$image_n.$second;
                $request->second_banner_image->move(('banners'), $second);
            } else {
                $second = "0";
            }
            // 3rd side image
            if ($request->third_banner_image != "") {
                // $image_name = rand(1000,10000);/
                $third = rand() . '.' . $request->third_banner_image->extension();
                $request->third_banner_image->move(('banners'), $third);
            } else {
                $third = "0";
            }
            // 4th side image
            if ($request->last_banner_image != "") {
                // $image_name = rand(1000,10000);
                $fourth = rand() . '.' . $request->last_banner_image->extension();
                $request->last_banner_image->move(('banners'), $fourth);
            } else {
                $fourth = "0";
            }

            $banner = new Banner();
            $banner->main_banner_content   =   $request->banner_content;
            $banner->main_banner_image   =   $image;

            $banner->first_banner_content   =   $request->first_banner_content;
            $banner->first_banner_image   =   $first;

            $banner->second_banner_content   =   $request->second_banner_content;
            $banner->second_banner_image   =   $second;

            $banner->third_banner_content   =   $request->third_banner_content;
            $banner->third_banner_image   =   $third;

            $banner->last_banner_content   =   $request->last_banner_content;
            $banner->last_banner_image   =   $fourth;

            $banner->status   =   '0';
            $banner->email =  Auth::user()->email;
            // echo "<pre>";
            // print_r($banner);
            // return $banner; 
            $banner->save();
            return redirect('/admin/banner_list')->with('success', 'Banner Updated Successfully');

     
    }


    // Checkbox Status Changes
    public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|boolean|in:1,0'
        ]);
        
        $user = Banner::find($request->user_id);
        
        $user->status = $request->status;

        $keys = Banner::all();
        foreach ($keys as $key) {
            $rank = 0; //Example.. In real it's variable..
            DB::table('banner')
                ->where('id', $key->id)
                ->update(['status' => $rank]);
        }
        $user->save();
        return response()->json(['success' => 'Status change successfully.']);
    }


    public function banner_delete($id)
    {
        $banner = Banner::findOrFail($id)
            ->delete();
        return redirect()->back();
    }

    public function postStar(){
        return 1;
    }



public function newxxx(Request $request)
// {
//     $product = Product::all();
//     return view('Rough.test',compact('product'));
// }
{
    return 1;
    $gallery =  Gallery::with('product')->get();
    $products = Product::find(2)->gallery;
    $product = Gallery::find(2)->product()->get();
    // dd($product);
    $cart = Cart::find(1)->product()->get();
    dd($gallery);
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

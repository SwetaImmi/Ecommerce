<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function gallery_show()
    {

        $prdt = Product::all();
        //    $property_images = json_decode($prdt->product_gallery_image);
        // echo "<pre>";
        //    print_r($prdt->product_gallery_image); die();
        return view('admin.pages.gallery', compact('prdt'));
    }


    public function fileUpload(Request $req)
    {
        $req->validate([
            'imageFile' => 'required|min:3',
            'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);
        $gallery = Gallery::where('products_id', $req->product_gallery_id)->first();
  
            if ($req->hasfile('imageFile')) {
                foreach ($req->file('imageFile') as $file) {
                    // $fourth = rand() . '.' . $request->last_banner_image->extension();
                    // $request->last_banner_image->move(('banners'), $fourth);
    
                    $name = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/uploads/', $name);
                    $imgData[] = $name;
                }
                $fileModal = new Gallery();
                // $fileModal->main_banner_content = json_encode($imgData);
                $fileModal->product_gallery_image = json_encode($imgData);
                $fileModal->products_id   = $req->product_gallery_id;
                $fileModal->product_color_image = 1;
                $fileModal->email = Auth()->user()->email;
                //    return $fileModal;
                $fileModal->save();
                return back()->with('success', 'File has successfully uploaded!');
            }
        }
       

    public function gallery_list_show(Request $request)
    {
        // $gallery = Gallery::all();
        $gallery =  Gallery::with('products')->get();
    //        $product = Gallery::find(1)->product_gallery()->get();
    // $product = Product::find(1)->gallery()->first();
    

        return view('admin.pages.gallery_list', compact('gallery'));
    }
}

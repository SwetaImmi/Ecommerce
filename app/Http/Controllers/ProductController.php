<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // product details show on dashboard
    public function index(Request $request)
    {
        $product =  Product::latest()->count();
        $products = Product::find($request->id);
        return view('admin.auth.index', ['product' => $product, 'products' => $products]);
    }

    // Product Add 
    public function product()
    {
        $category = Category::all();
        return view('admin.pages.product', compact('category'));
    }

    public function product_add(Request $request)
    {
        $request->validate([
            'product_name'  =>  'required',
            'product_quantity'  =>  'required',
            'product_price'  =>  'required',
            'product_description'  =>  'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $new_name);
            $product = new Product();
            $product->product_name   =   $request->product_name;
            $product->product_quantity   =   $request->product_quantity;
            $product->category_id   =   $request->category;
            $product->product_price   =   $request->product_price;
            $product->product_description   =   $request->product_description;
            $product->product_image   =   $new_name;
            $product->role =  Auth::user()->role;
            $product->email =  Auth::user()->email;
            $product->save();
            return redirect('/admin/products_list')->with('success', 'Product Created Successfully');
    }

    // Product Edit & Update
    public function products_edit(string $id)
    {
        $product = Product::findOrfail($id);
        return view('admin.pages.edit_product', compact('product'));
    }

    public function product_update(Request $request, string $id)
    {
        if ($request->image != "") {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(('uploads'), $image);
        } else {
            $image = "0";
        }
        // print_r($image); die('text');   
        $product = Product::find($id);
        $product->product_name =  $request->product_name;
        $product->category_id =  $product->category;
        $product->product_quantity =  $request->product_quantity;
        $product->product_price =  $request->product_price;
        $product->product_description =  $request->product_description;
        if ($image != "0") {
            $product->image =   $image;
        } else {
            $product->image =   $product->image;
        }
        $product->save();
        return redirect('products_list')->with('success', 'Product Updated Successfully');
    }

    // Show Product List
    public function products_list()
    {
        $product = Product::all();
        return view('admin.pages.product_list', compact('product'));
    }

    // Product Delete
    public function product_delete($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }


    // Add Categories
    public function category()
    {
        return view('admin.pages.category');
    }

    public function category_add(Request $request)
    {
        $request->validate([
            'category' => 'required|unique:product_category',
        ]);
        $category = new Category();
        $category->category = $request->category;
        $category->email = Auth::user()->email;
        $category->save();
        return redirect('/admin')->with('success', 'Item created successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
public function payment_sort()
    {
        $search = $request['search'] ?? "";

        if ($search != "") {
            $product = Product::where('product_name', 'like', '%' . $search . '%')
                ->orWhere('category_id', 'like', '%' . $search . '%')
                ->orWhere('product_description', 'like', '%' . $search . '%')
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



    public function checkout_test(Request $request)
    {
        // return $request->order_details ;
        foreach ($request->order_details as $orderDetail) {
            $order = new Order();
            $order->user_id  = Auth::user()->id;
            $order->product_id  = $orderDetail['pid'];
            $order->address_id = $orderDetail['aid'];;
            $order->paymentmode =  "C.O.D";
            $order->order_status  = 1;
            $order->order_name  =  $orderDetail['order_name'];
            $order->product_quantity =  $orderDetail['product_quantity'];
            $order->product_price =  $orderDetail['product_price'];
            $order->order_email = Auth::user()->email;
            $order->card_name  = "C.O.D";
            $order->card_number  = "C.O.D";
            $order->card_cvv = "C.O.D";
            $order->card_month = "C.O.D";
            $order->card_year  = "C.O.D";
            $order->save();
            return $order;
            }

        $paymentMode = $request->paymentMethod;
        if ($paymentMode == 'card_payment') {
            return 1;
        } else {
            // $check =  $request->sameadr;
            // if ($check) {
            //     $request->validate([
            //         'shipping_name'  => 'required',
            //         'shipping_address'  => 'required',
            //         'shipping_city'  => 'required',
            //         'shipping_state'  => 'required',
            //         'shipping_zip'  => 'required',
            //         'shipping_mobile'  => 'required',
            //         'shipping_nearby'  => 'required',
            //     ]);
            //     $address = Shipping::find($request->id);
            //     $address->shipping_name        =     $request->shipping_name;
            //     $address->shipping_address     =     $request->shipping_address;
            //     $address->shipping_city        =     $request->shipping_city;
            //     $address->shipping_state       =     $request->shipping_state;
            //     $address->shipping_zip         =     $request->shipping_zip;
            //     $address->shipping_mobile      =     $request->shipping_mobile;
            //     $address->shipping_nearby      =     $request->shipping_nearby;
            //     $address->billing_name         =     $request->shipping_name;
            //     $address->billing_address      =     $request->shipping_address;
            //     $address->billing_city         =     $request->shipping_city;
            //     $address->billing_state        =     $request->shipping_state;
            //     $address->billing_zip          =     $request->shipping_zip;
            //     $address->billing_mobile       =     $request->shipping_mobile;
            //     $address->billing_nearby       =     $request->shipping_nearby;
            //     $address->user_id              =     Auth::user()->id;
            //     $address->save();
            // } else {
            //     $request->validate([
            //         'firstname'  => 'required',
            //         'address'  => 'required',
            //         'city'  => 'required',
            //         'state'  => 'required',
            //         'zip'  => 'required',
            //         'phone'  => 'required',
            //         'nearby'  => 'required',
            //         'billing_name'   =>   'required',
            //         'billing_address'   =>   'required',
            //         'billing_city'   =>   'required',
            //         'billing_state'   =>   'required',
            //         'billing_zip'   =>   'required',
            //         'billing_phone'   =>   'required',
            //         'billing_nearby'   =>   'required',
            //     ]);
            //     $address = new Shipping();
            //     $address->shipping_name        =     $request->shipping_name;
            //     $address->shipping_address     =     $request->shipping_address;
            //     $address->shipping_city        =     $request->shipping_city;
            //     $address->shipping_state       =     $request->shipping_state;
            //     $address->shipping_zip         =     $request->shipping_zip;
            //     $address->shipping_mobile      =     $request->shipping_mobile;
            //     $address->shipping_nearby      =     $request->shipping_nearby;
            //     $address->billing_name         =     $request->billing_name;
            //     $address->billing_address      =     $request->billing_address;
            //     $address->billing_city         =     $request->billing_city;
            //     $address->billing_state        =     $request->billing_state;
            //     $address->billing_zip          =     $request->billing_zip;
            //     $address->billing_mobile       =     $request->billing_phone;
            //     $address->billing_nearby       =     $request->billing_nearby;
            //     $address->user_id              = Auth::user()->id;
            //     $address->save();
            // }
            foreach ($request->order_details as $orderDetail) {
                $order = new Order();
                $order->user_id  = Auth::user()->id;
                $order->product_id  = $orderDetail['pid'];
                $order->address_id = $orderDetail['aid'];;
                $order->paymentmode =  "C.O.D";
                $order->order_status  = 1;
                $order->order_name  =  $orderDetail['order_name'];
                $order->product_quantity =  $orderDetail['product_quantity'];
                $order->product_price =  $orderDetail['product_price'];
                $order->order_email = Auth::user()->email;
                $order->card_name  = "C.O.D";
                $order->card_number  = "C.O.D";
                $order->card_cvv = "C.O.D";
                $order->card_month = "C.O.D";
                $order->card_year  = "C.O.D";
                // $order->save();
                return $order;
                }
            // return redirect()->back();
        }
    }
}

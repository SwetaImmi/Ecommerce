<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Mail\OrderConfirmaionMail;
use App\Mail\single_confirmMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe;
use Stripe\Charge;
use Stripe\Customer;

class OrderController extends Controller
{

    public function cartCheckout()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $address =  Shipping::where('user_id', Auth()->user()->id)->first();
        if (!$address) {
            return view('home.address_checkout', ['buy' => $cart]);
        } else {
            if ($cart) {
                $cart_purchase = Cart::with('product')->where('user_id', Auth::id())->get();
                if ($cart_purchase) {
                    return view('home.place_cart_order', ['cart_purchase' => $cart_purchase, 'address' => $address]);
                }
            }
            return redirect()->intended('/');
        }
    }

    public function checkout_address(Request $request)
    {
        $check =  $request->sameadr;
        if ($check) {
            // return 1;
            $request->validate([
                'shipping_name'  => 'required',
                'shipping_address'  => 'required',
                'shipping_city'  => 'required',
                'shipping_state'  => 'required',
                'shipping_zip'  => 'required',
                'shipping_mobile'  => 'required',
                'shipping_nearby'  => 'required',
            ]);
            $address = new Shipping();
            $address->shipping_name        =     $request->shipping_name;
            $address->shipping_address     =     $request->shipping_address;
            $address->shipping_city        =     $request->shipping_city;
            $address->shipping_state       =     $request->shipping_state;
            $address->shipping_zip         =     $request->shipping_zip;
            $address->shipping_mobile      =     $request->shipping_mobile;
            $address->shipping_nearby      =     $request->shipping_nearby;
            $address->billing_name         =     $request->shipping_name;
            $address->billing_address      =     $request->shipping_address;
            $address->billing_city         =     $request->shipping_city;
            $address->billing_state        =     $request->shipping_state;
            $address->billing_zip          =     $request->shipping_zip;
            $address->billing_mobile       =     $request->shipping_mobile;
            $address->billing_nearby       =     $request->shipping_nearby;
            $address->user_id              = Auth::user()->id;
            $address->save();
            return redirect()->back();
        } else {
            $request->validate([
                'firstname'  => 'required',
                'address'  => 'required',
                'city'  => 'required',
                'state'  => 'required',
                'zip'  => 'required',
                'phone'  => 'required',
                'nearby'  => 'required',
                'billing_name'   =>   'required',
                'billing_address'   =>   'required',
                'billing_city'   =>   'required',
                'billing_state'   =>   'required',
                'billing_zip'   =>   'required',
                'billing_phone'   =>   'required',
                'billing_nearby'   =>   'required',
            ]);
            $address = new Shipping();
            $address->shipping_name        =     $request->shipping_name;
            $address->shipping_address     =     $request->shipping_address;
            $address->shipping_city        =     $request->shipping_city;
            $address->shipping_state       =     $request->shipping_state;
            $address->shipping_zip         =     $request->shipping_zip;
            $address->shipping_mobile      =     $request->shipping_mobile;
            $address->shipping_nearby      =     $request->shipping_nearby;
            $address->billing_name         =     $request->billing_name;
            $address->billing_address      =     $request->billing_address;
            $address->billing_city         =     $request->billing_city;
            $address->billing_state        =     $request->billing_state;
            $address->billing_zip          =     $request->billing_zip;
            $address->billing_mobile       =     $request->billing_phone;
            $address->billing_nearby       =     $request->billing_nearby;
            $address->user_id              = Auth::user()->id;
            $address->save();
            return redirect()->back();
        }
    }

    public function edit_address($id)
    {
        $address =  Shipping::where('user_id', Auth()->user()->id)->first();

        return view('home.edit_address', compact('address'));
    }

    public function update_address(Request $request, $id)
    {
        // return $request->all();
        $check =  $request->sameadr;
        if ($check) {
            // return 1;
            $request->validate([
                'shipping_name'  => 'required',
                'shipping_address'  => 'required',
                'shipping_city'  => 'required',
                'shipping_state'  => 'required',
                'shipping_zip'  => 'required',
                'shipping_mobile'  => 'required',
                'shipping_nearby'  => 'required',
            ]);
            $address = Shipping::find($id);
            $address->shipping_name        =     $request->shipping_name;
            $address->shipping_address     =     $request->shipping_address;
            $address->shipping_city        =     $request->shipping_city;
            $address->shipping_state       =     $request->shipping_state;
            $address->shipping_zip         =     $request->shipping_zip;
            $address->shipping_mobile      =     $request->shipping_mobile;
            $address->shipping_nearby      =     $request->shipping_nearby;
            $address->billing_name         =     $request->shipping_name;
            $address->billing_address      =     $request->shipping_address;
            $address->billing_city         =     $request->shipping_city;
            $address->billing_state        =     $request->shipping_state;
            $address->billing_zip          =     $request->shipping_zip;
            $address->billing_mobile       =     $request->shipping_mobile;
            $address->billing_nearby       =     $request->shipping_nearby;
            $address->user_id              = Auth::user()->id;
            $address->save();
            return redirect()->back();
        } else {
            $request->validate([
                'shipping_name'  => 'required',
                'shipping_address'  => 'required',
                'shipping_city'  => 'required',
                'shipping_state'  => 'required',
                'shipping_zip'  => 'required',
                'shipping_mobile'  => 'required',
                'shipping_nearby'  => 'required',
                'billing_name'   =>   'required',
                'billing_address'   =>   'required',
                'billing_city'   =>   'required',
                'billing_state'   =>   'required',
                'billing_zip'   =>   'required',
                'billing_mobile'   =>   'required',
                'billing_nearby'   =>   'required',
            ]);
            $address = Shipping::find($id);
            $address->shipping_name        =     $request->shipping_name;
            $address->shipping_address     =     $request->shipping_address;
            $address->shipping_city        =     $request->shipping_city;
            $address->shipping_state       =     $request->shipping_state;
            $address->shipping_zip         =     $request->shipping_zip;
            $address->shipping_mobile      =     $request->shipping_mobile;
            $address->shipping_nearby      =     $request->shipping_nearby;
            $address->billing_name         =     $request->billing_name;
            $address->billing_address      =     $request->billing_address;
            $address->billing_city         =     $request->billing_city;
            $address->billing_state        =     $request->billing_state;
            $address->billing_zip          =     $request->billing_zip;
            $address->billing_mobile       =     $request->billing_mobile;
            $address->billing_nearby       =     $request->billing_nearby;
            $address->user_id              = Auth::user()->id;
            // return  $address;
            $address->save();
            return redirect()->intended('/cartCheckout');
        }
    }

    // Cart Order Placed 
    public function cartPlaceOrder(Request $request)
    {
        $address = Shipping::where('user_id', Auth()->user()->id)->first();
        $orderDetailsArray = [];
        $order = new Order();
        $order->user_id  = Auth::user()->id;
        $order->product_id   = $request->pid;
        $order->address_id = $request->address_id;
        $order->paymentmode =  "C.O.D";
        $order->product_quantity =  $request->total_quantity;
        $order->product_price =  $request->total_amount;
        $order->order_email = Auth::user()->email;
        $order->card_name  = "C.O.D";
        $order->card_number  = "C.O.D";
        $order->card_cvv = "C.O.D";
        $order->card_month = "C.O.D";
        $order->card_year  = "C.O.D";
        $order->save();
        foreach ($request->order_details as $orderDetail) {
            $orderDetails = new OrderDetail();
            $orderDetails->user_id  = Auth::user()->id;
            $orderDetails->product_id  = $orderDetail['pid'];
            $orderDetails->paymentMode =  "C.O.D";
            $orderDetails->product_name  =  $orderDetail['order_name'];
            $orderDetails->product_quantity =  $orderDetail['product_quantity'];
            $orderDetails->product_price =  $orderDetail['product_price'] * $orderDetail['product_quantity'];
            $orderDetails->order_id = $order->id;
            $orderDetails->save();
            $orderDetailsArray[] = $orderDetails;
        }
        // Send Mail
        Mail::to(Auth::user()->email)->send(new OrderConfirmaionMail($orderDetailsArray));
        // Clear the cart items for the authenticated user
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        }
        return view("home.payment_success", ['order' => $orderDetailsArray, 'address' => $address]);
    }
    public function cart_charge(Request $request, $pid, $quantity)
    {
        $product = Cart::with('product')->where('user_id', Auth::id())->get();
        $user = Auth::user();
        $address = Shipping::where('user_id', Auth()->user()->id)->first();
        return view(
            'cashier
            
            payment',
            [
                'total_quantity' => $quantity,
                'total_cart_amount' => $pid,
                'cart_product' => $product,
                'address' => $address,
                'user' => $user,
                // 'intent' => $user->createSetupIntent(),

            ]
        );
    }

    public function cart_process_payment(Request $request)
    {
        $orderDetailsArray = [];
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $token = $request->stripeToken;
        $order = new Order();
        $order->user_id  = Auth::user()->id;
        $order->product_id  = $request->pid;
        $order->address_id = $request->address_id;
        $order->paymentmode =  "card";
        $order->product_quantity =  $request->total_quantity;
        $order->product_price =  $request->total_amount;
        $order->order_email = Auth::user()->email;
        $order->card_name  = "card";
        $order->card_number  = "card";
        $order->card_cvv = "card";
        $order->card_month = "card";
        $order->card_year  = "card";
        $order->save();
        foreach ($request->order_details as $orderDetail) {
            // return $orderDetail['pid'];
            $shipping = Shipping::where('id',  $orderDetail['aid'])->first();
            $orderDetails = new OrderDetail();
            $orderDetails->user_id  = Auth::user()->id;
            $orderDetails->product_id  = $orderDetail['pid'];
            $orderDetails->paymentMode =  "Card";
            $orderDetails->product_name  =  $orderDetail['order_name'];
            $orderDetails->product_quantity =  $orderDetail['product_quantity'];
            $orderDetails->product_price =  $orderDetail['product_price'] * $orderDetail['product_quantity'];
            $orderDetails->order_id = $order->id;
            $orderDetails->save();
            $orderDetailsArray[] = $orderDetails;
        }
        $productNames = array_map(function ($orderDetail) {
            return $orderDetail->product_name;
        }, $orderDetailsArray);

        // Create a customer
        if (Auth::user()->stripe_id == NULL) {
            $customer = Customer::create([
                'name' => Auth::user()->name,
                'source' => $token,
                'email' => Auth::user()->email,

            ]);
            $user = User::find(Auth::user()->id);
            $user->stripe_id = $customer->id;
            $user->save();
            // Charge Create
            $charge = Charge::create([
                'customer' => $customer->id,
                // "source" => $token,
                'amount' => $request->total_amount * 100,
                'currency' => 'usd',
                'description' => 'Purchase of Your Product ID :-' . json_encode($productNames),
                'metadata' => [
                    'order_id' => $order->id,
                    'product_name' => json_encode($productNames),
                    "city" => $shipping->billing_city,
                    "line1" => $shipping->billing_address,
                    "postal_code" => $shipping->billing_zip,
                    "state" => $shipping->billing_state,
                    "email" => Auth::user()->email,
                    "name" => $shipping->billing_name,
                    "phone" => $shipping->billing_mobile,
                ],


            ]);
        } else {
            // Charge the customer
            $charge = Charge::create([
                "source" => $token,
                'amount' => $request->total_amount * 100,
                'currency' => 'usd',
                'description' => 'Purchase of Your ' . json_encode($productNames),
                'metadata' => [
                    'order_id' => $order->id,
                    'product_name' => json_encode($productNames),
                    "city" => $shipping->billing_city,
                    "line1" => $shipping->billing_address,
                    "postal_code" => $shipping->billing_zip,
                    "state" => $shipping->billing_state,
                    "email" => Auth::user()->email,
                    "name" => $shipping->billing_name,
                    "phone" => $shipping->billing_mobile,
                ],


            ]);
            Charge::update(
                $charge->id,
                [
                    'customer' => Auth::user()->stripe_id,
                ]
            );
        }

        $order = Order::find($order->id);
        $order->card_name  = $charge->payment_method_details->card->brand;
        $order->card_number  = $charge->payment_method_details->card->last4;
        $order->card_cvv = $charge->payment_method_details->card->checks->cvc_check;
        $order->card_month = $charge->payment_method_details->card->exp_month;
        $order->card_year  = $charge->payment_method_details->card->exp_year;
        $order->save();
        $user = User::find(Auth::user()->id);
        $user->pm_type  = $charge->payment_method_details->card->brand;
        $user->pm_last_four   = $charge->payment_method_details->card->last4;
        $user->save();
        // Clear the cart items for the authenticated user
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        }
        //  Trigger the event  order_email
        Mail::to(Auth::user()->email)->send(new OrderConfirmaionMail($orderDetailsArray));
        // event(new OrderPlaced($orderDetailsArray));
        return view("home.payment_success", ['order' => $orderDetailsArray, 'address' => $shipping]);
    }

    // Single Product Placed
    public function Checkout(Request $request, $id)
    {
        if ($request->product_quantity) {
            $productQnty = $request->product_quantity;
        } else {
            $productQnty = 1;
        }

        $buy = Product::find($id);
        $address =  Shipping::where('user_id', Auth()->user()->id)->first();
        if (!$address) {
            return view('home.address_checkout', ['buy' => $buy]);
        } else {
            // $cardNumber =  Str::mask($address->card_number, '*', 0, -4);
            return view('home.place_order', ['buy' => $buy, 'address' => $address, 'productQnty' => $productQnty]);
        }
    }

    public function single_placeOrder(Request $request)
    {
        $order = new Order();
        $order->user_id  = Auth::user()->id;
        $order->product_id  = $request->pid;
        $order->address_id = $request['aid'];;
        $order->paymentmode =  "C.O.D";
        $order->product_quantity =  $request->product_quantity;
        $order->product_price =  $request->product_price;
        $order->order_email = Auth::user()->email;
        $order->card_name  = "C.O.D";
        $order->card_number  = "C.O.D";
        $order->card_cvv = "C.O.D";
        $order->card_month = "C.O.D";
        $order->card_year  = "C.O.D";
        $order->save();
        $address = Shipping::where('user_id', Auth()->user()->id)->first();
        $orderDetails = new OrderDetail();
        $orderDetails->user_id  = Auth::user()->id;
        $orderDetails->product_id  = $request->pid;
        $orderDetails->paymentMode =  "C.O.D";
        $orderDetails->product_name  =  $request->order_name;
        $orderDetails->product_quantity =  $request->product_quantity;
        $orderDetails->product_price =  $request->product_price;
        $orderDetails->order_id = $order->id;
        $orderDetails->save();
        // Mail::to(Auth::user()->email)->send(new single_confirmMail($orderDetails));
        // $orderData = [$orderDetails, $order, $address];
        // return [$orderDetails,$order,$address];
        // return $orderData;
        // $response = Http::post('https://www.vervante.com/c/v/sendorders', ['input' => $orderData]);
        // if ($response->successful()) {
        //     return  $responseData = $response->json();
        // } else {
        //     $errorCode = $response->status();
        //   return  $errorMessage = $response->body();
        // }
        // return  1;
         event(new OrderPlaced($orderDetails));
        return view("home.payment_success", ['orderDetails' => $orderDetails, 'address' => $address]);
    }


    public function charge(Request $request, $pid)
    {
        $user = Auth::user();
        $product = Product::find($pid);
        $address = Shipping::all();
        return view(
            'cashier.payment',
            [
                'product' => $product,
                'address' => $address,
                'user' => $user,
                // 'intent' => $user->createSetupIntent(),
            ]
        );
    }

    public function processPayment(Request $request)
    {
        // return $request->all();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $product_name =  $request->order_name;
        $token = $request->stripeToken;
        $order = new Order();
        $order->user_id  = Auth::user()->id;
        $order->product_id  = $request->pid;
        $order->address_id = $request->aid;
        $order->paymentmode =  $request->paymentmode;
        $order->product_quantity = $request->product_quantity;
        $order->product_price = $request->product_price;
        $order->order_email = Auth::user()->email;
        $order->card_name  = "card";
        $order->card_number  = "card";
        $order->card_cvv = "card";
        $order->card_month = "card";
        $order->card_year  = "card";
        $order->save();

        $address = Shipping::where('user_id', Auth()->user()->id)->first();
        $orderDetails = new OrderDetail();
        $orderDetails->user_id  = Auth::user()->id;
        $orderDetails->product_id  = $request->pid;
        $orderDetails->paymentMode =  "Card";
        $orderDetails->product_name  =  $request->order_name;
        $orderDetails->product_quantity =  $request->product_quantity;
        $orderDetails->product_price =  $request->product_price;
        $orderDetails->order_id = $order->id;
        $orderDetails->save();

        // Create a customer
        if (Auth::user()->stripe_id == NULL) {
            $customer = Customer::create([
                'name' => Auth::user()->name,
                'source' => $token,
                'email' => Auth::user()->email,
            ]);
            $user = User::find(Auth::user()->id);
            $user->stripe_id = $customer->id;
            $user->save();
            // Charge the customer
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $request->product_price * 100,
                'currency' => 'usd',
                // "source" => $token,
                'description' => 'Purchase of Your ' . $product_name,
                'metadata' => [
                    'order_id' => $order->id,
                    'product_name' => $product_name,
                    "city" => $address->billing_city,
                    "line1" => $address->billing_address,
                    "postal_code" => $address->billing_zip,
                    "state" => $address->billing_state,
                    "email" => Auth::user()->email,
                    "name" => $address->billing_name,
                    "phone" => $address->billing_mobile,
                    // Add more details as needed
                ],
            ]);
        } else {
            // Charge the customer
            $charge = Charge::create([
                // 'customer' => $customer->id,
                'amount' => $request->product_price * 100,
                'currency' => 'usd',
                "source" => $token,
                'description' => 'Purchase of Your ' . $product_name,
                'metadata' => [
                    'order_id' => $order->id,
                    'product_name' => $product_name,
                    "city" => $address->billing_city,
                    "line1" => $address->billing_address,
                    "postal_code" => $address->billing_zip,
                    "state" => $address->billing_state,
                    "email" => Auth::user()->email,
                    "name" => $address->billing_name,
                    "phone" => $address->billing_mobile,
                    // Add more details as needed
                ],
            ]);
            Charge::update(
                $charge->id,
                [
                    'customer' => Auth::user()->stripe_id,
                ]
            );
        }
        // return $charge;
        $order = Order::find($order->id);
        $order->card_name  = $charge->payment_method_details->card->brand;
        $order->card_number  = $charge->payment_method_details->card->last4;
        $order->card_cvv = $charge->payment_method_details->card->checks->cvc_check;
        $order->card_month = $charge->payment_method_details->card->exp_month;
        $order->card_year  = $charge->payment_method_details->card->exp_year;
        $order->save();

        Mail::to(Auth::user()->email)->send(new single_confirmMail($orderDetails));
        return view("home.payment_success", ['orderDetails' => $orderDetails, 'address' => $address]);
    }
}

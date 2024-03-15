<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Models\Buy;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\StripeClient;

class OrderController extends Controller
{
    public function Checkout(Request $request, $id)
    {
        $Order = Shipping::where('user_id', Auth()->user()->id)->first();

        $buy = Product::find($id);
        $prdt = Buy::all();
        $address = Shipping::all();
        if (!$Order) {
            return view('home.checkout', ['buy' => $buy, 'prdt' => $prdt]);
        } else {
            $cardNumber =  Str::mask($Order->card_number, '*', 0, -4);
            return view('home.place_order', ['buy' => $buy, 'prdt' => $prdt, 'Order' => $Order, 'cardNumber' => $cardNumber, 'address' => $address]);
        }
    }


    public function checkout_address(Request $request)
    {
        $check =  $request->sameadr;
        if ($check) {
            // return 1;
            $request->validate([
                'firstname'  => 'required',
                'address'  => 'required',
                'city'  => 'required',
                'state'  => 'required',
                'zip'  => 'required',
                'phone'  => 'required',
                'nearby'  => 'required',
            ]);

            $address = new Shipping();
            $address->shipping_name        =     $request->firstname;
            $address->shipping_address     =     $request->address;
            $address->shipping_city        =     $request->city;
            $address->shipping_state       =     $request->state;
            $address->shipping_zip         =     $request->zip;
            $address->shipping_mobile      =     $request->phone;
            $address->shipping_nearby      =     $request->nearby;
            $address->billing_name         =     $request->firstname;
            $address->billing_address      =     $request->address;
            $address->billing_city         =     $request->city;
            $address->billing_state        =     $request->state;
            $address->billing_zip          =     $request->zip;
            $address->billing_mobile       =     $request->phone;
            $address->billing_nearby       =     $request->nearby;
            $address->user_id              = Auth::user()->id;
            $address->save();
            return redirect()->back();
        } else {
            return 2;
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
            $address->shipping_name        =     $request->firstname;
            $address->shipping_address     =     $request->address;
            $address->shipping_city        =     $request->city;
            $address->shipping_state       =     $request->state;
            $address->shipping_zip         =     $request->zip;
            $address->shipping_mobile      =     $request->phone;
            $address->shipping_nearby      =     $request->nearby;
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


    public function placeOrder(Request $request)
    {

        $order = new Order();
        $order->user_id  = Auth::user()->id;
        $order->product_id  = $request->pid;
        $order->address_id = $request->aid;
        $order->paymentmode =  "C.O.D";
        $order->order_status  = 1;
        $order->order_name  = $request->order_name;
        $order->product_quantity = $request->product_quantity;
        $order->product_price = $request->product_price;
        $order->order_email = Auth::user()->email;
        $order->card_name  = "C.O.D";
        $order->card_number  = "C.O.D";
        $order->card_cvv = "C.O.D";
        $order->card_month = "C.O.D";
        $order->card_year  = "C.O.D";
        $order->save();

        //  Trigger the event  order_email
        event(new OrderPlaced($order));
        return "Order placed successfully!";
    }

    public function charge($id)
    {
        // return 1;
        $user = Auth::user();
        $product = Product::find($id);
        $address = Shipping::all();
        return view(
            'payment',
            [
                'product' => $product,
                'address' => $address,
                'user' => $user,
                'intent' => $user->createSetupIntent(),

            ]
        );
    }

    public function processPayment(Request $request)
    {
        $shipping = Shipping::where('id', $request->aid)->first();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // return $request->all();
        $product_name =  $request->product_name;
        $token = $request->stripeToken;

        $order = new Order();
        $order->user_id  = Auth::user()->id;
        $order->product_id  = $request->pid;
        $order->address_id = $request->aid;
        $order->paymentmode =  $request->paymentmode;
        $order->order_status  = 1;
        $order->order_name  = $request->product_name;
        $order->product_quantity = $request->product_quantity;
        $order->product_price = $request->product_price;
        $order->order_email = Auth::user()->email;
        $order->card_name  = "C.O.D";
        $order->card_number  = "C.O.D";
        $order->card_cvv = "C.O.D";
        $order->card_month = "C.O.D";
        $order->card_year  = "C.O.D";
        $order->save();

        // Create a customer
        $customer = Customer::create([
            'name' => $request->customer_name,
            'source' => $token,
            'email' => $request->customer_email,

        ]);

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
                "city" => $shipping->billing_city,
                "line1" => $shipping->billing_address,
                "postal_code" => $shipping->billing_zip,
                "state" => $shipping->billing_state,
                "email" => Auth::user()->email,
                "name" => $shipping->billing_name,
                "phone" => $shipping->billing_mobile,
                // Add more details as needed
            ],


        ]);
        // return $charge;
        $order = Order::find($order->id);
        $order->card_name  = $charge->payment_method_details->card->brand;
        $order->card_number  = $charge->payment_method_details->card->last4;
        $order->card_cvv = $charge->payment_method_details->card->checks->cvc_check;
        $order->card_month = $charge->payment_method_details->card->exp_month;
        $order->card_year  = $charge->payment_method_details->card->exp_year;
        $order->save();
        return view("home.payment_success");
    }








    // {
    //     $token = $request->stripeToken;
    //     $amount = $request->amount;

    //     $user = Auth::user();
    //     $stripeCustomer = $user->createOrGetStripeCustomer();
    //     return $stripeCustomer;

    //     return $request->all();
    //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    //     $test =    Stripe\charge::create([
    //         "amount" => 10 * 100,
    //         "currency" => "usd",
    //         "source" => $request->stripeToken,
    //         "description" => "Test payment from itsolutionstuff.com."
    //     ]);
    //     dd($test);
    //     return back()
    //         ->with('success', 'Payment successful!');

    //     // return $request->all();
    //     // // Stripe::setApiKey(env('STRIPE_SECRET'));
    //     // $stripe = new StripeClient(env('STRIPE_SECRET'));
    //     // $stripe->paymentIntents->create([
    //     //     'amount' => 92 * 100,
    //     //     'currency' => 'usd',
    //     //     'payment_method' => $request->payment_method,
    //     //     'description' => 'Demo payment with stripe test',
    //     //     'customer' =>   'cus_PbjxQGJtaV5QuR',
    //     //     'confirm' => true,
    //     //     'automatic_payment_methods' => ['enabled' => true, 'allow_redirects' => 'never'],
    //     //     'receipt_email' => $request->email
    //     // ]);
    //     // // dd($stripe);
    //     // return back()
    //     //     ->with('success', 'Payment successful!');
    // }
}

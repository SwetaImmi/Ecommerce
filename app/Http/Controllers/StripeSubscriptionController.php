<?php

namespace App\Http\Controllers;

use App\Mail\MyMail;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Subscription;
use Stripe\StripeClient;
use Stripe;
use Dompdf\Options;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Payout;
use Stripe\Price;
use Stripe\Refund;
use Stripe\Subscription as StripeSubscription;

class StripeSubscriptionController extends Controller
{
  
    public function cancel_subs(User $user, $id)
    {
        $user = Subscription::where('stripe_id', $id)->first();
        $user->stripe_status  = 'canceled';
        $user->save();
        $stripe = new \Stripe\StripeClient('sk_test_51OtMnAD7mrlcwzpAuiW50vhqFkB3OwY2WQtRqenZlAMEeBDqewPmGibiLCZ6tn7I11GbKTDn8flxKs27BXw6eQrw00wJe8Qa0X');
        $stripe->subscriptions->cancel($id, []);
        return redirect()->back();

    }

    public function subscribed_user_list()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $data = StripeSubscription::all(array(['status' => 'canceled', "limit" => 100]));
        $subscription = StripeSubscription::all(array("limit" => 1000));
        $customer = Customer::all(array("limit" => 1000));
        return view('admin.pages.subscribed_user_list', ['subscription' => $subscription, 'customer' => $customer, 'data' => $data]);
    }

    public function plan_list()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $plans = Stripe\Product::all(array("limit" => 100));
        $price = Plan::all();
        // Stripe\Price::all(array("limit" => 100));
        return view('admin.pages.subscriptionPlan_list', ['plans' => $plans, 'price' => $price]);
    }

    public function create_subscription()
    {
        return view('admin.pages.create_subscription');
    }

    public function plan_create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:plans',
            'slug' => 'required',
            'price' => 'required',
        ]);
        // return $request->all();
        $stripe = new \Stripe\StripeClient('sk_test_51OtMnAD7mrlcwzpAuiW50vhqFkB3OwY2WQtRqenZlAMEeBDqewPmGibiLCZ6tn7I11GbKTDn8flxKs27BXw6eQrw00wJe8Qa0X');
        $price =    $stripe->prices->create([
            'currency' => 'usd',
            'unit_amount' => $request->price * 100,
            'nickname'  => $request->name,
            'recurring' => ['interval' => $request->plan_interval],
            'product_data' => ['name' => $request->name],
        ]);

        $plan = new Plan();
        $plan->name = $request->name;
        $plan->slug = $request->plan_interval;
        $plan->stripe_plan = $price->id;  //PRICE ID
        $plan->price = $price->unit_amount / 100;           //PRICE AMOUNT
        $plan->description = $request->description;
        $plan->save();
        return redirect('plan_list');
    }

    public function index()
    {
        $plans = Plan::get();
        return view("cashier.plan", compact("plans"));
    }

    public function show(Plan $plan, Request $request)
    {
        $existingSubscription = Subscription::where('user_id', Auth::user()->id)
            ->where('type', $plan->id)
            ->first();
        if (!$existingSubscription) {
            $intent = auth()->user()->createSetupIntent();
            return view("cashier.subscription", compact("plan", "intent"));
        } else {
            return redirect('plans')->with('success', 'Subscription already exists!');
        }

    }

    public function subscription_post(Request $request)
    {
        // createOrGetStripeCustomer
        // createAsStripeCustomer
        $user = Auth::user();
        $stripeCustomer = $user->createOrGetStripeCustomer();
        return redirect('plans');
    }

    public function subscription(Request $request)
    {
        // return $request->all();
        //  $subscription  = Subscription::where('user_id',Auth::user()->id && 'type', $request->plan)->first();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $price = Stripe\Price::all();
        $plan = Plan::find($request->plan);
        $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)->create($request->token);
        $invoice = $subscription->latestInvoice();
        $user = $request->user();
        Mail::to($user->email)->send(new MyMail($invoice));
        if ($invoice) {
            return $invoice->download([
                'vendor' => 'Your Company',
                'product' => $price->nickname,
                'street' => 'Main Str. 1',
                'location' => '2000 Antwerp, Belgium',
                'phone' => '+32 499 00 00 00',
                'email' => Auth::user()->email,
                'url' => 'https://example.com',
                'vendorVat' => 'BE123456789',
            ]);
        }
        return view("cashier.subscription_success");
    }


    public function payment_list()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $refund = Refund::all();
        $charges = Charge::all(array("limit" => 100));
        // return $charges;
        return view('admin.pages.payment_list', ['charges' => $charges, 'refund' => $refund]);
    }


    public function refund($id)
    {
        $stripe = new \Stripe\StripeClient('sk_test_51OtMnAD7mrlcwzpAuiW50vhqFkB3OwY2WQtRqenZlAMEeBDqewPmGibiLCZ6tn7I11GbKTDn8flxKs27BXw6eQrw00wJe8Qa0X');
        $stripe->refunds->create(['charge' => $id]);
        return redirect()->back();
    }



    public function stripe_test(User $user,$id)
{
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $subscription = Subscription::where('type', $id);
    $price = Plan::find($id);
    $data = StripeSubscription::all(array(['status' => 'canceled', "limit" => 100]));
    // $subscription = StripeSubscription::all(array("limit" => 1000));
    $customer = Customer::all(array("limit" => 1000));
    return view('index', ['subscription' => $subscription, 'customer' => $customer, 'price' => $price, 'data' => $data]);
}





    // {
    //     try {
    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer sk_test_51OtMnAD7mrlcwzpAuiW50vhqFkB3OwY2WQtRqenZlAMEeBDqewPmGibiLCZ6tn7I11GbKTDn8flxKs27BXw6eQrw00wJe8Qa0X',
    //         ])->get('https://api.stripe.com/v1/subscriptions', [
    //             'status' => 'canceled',
    //         ]);

    //         $data = $response->json();
    //         echo "<pre>";
    //         print_r($data);
    //         // Process $data as needed
    //         return response()->json(['canceled_subscriptions' => $data], 200);
    //     } catch (\Exception $e) {
    //         // Handle errors
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    //     dd();
    //     $subscriptions = $user->subscriptions()->with('items')->get();
    //     return $subscriptions;
    // }




    // public function downloadInvoice(Request $request)
    // {
    //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //     $invoiceId = $request->input('invoice_id');
    //     return  $invoiceId;

    //     $invoice = Invoice::retrieve($invoiceId);

    //     // Download the invoice
    //     $pdfContent = $invoice->pdf(['future_usage' => 'off']);

    //     return response()->streamDownload(function () use ($pdfContent) {
    //         echo $pdfContent;
    //     }, 'invoice.pdf');
    // }
}

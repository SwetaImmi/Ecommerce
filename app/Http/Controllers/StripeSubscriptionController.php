<?php

namespace App\Http\Controllers;
use App\Mail\MyMail;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Subscription;
use Stripe;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Refund;
use Stripe\Subscription as StripeSubscription;

class StripeSubscriptionController extends Controller
{
    // Create Subscription Plan

    public function index()
    {
        $plans = Plan::get();
        return view("cashier.plan", compact("plans"));
    }

    public function plan_create(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required|unique:plans',
            'plan_interval' => 'required',
            'price' => 'required',
        ]);
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
        return redirect('admin/plan_list');
    }

    // Subscription plan list
    public function plan_list()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $plans = Stripe\Product::all(array("limit" => 100));
        $price = Plan::all();
        return view('cashier.subscriptionPlan_list', ['plans' => $plans, 'price' => $price]);
    }

    // Subscription List
    public function subscribed_user_list()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $data = StripeSubscription::all(array(['status' => 'canceled', "limit" => 100]));
        $subscription = StripeSubscription::all(array("limit" => 1000));
        $customer = Customer::all(array("limit" => 1000));
        return view('cashier.subscribed_user_list', ['subscription' => $subscription, 'customer' => $customer, 'data' => $data]);
    }


// Create Subscription
    public function create_subscription()
    {
        return view('cashier.create_subscription');
    }

    public function cancel_subs(User $user, $id)
    {
        $user = Subscription::where('stripe_id', $id)->first();
        $user->stripe_status  = 'canceled';
        $user->save();
        $stripe = new \Stripe\StripeClient('sk_test_51OtMnAD7mrlcwzpAuiW50vhqFkB3OwY2WQtRqenZlAMEeBDqewPmGibiLCZ6tn7I11GbKTDn8flxKs27BXw6eQrw00wJe8Qa0X');
        $stripe->subscriptions->cancel($id, []);
        return redirect()->back();
    }


    public function show(Request $request,$id)
    {
        $plan = Plan::find($id);
        $existingSubscription = Subscription::where('user_id', Auth::user()->id)
            ->where('type', $id)
            ->first();
        if (!$existingSubscription) { 
            $intent = auth()->user()->createSetupIntent();
            return view("cashier.subscription", compact("plan", "intent"));
        } else {
            return redirect('plans')->with('success', 'Subscription already exists!');
        }
    }

    public function new_subscriber(Request $request)
    {
        $user = Auth::user();
        $user->createOrGetStripeCustomer();
        return redirect('plans');
    }

    public function subscription(Request $request)
    {
        //  $subscription  = Subscription::where('user_id',Auth::user()->id && 'type', $request->plan)->first();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $price = Stripe\Price::all();
        $plan = Plan::find($request->plan);
        $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)->create($request->token);
        $invoice = $subscription->latestInvoice();
        $user = $request->user();
        Mail::to($user->email)->send(new MyMail($invoice));

        return view("cashier.subscription_success");
    }


    public function payment_list()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $refund = Refund::all();
        $allCharges = [];

        $charges = Charge::all(['limit' => 100]);
        $allCharges = array_merge($allCharges, $charges->data);
        while ($charges->has_more) {
            $charges = Charge::all(['limit' => 100, 'starting_after' => end($charges->data)->id]);
            $allCharges = array_merge($allCharges, $charges->data);
        }
        return view('cashier.payment_list', ['charges' => $allCharges, 'refund' => $refund]);
    }

    public function refund($id)
    {
        $stripe = new \Stripe\StripeClient('sk_test_51OtMnAD7mrlcwzpAuiW50vhqFkB3OwY2WQtRqenZlAMEeBDqewPmGibiLCZ6tn7I11GbKTDn8flxKs27BXw6eQrw00wJe8Qa0X');
        $stripe->refunds->create(['charge' => $id]);
        return redirect()->back();
    }

    public function stripe_test(User $user, $id)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $subscription = Subscription::where('type', $id);
        $price = Plan::find($id);
        $data = StripeSubscription::all(array(['status' => 'canceled', "limit" => 100]));
        $customer = Customer::all(array("limit" => 1000));
        return view('Testing.index', ['subscription' => $subscription, 'customer' => $customer, 'price' => $price, 'data' => $data]);
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
            // if ($invoice) {
        //     return $invoice->download([
        //         'vendor' => 'Your Company',
        //         'product' => $price->nickname,
        //         'street' => 'Main Str. 1',
        //         'location' => '2000 Antwerp, Belgium',
        //         'phone' => '+32 499 00 00 00',
        //         'email' => Auth::user()->email,
        //         'url' => 'https://example.com',
        //         'vendorVat' => 'BE123456789',
        //     ]);
        // }
}

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as FacadesSession;
use Laravel\Cashier\Subscription;
use Session;
use Stripe;
use Stripe\Customer;
use Stripe\Exception\CardException;
use Stripe\Plan;
use Stripe\Stripe as StripeStripe;
use Stripe\StripeClient;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        StripeStripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function stripe()
    {
        // dd(Plan::all());
        $stripe = Plan::all();
        // return $stripe;
        return view('home.address');
    }

    public function store(Request $request)
    {
        try {
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $stripe->paymentIntents->create([
                'amount' => 99 * 100,
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'description' => 'Demo payment with stripe test',
                'customer' =>   'cus_PbjxQGJtaV5QuR',
                'confirm' => true,
                'automatic_payment_methods' => ['enabled' => true, 'allow_redirects' => 'never'],
                'receipt_email' => $request->email
            ]);
        } catch (CardException $th) {
            throw new Exception("There was a problem processing your payment", 1);
        }

        return back()->withSuccess('Payment done.');
    }
    

    public function Test()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $data = Subscription::all(array(['status' => 'canceled', "limit" => 100]));
        $subscription = Subscription::all(array("limit" => 1000));
        $customer = Customer::all(array("limit" => 1000));
        return view('Testing.index', ['subscription' => $subscription, 'customer' => $customer, 'data' => $data]);
    }













    // public function stripePost(Request $request)
    // {


            //             $test =    $stripe->prices->create([
            //                 'currency' => 'usd',
            //                 'unit_amount' => 1000,
            //                 'recurring' => ['interval' => 'month'],
            //                 'product_data' => ['name' => 'Gold Plan'],
            //               ]);
            // return $test;
            // $user = $request->user();

            // $test =   $user->newSubscription('default', 'price_1OmaOFSEK4WUIp4LJgdq4qBf')->create($request->payment_method, [
            //     'email' => $user->email,
            // ]);

            // dd($test);

    //     // return $request->all();
    //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


    //     // $stripe = new \Stripe\StripeClient('sk_test_51OlrRUSEK4WUIp4LqZPNoKiWwMsqGNIW0ud66G2sBQRxZ2jXQJq4Hi165e7HkXZf7MpZ0M4IcqGVDR6F8fK2hNyJ008KmjK5YL');
    //     try {
    //         $stripe = new StripeClient(env('STRIPE_SECRET'));
    //       $test =  $stripe->subscriptions->create([
    //             'customer' => 'test',
    //             'items' => [['price' => 'price_1OmYsASEK4WUIp4LSvjzjBV9']],
    //           ]);

    //         // $customer = $stripe->customers->create([

    //         //     'email' => $request->email,
    //         //     'name' => $request->name,
    //         //     // 'name' => 'TEST'
    //         // ]);
    //         // $payemntid = $stripe->paymentIntents->create([
    //         //      'amount' => 31 * 100,
    //         //     'currency' => 'usd',
    //         //     'payment_method' => $request->payment_method,
    //         //     'description' => 'Demo payment with stripe',
    //         //     'customer' =>   $customer->id,
    //         //     'confirm' => true,
    //         //     'automatic_payment_methods' => ['enabled' => true, 'allow_redirects' => 'never'],
    //         //     'receipt_email' => $request->email,
    //         // ]);

    //         // $stripe->charges->create([
    //         //     'amount' => 1099,
    //         //     'currency' => 'usd',
    //         //     'source' => 'tok_visa',
    //         //   ]);
    //         echo "<pre>";
    //         print_r($test); die();
    //         // $stripe->paymentIntents->create([
    //         //     // 'amount' => 99 * 100,
    //         //     // 'currency' => 'usd',
    //         //     // 'payment_method' => $request->payment_method,
    //         //     // 'description' => 'Demo payment with stripe',
    //         //     // 'customer' => 'cus_PbiVnweO77NkV2',
    //         //     // 'confirm' => true,
    //         //     // 'automatic_payment_methods' => ['enabled' => true, 'allow_redirects' => 'never'],
    //         //     // 'receipt_email' => $request->email,
    //         //     // 'source' =>$request->stripeToken,

    //         // ]);
    //     } catch (CardException $th) {
    //         throw new Exception("There was a problem processing your payment", 1);
    //     }
    //     // $test =

    //     // $stripe->tokens->create([
    //     //     'account' => [
    //     //       'individual' => [
    //     //         'first_name' => 'Jane',
    //     //         'last_name' => 'Doe',
    //     //       ],
    //     //       'tos_shown_and_accepted' => true,
    //     //     ],
    //     //   ]);
    //     // $stripe->paymentIntents->cancel('pi_3Om8t0SEK4WUIp4L15GLtgEB', []);


    //     // $stripe->customerSessions->create([
    //     //     'customer' => 'cus_PbJtXUWI3vfX8w',
    //     //     'components' => ['pricing_table' => ['enabled' => true]],
    //     //   ]);
    //     // dd($test);

    //     //     $stripe->paymentIntents->create([
    //     //         'amount' => 2000,
    //     //         'currency' => 'usd',
    //     //         'automatic_payment_methods' => ['enabled' => true],
    //     //     ]);

    //     // $customer = $stripe->customers->create([
    //     //     // 'email' => 'email@example.com',
    //     //     'email' => $request->email,
    //     //     'name' => $request->firstname
    //     //     // 'name' => 'test'
    //     // ]);

    //     // $payemntid = $stripe->paymentIntents->create([
    //     //     'amount' => 100 * $request->price,
    //     //     'currency' => 'usd',
    //     //     'payment_method_types' => ['card'],
    //     //     'customer' => $customer->id,
    //     //     'payment_method_data' => [
    //     //         'type' => 'card',
    //     //         'card' => [
    //     //             'token' => $request->stripeToken
    //     //         ]
    //     //     ]
    //     // ]);
    //     // dd($test);
    //     FacadesSession::flash('success', 'Payment successful!');

    //     return back();
    // }







    // public function handlePayment(Request $request)
    // {
    //     $address = ["city" => 'punjab', "country" => 'india', "line1" => 'mohali', "line2" => "", "postal_code" => '130062', "state" => 'punjab'];
    //     $amount = 1000;
    //     $user = $request->user();
    //     $user->createOrGetStripeCustomer();
    //     $user->updateDefaultPaymentMethod($request->payment_method);
    //     dd($user);
    //     $user->invoiceFor('Product Name', $amount, [], [
    //         'metadata' => [
    //             'customer_name' => $request->name,
    //         ],
    //     ]);
    //     $user->invoiceFor('One-time Payment', $amount);

    //     return redirect()->back()->with('success', 'Payment successful!');
    // }
}

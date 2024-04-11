<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Jobs\ProcessMessage;
use App\Jobs\SendEmailJob;
use App\Mail\MyMail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Exception;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;


class TestController extends Controller
{

  public function cart_purchase()
  {
    $address = Shipping::all();

    $cart_purchase = Cart::with('product')->where('user_id', Auth::id())->get();
    if ($cart_purchase) {
      return view('Testing.cart_order', ['cart_purchase' => $cart_purchase, 'address' =>$address]);
    }
    echo "<pre>";
    print_r($cart_purchase);
    return $cart_purchase;
  }



  public function Relationship_belongs_to()
  {
    $user = User::find(1)->product;
    $product = Product::find(5)->users;
    $cart = Cart::find(1)->product;
    // $pcart = Product::find(2)->cart()->get();
    $gallery = Gallery::find(1)->products()->get();
    // return $user;

    $ucart = User::find(2)->carts()->get();
    dd($ucart);
    echo "<pre>";
    print_r($user);
  }





  // protected $stripe;
  // public function __construct()
  // {
  //   $this->stripe = new StripeClient(env('STRIPE_SECRET'));
  // }

  public function test_submit(CreateUserRequest  $request)
  {
    //     $valid = [
    //       'name'=> 'required',
    //       'email'=> 'required',
    //       'password'=> 'required',


    //     ];
    //     $validation = Validator::make($request->all(),$valid);
    //    if ($validation->fails()) {
    //     return 1;
    //     // If validation fails, redirect back with errors and old input
    //     return redirect()->back()->withErrors($validation)->withInput();
    // }
    // return 2;
    $user = User::create($request->all());
    return $user;
  }


  public function index_queue()
  {
    // return 1;
    $details = ['newsweta@yopmail.com', 'aryanshi@yopmail.com', 'recipient@yopmail.com'];
    SendEmailJob::dispatch($details);

    return 1;
    //  view('welcome');
  }

  public function index(Request $request)
  {
    $user = User::find(1);

    dd($user->cart);
    $product = Product::find(1); //product

    // $Category = Category::find(2); //product_category  //product table relationship products  gallery
    //   $cart = Cart::find(1); //cart

    //   $comment1 = new Gallery();
    //   $comment1->product_gallery_image  = 1;
    //   $comment1->product_color_image = 4;
    //   $comment1->email = 4;
    //   $comment2 = new Cart;
    //   $comment2->user_id  = 1;
    //   $comment2->product_quantity = 4;
    //   $comment2->email = "3";

    // $post = $product->cart()->saveMany([$comment1,$comment2]);
    //   $post = $product->gallery()->saveMany([$comment1]);
    //   // $cart->product()->associate($product)->save();
    //   dd($post);
    // if($Category){
    //     $product = new Product();
    //     $product->product_name = "Girl Dresses";
    //     // $product->category_id = 3; 
    //     $product->product_price = 25000; 
    //     $product->product_quantity = 250; 
    //     $product->product_description = "Hi ItSolutionStuff.com blablabala"; 
    //     $product->product_image = 1;
    //     $product->role = Auth::user()->role;
    //     $product->email = Auth::user()->email;
    //     $product = $Category->product_category()->save($product);
    //     dd($Category);
    //   }else{
    //     dd("Test Failed");
    //   }
    // dd($Category);
    // $product = Product::find(2)->product_category;
    // $post = Category::find(2)->category;
    // if($post){
    //   $product = new Product();
    //   $product->product_name = "Hi ItSolutionStuff.com";
    //   $product->product_category = "Kid's"; 
    //   $product->product_price = 2500; 
    //   // $posts = $post->product_category()->save();
    //   // dd($posts);
    // }else{
    //   dd("Test Failed");
    // }

  }


  public function notification()
  {
    // return 1;
    $product = Product::all();
    return view('Testing.notification', ['product' =>  $product]);
  }




  public function stripe()
  {
    return view('Testing.stripe');
  }

  public function pay(Request $request)
  {


    // $stripe->paymentIntents->create([
    //     'amount' => 99 * 100,
    //     'currency' => 'usd',
    //     'payment_method' => $request->payment_method,
    //     'description' => 'Demo payment with stripe',
    //     'confirm' => true,
    //     'receipt_email' => $request->email,
    //     // 'mode' => 'payment',
    //     'return_url' => 'https://docs.stripe.com/payments/3d-secure/authentication-flow'
    // ]);

    // try {
    //     $paymentIntent = $this->stripe->paymentIntents->create([
    //         'amount' => 21 * 100,
    //         'currency' => 'usd',
    //         'payment_method' => $request->payment_method,
    //         // 'confirmation_method' => 'manual',
    //         'confirm' => true,
    //         'use_stripe_sdk' => true,
    //         'payment_method_options' => [
    //             'card' => ['request_three_d_secure' => 'any']
    //         ],
    //         'automatic_payment_methods' => [
    //             'enabled' => true,
    //             'allow_redirects' => 'never'
    //         ],
    //         'return_url' => 'https://docs.stripe.com/payments/3d-secure/authentication-flow'
    //     ]);
    //     // dd($paymentIntent);

    //     if ($paymentIntent->status === 'requires_action' && isset($paymentIntent->next_action->redirect_to_url) && $paymentIntent->next_action->type === 'use_stripe_sdk') {
    //         // Redirect your customer to complete 3D Secure authentication
    //         dd('in requires_action if');
    //         if (isset($paymentIntent->next_action->redirect_to_url)) {
    //             return redirect($paymentIntent->next_action->redirect_to_url->url);
    //         } else {
    //             // Handle the case where redirect_to_url is not provided
    //             // This might occur if the next action type is different
    //         }
    //     } elseif ($paymentIntent->status === 'succeeded') {
    //         dd('in succeeded elseif');
    //         // Payment has already been successfully completed
    //         // You may want to perform additional actions here, such as updating your database
    //     } else {
    //         // Confirm the payment intent to finalize the payment
    //         try {
    //             $paymentIntent = $this->stripe->paymentIntents->confirm(
    //                 $paymentIntent->id,
    //                 ['payment_method' => $request->payment_method],
    //             );

    //             // Check if payment intent is successful after confirmation
    //             if ($paymentIntent->status === 'succeeded') {
    //                 echo  "suceess";
    //                 dd($paymentIntent);
    //                 // Payment is successful
    //                 // You may want to perform additional actions here, such as updating your database
    //             } else {
    //                 echo  "failed";
    //                 dd($paymentIntent);
    //                 // Payment confirmation failed
    //                 // Handle the failure
    //             }
    //         } catch (\Stripe\Exception\CardException $e) {
    //             dd($e->getMessage());
    //             // Handle card errors
    //         } catch (\Stripe\Exception\RateLimitException $e) {
    //             dd($e->getMessage());
    //             // Handle rate limit errors
    //         } catch (\Stripe\Exception\InvalidRequestException $e) {
    //             dd($e->getMessage());
    //             // Handle invalid request errors
    //         } catch (\Stripe\Exception\AuthenticationException $e) {
    //             dd($e->getMessage());
    //             // Handle authentication errors
    //         } catch (\Stripe\Exception\ApiConnectionException $e) {
    //             dd($e->getMessage());
    //             // Handle network communication errors
    //         } catch (\Stripe\Exception\ApiErrorException $e) {
    //             dd($e->getMessage());
    //             // Handle generic API errors
    //         }
    //     }


    //     // Payment is successful
    // } catch (\Stripe\Exception\CardException $e) {
    //     dd($e->getMessage());
    //     // Handle card errors
    // } catch (\Stripe\Exception\RateLimitException $e) {
    //     dd($e->getMessage());
    //     // Handle rate limit errors
    // } catch (\Stripe\Exception\InvalidRequestException $e) {
    //     dd($e->getMessage());
    //     // Handle invalid request errors
    // } catch (\Stripe\Exception\AuthenticationException $e) {
    //     dd($e->getMessage());
    //     // Handle authentication errors
    // } catch (\Stripe\Exception\ApiConnectionException $e) {
    //     dd($e->getMessage());
    //     // Handle network communication errors
    // } catch (\Stripe\Exception\ApiErrorException $e) {
    //     dd($e->getMessage());
    //     // Handle generic API errors
    // }

    $stripe = new \Stripe\StripeClient('sk_test_51OlrRUSEK4WUIp4LqZPNoKiWwMsqGNIW0ud66G2sBQRxZ2jXQJq4Hi165e7HkXZf7MpZ0M4IcqGVDR6F8fK2hNyJ008KmjK5YL');





    $stripe = new \Stripe\StripeClient('sk_test_51OlrRUSEK4WUIp4LqZPNoKiWwMsqGNIW0ud66G2sBQRxZ2jXQJq4Hi165e7HkXZf7MpZ0M4IcqGVDR6F8fK2hNyJ008KmjK5YL');
    $stripe->paymentIntents->confirm(
      'pi_3OmyVTSEK4WUIp4L0WeY8tiC',
      [
        'payment_method' => 'pm_card_visa',
        'return_url' => 'https://www.example.com',
      ]
    );


    // return back()->withSuccess('Payment done.');

  }

  public function success()
  {
    dd('hello');
  }



  // public function sendEmail()
  // {
  //   // return 1;
  //   $details = [
  //     'title' => 'Test Mail',
  //     'body' => 'This is For testing mail'
  //   ];

  //   Mail::to('recipient@yopmail.com')->send(new MyMail($details));

  //   return 'Email sent successfully.';
  // }



  public function dispatchJob()
  {


    // $user = User::create($userData);

    // event(new NewUserRegistered($user));
    //    $test =   ProcessMessage::dispatch();
    // // dd($test);
    //       return response()->json(['message' => 'Job dispatched successfully']);
  }
}

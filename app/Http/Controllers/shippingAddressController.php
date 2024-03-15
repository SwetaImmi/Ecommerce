<?php

namespace App\Http\Controllers;

use App\Models\Product as ModelsProduct;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Climate\Product as ClimateProduct;
use Stripe\Product;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\Console\Input\Input;

class shippingAddressController extends Controller
{
   public function processPayment(Request $request, String $product, $price){
      // return 1;
      // return $request->all();
   $user = Auth::user();

   $paymentMethod = $request->input('payment_method');
   $user->createOrGetStripeCustomer();
   $user->addPaymentMethod($paymentMethod);
   // $url = 'return_url' => 'http://127.0.0.1:8000/';
   try
   {
      // $user->charge($price*100, $paymentMethod,['off_session' => true]);
      $charge = $user
      ->charge()
      ->create(150.95, $paymentMethod,[
         'description' => 'Purchased Book!',
      ]);
      echo  "<pre>";
      print_r($charge);
      die();
   }
   catch (\Exception $e)
   {
   return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
   }
   return redirect('/');



   }

















   // public function __construct()
   // {
   //    Stripe::setApiKey(env('STRIPE_SECRET'));
   // }

   // public function show(Product $product)
   // {
   //    $user = User::find(1);
   //    return view('test', [
   //       'intent' => $user->createSetupIntent()
   //    ]);
   // }


   // public function purchase(Request $request, Product $product)
   // {


   //    try {
   //       $user = User::find(1);
   //       $user->charge([
   //          'amount' =>  1000,
   //          'payment_method' => 'pm_1OmZT8SEK4WUIp4Lgn8alTNk',
            
   //       ]);
   //    } catch (IncompletePayment $exception) {
   //       // Get the payment intent status...
   //       $exception->payment->status;

   //       // Check specific conditions...
   //       if ($exception->payment->requiresPaymentMethod()) {
   //          // ...
   //       } elseif ($exception->payment->requiresConfirmation()) {
   //          // ...
   //       }
   //       // $token = $request->payment_method;

   //       // $entity = User::find(1);
   //       // $entity->charge([1000, 'pm_1OmZT8SEK4WUIp4Lgn8alTNk',
   //       // 'automatic_payment_methods' => ['enabled' => true, 'allow_redirects' => 'never'],
   //       // ]);

   //       // Create the card
   //       // $card = $entity->card()->create($token);
   //       // return $card;
   //    }
   // }





















   public function address_view()
   {

      return view('home.address');
   }

   public function address_post(Request $request)
   {
      $request->validate([]);
      $address = new Shipping();
      $address->shipping_name = $request->firstname;
      $address->shipping_address = $request->address;
      $address->shipping_city = $request->city;
      $address->shipping_state = $request->state;
      $address->shipping_zip = $request->zip;
      $address->shipping_mobile = $request->phone;
      $address->shipping_nearby = $request->nearby;
      $address->user_id  = Auth()->user()->id;
      return redirect()->route('profile', ['id' => $request->id]);







      return 1;
   }
}

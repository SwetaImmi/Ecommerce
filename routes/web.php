<?php

use App\Events\MyEvent;
use App\Events\NewUserRegistered;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\shippingAddressController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\StripeSubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Jobs\SendEmailJob;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Pusher\Pusher;
use Symfony\Component\HttpFoundation\Response;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Authentication Route Start*/

Route::group(['middleware' => ['auth', 'customer']], function () {
    Route::controller(CartController::class)
        ->group(function () {
            Route::get('clist', 'cart_list')->name('cart.ist');
            Route::post('add_cart/{id}', 'add_cart')->name('cart.add');
            Route::post('/cart_update/{id}', 'cart_update');
            Route::get('cdelete/{id}', 'cart_delete');
            Route::get('destroy_all', 'all_delete');
        });

    Route::controller(FrontendController::class)
        ->group(function () {
            Route::get('e_commerce/{id}', 'single_product');
            Route::post('send-notification', 'notification')->name('notification');
            Route::post('customer_logout', 'logout')->name('customer_logout');
        });
    /* Admin Routes start  */
    Route::group(['prefix' => 'admin', 'middleware' => ['role']], function () {
        Route::controller(UserController::class)
            ->group(function () {
                Route::get('/register', 'create');
                Route::post('register_store', 'store');
                Route::post('logout', 'logout')->name('logout');
            });

        Route::controller(ProductController::class)
            ->group(function () {

                Route::get('/', 'index');
                Route::post('category_add', 'category_add');
                Route::get('/products', 'product');
                Route::post('product', 'product_add')->name('product');
                Route::get('/products_list', 'products_list');
                Route::get('products_edit/{id}', 'products_edit');
                Route::post('product_update/{id}', 'product_update')->name('product_update');
                Route::get('delete/{id}', 'product_delete');
                Route::get('/category', 'category');
            });

        Route::controller(BannerController::class)
            ->group(function () {
                Route::get('/banner', 'banner_view');
                Route::post('banner', 'banner_add')->name('banner');
                Route::get('banner_list', 'banner_list');
                Route::get('changeStatus', 'changeStatus')->name('changeStatus');
                Route::get('banner_delete/{id}', 'banner_delete');
                Route::post('/rating', 'postStar')->name('postStar');
            });
        Route::controller(GalleryController::class)
            ->group(function () {
                Route::get('gallery', 'gallery_show');
                Route::post('/image-upload', 'fileUpload')->name('imageUpload');
                Route::get('gallery_list', 'gallery_list_show');
            });

        Route::post('create_plans', [StripeSubscriptionController::class, 'plan_create']);
        Route::post('subscription_post', [StripeSubscriptionController::class, 'subscription_post']);
        Route::get('plans', [StripeSubscriptionController::class, 'index']);
        Route::get('plans/{plan}', [StripeSubscriptionController::class, 'show'])->name("plans.show");
        Route::post('subscription', [StripeSubscriptionController::class, 'subscription'])->name("subscription.create");
        Route::get('/invoice/preview', [StripeSubscriptionController::class, 'downloadInvoice'])->name('user.downloadInvoice');
        Route::get('plan_list', [StripeSubscriptionController::class, 'plan_list']);
        Route::get('create_subscription', [StripeSubscriptionController::class, 'create_subscription']);
        Route::get('refund/{id}', [StripeSubscriptionController::class, 'refund']);
        Route::get('payment_list', [StripeSubscriptionController::class, 'payment_list']);
        Route::get('subs_usr_list', [StripeSubscriptionController::class, 'subscribed_user_list']);
        Route::get('cancel_subs/{id}', [StripeSubscriptionController::class, 'cancel_subs']);
        Route::get('stripe_test/{id}', [StripeSubscriptionController::class, 'stripe_test']);
    });
    /* Admin Routes End  */
});
/* Authentication Route End*/

/* User Login Routes*/
Route::controller(UserController::class)
    ->group(function () {
        Route::get('/login', 'login_show')->name('login');
        Route::post('login_post', 'authenticate');
    });
// Customer View route Or Frontend route
Route::controller(FrontendController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('product', 'products_show')->name('search');
        Route::get('about', 'about_view');
        Route::get('register_Edit_view/{id}', 'register_Edit_view');
    });
// Customer signin and login Route
Route::controller(CustomerLoginController::class)
    ->group(function () {
        Route::get('signin', 'signUp_show');
        Route::post('signin/post', 'signUp_store');
        Route::get('customer_login', 'customer_login_viwe');
        Route::post('cust_login/post', 'customer_login');
    });
Route::controller(OrderController::class)
    ->group(function () {
        Route::post('order_placed/{id}', 'order_placed');
        Route::get('checkout/{id}', 'Checkout');
        Route::post('checkout/post', 'checkout_address');
        // 
        Route::post('placeOrder', 'placeOrder')->name('placeOrder');
        Route::get('/payment/{id}', 'charge')->name('goToPayment');
        Route::post('process-payment', 'processPayment')->name('processPayment');
    });
// Route::get('send_mail', [TestController::class, 'sendEmail']);
Route::get('/search', [UserController::class, 'index'])->name('search.index');
Route::get('/search/result', [UserController::class, 'result'])->name('search.result');

// Route::get('email_test', function () {

//     // $details['email'] = 'recipient@yopmail.com';
//     // $test['email'] = 'newswetaxxx@yopmail.com';
//     $details = ['newsweta@yopmail.com', 'aryanshi@yopmail.com', 'recipient@yopmail.com'];
//     SendEmailJob::dispatch($details);
//     // $test = SendEmailJob::dispatch()->onQueue('email'); // Code not run show few argument error
//     // dispatch(new App\Jobs\SendEmailJob(['details' =>$details,'test'=> $test]));
//     //   dd($test);
//     dd('done');
// });

// Route::get('test', function () {
//     // return event(new App\Events\PostLiked('hello world'));

// $tetst = event(new \App\Events\PostLiked('Someone'));
// return view('test_broadcasting');
// return ['success' => true];
// dd($tetst);
// return "Event has been sent!";
// });

// Route::get('test_event', function () {

//     // $pusher = new Pusher\Pusher(
//     //     env('a4d6ce470091e415caa5'),
//     //     env('6902f8bb9ed05b390496'),
//     //     env('1766902'),
//     //     array('cluster' => env('ap2'))
//     // );

//     // $pusher->trigger(
//     //     'status-liked',
//     //     'UserEvent',
//     //     'Welcome'
//     // );
//     // $test =   NewUserRegistered::dispatch($username);
// 	$test = event(new App\Events\NewUserRegistered('Someone'));
//     // return $test;
//     // return view('test_broadcasting');
// 	return "Event has been sent!";
// });

Route::get('/welcome', [TestController::class, 'notification']);

Route::post('send_notification', function (Request $request) {
    event(new \App\Events\PostLiked($request->message));
    // $message = Pusher::trigger('notification', 'PushNotification', ['msg' => $request->message]);
    //     return $message;
    return [
        'success' => true,
        'msg' => Auth::user()->name . ":liked your status",
        'name' => Auth::user()->name
    ];
});

// Route::view('/welcome','getNotification');
// Route::post('send-message',function (Request $request){
//    $test = event(new Message($request->username, $request->message));
//    return  $test;
//     return ['success' => true];
// });



Route::get('/Relationship', [TestController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

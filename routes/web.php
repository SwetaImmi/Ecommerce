<?php

use App\Events\NewUserRegistered;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripeSubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Route::controller(WishlistController::class)
    ->group(function () {
        Route::post('wlist', 'index')->name('wlist');
        Route::get('wishlist', 'wishlist_chart')->name('wishlist');
        Route::get('removeWishlist/{id}', 'removeFromWishlist');
    });
/* Authentication Route Start*/
Route::group(['middleware' => ['auth', 'customer']], function () {
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    Route::post('new_subscriber', [StripeSubscriptionController::class, 'new_subscriber']);
    Route::get('plans', [StripeSubscriptionController::class, 'index']);
    Route::get('plans/{id}', [StripeSubscriptionController::class, 'show'])->name("plans.show");
    Route::post('subscription', [StripeSubscriptionController::class, 'subscription'])->name("subscription.create");
    Route::controller(FrontendController::class)
        ->group(function () {
            Route::post('send-notification', 'notification')->name('notification');
            Route::post('customer_logout', 'logout')->name('customer_logout');
        });
    /* Order Routes Start*/
    Route::controller(OrderController::class)
        ->group(function () {
            Route::post('checkout/post', 'checkout_address');
            Route::get('edit_adderess/{id}', 'edit_address');
            Route::post('update_address/{id}', 'update_address');
            Route::get('/cartCheckout',  'cartCheckout')->name('cartCheckout');
            Route::post('placeOrder', 'cartPlaceOrder')->name('placeOrder');
            Route::get('/cart_payment/{id}/{quantity}', 'cart_charge')->name('cartToPayment');
            Route::post('cart-process-payment', 'cart_process_payment')->name('cart_process_payment');
            // single_placeOrder
            Route::get('checkout/{id}', 'Checkout');
            Route::post('single_placeOrder', 'single_placeOrder')->name('single_placeOrder');
            Route::get('/payment/{id}', 'charge')->name('goToPayment');
            Route::post('process-payment', 'processPayment')->name('processPayment');
        });
    /* Admin Routes start  */
    Route::group(['prefix' => 'admin', 'middleware' => ['role']], function () {
        Route::controller(UserController::class)
            ->group(function () {
                Route::get('/register', 'create');
                Route::post('register_store', 'store');
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
        Route::get('/invoice/preview', [StripeSubscriptionController::class, 'downloadInvoice'])->name('user.downloadInvoice');
        Route::get('plan_list', [StripeSubscriptionController::class, 'plan_list']);
        Route::get('create_subscription', [StripeSubscriptionController::class, 'create_subscription']);
        Route::get('refund/{id}', [StripeSubscriptionController::class, 'refund']);
        Route::get('payment_list', [StripeSubscriptionController::class, 'payment_list'])->name('payment_list');
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
        Route::get('e_commerce/{id}', 'single_product');
    });
// Cart Routes 
Route::controller(CartController::class)
    ->group(function () {
        Route::get('clist', 'cart_list')->name('cart.ist');
        Route::post('add_cart/{id}', 'add_cart')->name('cart.add');
        Route::post('/cart_update/{id}', 'cart_update');
        Route::get('cdelete/{id}', 'cart_delete');
        Route::get('destroy_all', 'all_delete');
        Route::get('remove_allCart', 'removeAllFromCart');
        Route::get('removeCart/{id}', 'removeFromCart');
    });
// Customer signin and login Route
Route::controller(CustomerLoginController::class)
    ->group(function () {
        Route::get('signin', 'signUp_show');
        Route::post('signin/post', 'signUp_store');
        Route::get('customer_login', 'customer_login_viwe');
        Route::post('cust_login/post', 'customer_login');
    });
Route::get('/search', [UserController::class, 'index'])->name('search.index');
Route::get('/search/result', [UserController::class, 'result'])->name('search.result');

// DUMMY ROUTES
// Rough Routes
/* Relationship Start */
Route::get('/Relationship', [TestController::class, 'index']);
/* Relationship End */
/*Send Notification Start  */
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
/*Send Notification End  */
/* Queue job Start*/
Route::get('email_test', [TestController::class, 'index_queue']);
/* Queue Job End*/
// Route::view('/welcome','getNotification');
Route::post('send-message', function (Request $request) {
    $test = event(new NewUserRegistered($request->username, $request->message));
    return  $test;
    return ['success' => true];
});
Route::view('addtocart', 'Testing.home');
Route::post('test_submit', [TestController::class, 'test_submit']);
Route::post('add_to_cart', [CartController::class, 'addtocart']);
Route::get('/relation_test', [TestController::class, 'Relationship_belongs_to']);
Route::get('/showLayout', [UserController::class, 'showLayout']);

// Function to render notifications from localStorage
function renderNotifications() {
    let notifications = JSON.parse(localStorage.getItem('notifications')) || [];
    let dropdownMenu = $('.dropdown-notifications .dropdown-menu');
    dropdownMenu.empty(); // Clear existing notifications

    notifications.forEach((notification, index) => {
        // Create HTML for notification
        let notificationHtml = `
            <li class="notification" data-index="${index}">
                <div class="media">
                    <div class="media-body">
                        <strong class="notification-title">${notification.msg}</strong>
                        <div class="notification-meta">
                            <small class="timestamp">${notification.timestamp}</small>
                        </div>
                    </div>
                </div>
            </li>
        `;
        dropdownMenu.append(notificationHtml); // Append notification to dropdown menu
    });

    // Update notifications count
    let notificationsCount = notifications.length;
    $('.notif-count').text(notificationsCount);

    // Show notifications dropdown if there are notifications
    if (notificationsCount > 0) {
        $('.dropdown-notifications').show();
    } else {
        $('.dropdown-notifications').hide();
    }

    // Add click event listener to each notification item
    $('.notification').click(function() {
        let index = $(this).data('index');
        removeNotification(index);
    });
}

// Function to remove a notification by index
function removeNotification(index) {
    let notifications = JSON.parse(localStorage.getItem('notifications')) || [];
    notifications.splice(index, 1); // Remove notification from array

    // Update localStorage with updated notifications
    localStorage.setItem('notifications', JSON.stringify(notifications));

    // Re-render notifications to update UI
    renderNotifications();
}

// Call renderNotifications() when the page loads to display existing notifications
renderNotifications();




// Function to clear notifications from localStorage and UI
function clearNotifications() {
    // Clear notifications from localStorage
    localStorage.removeItem('notifications');

    // Clear notifications from UI
    let dropdownMenu = $('.dropdown-notifications .dropdown-menu');
    dropdownMenu.empty(); // Clear existing notifications

    // Update notifications count
    $('.notif-count').text('0');

    // Hide notifications dropdown
    $('.dropdown-notifications').hide();
}

// Bind the clearNotifications() function to the "Clear All" button click event
$('#clear_notifications_button').click(function() {
    clearNotifications();
});




// function () {

//     $details['email'] = 'recipient@yopmail.com';
//     // $test['email'] = 'newswetaxxx@yopmail.com';
//     // $details = ['newsweta@yopmail.com', 'aryanshi@yopmail.com', 'recipient@yopmail.com'];
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
// }


// CARTB ROUGH

// public function addtocart(Request $request)
// {

//     $prod_id = $request->input('product_id');
//     $quantity = $request->input('quantity');

//     if (Cookie::get('shopping_cart')) {
//         $cookie_data = stripslashes(Cookie::get('shopping_cart'));
//         $cart_data = json_decode($cookie_data, true);
//     } else {
//         $cart_data = array();
//     }

//     $item_id_list = array_column($cart_data, 'item_id');
//     $prod_id_is_there = $prod_id;

//     if (in_array($prod_id_is_there, $item_id_list)) {
//         foreach ($cart_data as $keys => $values) {
//             if ($cart_data[$keys]["item_id"] == $prod_id) {
//                 $cart_data[$keys]["item_quantity"] = $request->input('quantity');
//                 $item_data = json_encode($cart_data);
//                 $minutes = 60;
//                 Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
//                 return response()->json(['status' => '"' . $cart_data[$keys]["item_name"] . '" Already Added to Cart', 'status2' => '2']);
//             }
//         }
//     } else {
//         $products = Product::find($prod_id);
//         $prod_name = $products->name;
//         $prod_image = $products->image;
//         $priceval = $products->price;

//         if ($products) {
//             $item_array = array(
//                 'item_id' => $prod_id,
//                 'item_name' => $prod_name,
//                 'item_quantity' => $quantity,
//                 'item_price' => $priceval,
//                 'item_image' => $prod_image
//             );
//             $cart_data[] = $item_array;

//             $item_data = json_encode($cart_data);
//             $minutes = 60;
//             Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
//             return response()->json(['status' => '"' . $prod_name . '" Added to Cart']);
//         }
//     }
// }

// public function cartloadbyajax()
// {
//     if (Cookie::get('shopping_cart')) {
//         $cookie_data = stripslashes(Cookie::get('shopping_cart'));
//         $cart_data = json_decode($cookie_data, true);
//         $totalcart = count($cart_data);

//         echo json_encode(array('totalcart' => $totalcart));
//         die;
//         return;
//     } else {
//         $totalcart = "0";
//         echo json_encode(array('totalcart' => $totalcart));
//         die;
//         return;
//     }
// }

// public function index()
// {
//     $cookie_data = stripslashes(Cookie::get('shopping_cart'));
//     return $cart_data = json_decode($cookie_data, true);
//     return view('frontend.cart')
//         ->with('cart_data', $cart_data);
// }



    /*

Exception Check

*/

public function index()
{
    return view('search');
}

// public function result(Request $request)
// {
//     try {
//         // $user = User::findOrFail($request->user_id);
//         $user = Gallery::with('product')->get();
//         return view('result', compact('user'));
//     } catch (ModelNotFoundException $exception) {
//         return back()->withError('User with ID: '.$request->user_id.' not found!')->withInput();
//     } catch (RelationNotFoundException $exception) {
//         return back()->withError($exception->getMessage())->withInput();
//     }
// }

//     public function result(Request $request)
// {
//     try {
//         $user = User::findOrFail($request->user_id);

//         return view('result', compact('user'));
//     } catch(Exception $exception) {
//         $message = $exception->getMessage();

//         if($exception instanceof ModelNotFoundException) {
//             $message = 'User with ID: '.$request->user_id.' not found!';
//         }

//         return back()->withError($message)->withInput();
//     }
// }

public function result(Request $request)
{
    $user = User::find($request->user_id);

    return view('result', compact('user'));
}

/*

Exception Check

*/



// FrontendController


    // public function notification(Request $request)
    // {
    //     $notify = new Notification();
    //     $notify->user_id  = Auth::user()->id;
    //     $notify->product_id   = $request->message;
    //     $notify->type      = 1;
    //     $notify->read  = 1;
    //     $notify->save();
    //     // return $notify;

    //     event(new \App\Events\PostLiked($request->message));
    //     // return $message;
    //     return [
    //         'success' => true,
    //         'msg' => Auth::user()->name . ":liked your status",
    //         'name' => Auth::user()->name,
    //         'notify' => $notify,
    //     ];
    //     // $product = Product::all();
    //     // return view('notification',['product' =>  $product]);
    // }




    // public function newxxx(Request $request)
    // // {
    // //     $product = Product::all();
    // //     return view('Rough.test',compact('product'));
    // // }
    // {
    //     // return 1;
    //     $products = Product::find(1)->buy;
    //     $product = Buy::find(1)->produts();
    //     $gallery =  Buy::with('produts')->get();
    //     // $products = Product::find(2)->gallery;
    //     // $product = Gallery::find(2)->product()->get();
    //     dd($product);
    //     $cart = Cart::find(1)->product()->get();
    //     dd($products);
    //     //  $product->id;
    //     // $cart = Cart::with('product')->get( );
    //     $cart = Category::with('category_id')->get();

    //     // echo "<pre>";
    //     // print_r($cart);
    //     // die();

    //     return view('welcome', compact('cart'));

    //     // $cart = Cart::find(1)->products()->product_name;
    //     // $cat


    // }


    // BANNER CONTROLLER

    
    public function postStar(){
        return 1;
    }



public function newxxx(Request $request)
// {
//     $product = Product::all();
//     return view('Rough.test',compact('product'));
// }
{
    return 1;
    $gallery =  Gallery::with('product')->get();
    $products = Product::find(2)->gallery;
    $product = Gallery::find(2)->product()->get();
    // dd($product);
    $cart = Cart::find(1)->product()->get();
    dd($gallery);
    //  $product->id;
    // $cart = Cart::with('product')->get( );
    $cart = Category::with('product_category')->get();

    // echo "<pre>";
    // print_r($cart);
    // die();

    return view('welcome', compact('cart'));

    // $cart = Cart::find(1)->products()->product_name;
    // $cat
  
// 
// }

// CUSTOMERLOGINCONTROLLER

public function customer_login_viwe()
{
    return view('home.cust_login');
}

public function customer_login(Request $request)
{

    $credentials = $request->validate([
        'email' => ['required'],
        //    'phone' => ['required'],
        'password' => ['required'],
    ]);

    $check = $request->only('email', 'password');
    $remember_me = $request->has('remember_me') ? true : false;

    $login = request()->input('email');

    $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

    request()->merge([$fieldType => $login]);
    if (
        // Auth::attempt(['mobile' => request('email'), 'password' => request('password')]) ||
        // Auth::attempt(['email' => request('email'), 'password' => request('password')]) ||
        // Auth::attempt(['name' => request('name'), 'password' => request('password')])|| 
        Auth::attempt($credentials, $check, $remember_me)
        //  Auth::attempt(['anyOtherField' => request('anyOtherField'), 'password' => request('password')]) 
    )
    // (Auth::attempt($credentials, $check)) 
    {

      $data =  $request->session()->regenerate();
      dd($data);

        // //    return 1;
        // return redirect()->intended('/')->withSuccess('You have logged In successfully!');
        // if (Auth::check()) {

        //     $session_id = Session::getId();
        //     // $cartObj = Cart::session('_token')->getContent();

        //     if (Auth::guest()) {
        //         session()->flash('guest_cart', [
        //             'session' => $session_id,
        //             // 'data' => $cartObj
        //         ]);
        //     }

            return redirect()->intended('clist')->withSuccess('You have logged In successfully!');
            // dd(Auth::check());
            // dd(session()->all());   
        }
    // } else {
        return 0;
        // return redirect()->intended('/admin')->withSuccess('You have logged In successfully!');
        return redirect('login_view')->withError('Invalid Email address or Password');
    // }
    // print_r($request);
    // die("dhgf");
}


// OrderController

public function placeOrder(Request $request)
{
    // return  $request->total_id;
    $paymentMode = $request->paymentMethod;
    if ($paymentMode == 'card_payment') {
        return redirect()->route('cartToPayment', ['id' => $request->total_amount,'quantity' => $request->total_quantity]);
    } else {
        // Address update

        $check =  $request->sameadr;
        if ($check) {
            $request->validate([
                'shipping_name'  => 'required',
                'shipping_address'  => 'required',
                'shipping_city'  => 'required',
                'shipping_state'  => 'required',
                'shipping_zip'  => 'required',
                'shipping_mobile'  => 'required',
                'shipping_nearby'  => 'required',
            ]);
            $address = Shipping::find($request->address_id);
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
            $address->user_id              =     Auth::user()->id;
            $address->save();
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
        }


        $order = new Order();
        $order->user_id  = Auth::user()->id;
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
             $orderDetails->product_price =  $orderDetail['product_price']*$orderDetail['product_quantity'];
             $orderDetails->order_id = $order->id;
             $orderDetails->save();
          
        }

    }

    // Clear the cart items for the authenticated user
    if (Auth::check()) {
        Cart::where('user_id', Auth::id())->delete();
    }
    //  Trigger the event  order_email
    event(new OrderPlaced($order));
    return view("home.payment_success", ['order' => $order, 'address' => $address]);
}


{
    // return  $request->total_id;
    // $paymentMode = $request->paymentMethod;
    // if ($paymentMode == 'card_payment') {
    //     // return 1;$request->all();
    //     return redirect()->route('cartToPayment', ['id' => $request->total_amount,'quantity' => $request->total_quantity]);
    // } else {
    //     // Address update

    //     $check =  $request->sameadr;
    //     if ($check) {
    //         $request->validate([
    //             'shipping_name'  => 'required',
    //             'shipping_address'  => 'required',
    //             'shipping_city'  => 'required',
    //             'shipping_state'  => 'required',
    //             'shipping_zip'  => 'required',
    //             'shipping_mobile'  => 'required',
    //             'shipping_nearby'  => 'required',
    //         ]);
    //         $address = Shipping::find($request->address_id);
    //         $address->shipping_name        =     $request->shipping_name;
    //         $address->shipping_address     =     $request->shipping_address;
    //         $address->shipping_city        =     $request->shipping_city;
    //         $address->shipping_state       =     $request->shipping_state;
    //         $address->shipping_zip         =     $request->shipping_zip;
    //         $address->shipping_mobile      =     $request->shipping_mobile;
    //         $address->shipping_nearby      =     $request->shipping_nearby;
    //         $address->billing_name         =     $request->shipping_name;
    //         $address->billing_address      =     $request->shipping_address;
    //         $address->billing_city         =     $request->shipping_city;
    //         $address->billing_state        =     $request->shipping_state;
    //         $address->billing_zip          =     $request->shipping_zip;
    //         $address->billing_mobile       =     $request->shipping_mobile;
    //         $address->billing_nearby       =     $request->shipping_nearby;
    //         $address->user_id              =     Auth::user()->id;
    //         $address->save();
    //     } else {
    //         $request->validate([
    //             'firstname'  => 'required',
    //             'address'  => 'required',
    //             'city'  => 'required',
    //             'state'  => 'required',
    //             'zip'  => 'required',
    //             'phone'  => 'required',
    //             'nearby'  => 'required',
    //             'billing_name'   =>   'required',
    //             'billing_address'   =>   'required',
    //             'billing_city'   =>   'required',
    //             'billing_state'   =>   'required',
    //             'billing_zip'   =>   'required',
    //             'billing_phone'   =>   'required',
    //             'billing_nearby'   =>   'required',
    //         ]);
    //         $address = new Shipping();
    //         $address->shipping_name        =     $request->shipping_name;
    //         $address->shipping_address     =     $request->shipping_address;
    //         $address->shipping_city        =     $request->shipping_city;
    //         $address->shipping_state       =     $request->shipping_state;
    //         $address->shipping_zip         =     $request->shipping_zip;
    //         $address->shipping_mobile      =     $request->shipping_mobile;
    //         $address->shipping_nearby      =     $request->shipping_nearby;
    //         $address->billing_name         =     $request->billing_name;
    //         $address->billing_address      =     $request->billing_address;
    //         $address->billing_city         =     $request->billing_city;
    //         $address->billing_state        =     $request->billing_state;
    //         $address->billing_zip          =     $request->billing_zip;
    //         $address->billing_mobile       =     $request->billing_phone;
    //         $address->billing_nearby       =     $request->billing_nearby;
    //         $address->user_id              = Auth::user()->id;
    //         $address->save();
    //     }

    $address = Shipping::where('user_id', Auth()->user()->id)->first();

        $order = new Order();
        $order->user_id  = Auth::user()->id;
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
             $orderDetails->product_price =  $orderDetail['product_price']*$orderDetail['product_quantity'];
             $orderDetails->order_id = $order->id;
             $orderDetails->save();
          
        // }

    }

    // Clear the cart items for the authenticated user
    if (Auth::check()) {
        Cart::where('user_id', Auth::id())->delete();
    }
    //  Trigger the event  order_email
    event(new OrderPlaced($order));
    return view("home.payment_success", ['order' => $order, 'address' => $address]);
}


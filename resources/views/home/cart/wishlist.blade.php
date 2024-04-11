@extends('home.layout.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">

      <!-- alert -->
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
      </div>
      @endif
      @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <strong>{{ $message }}</strong>
      </div>
      @endif
      <!-- alert -->

      <h4 class="card-title">WishList Table</h4>
      <p class="card-description">
        <!-- <a href="" class="btn btn-inverse-success  btn-fw">ADD PRODUCT</a> -->
      </p>
      <div class="table-responsive">
        <table class="table table-striped">
          @if(!empty($wishlist))
          <thead>
            <tr>
              <th>#</th>
              <th>
                Product Image
              </th>
              <th>
                Product Name
              </th>
              <th>
                Amount
              </th>
              <th>
                Actions
              </th>
            </tr>
          </thead>
          <hr>
          @foreach($products as $product)
          @foreach($wishlist as $item)
          @if($product->id == $item['product_id'] )
          <tbody>
            <tr>
              <td style="height: 150px; width: 250px;">
                <a onclick="return confirm('Are you sure?')" class="btn btn-inverse-danger btn-fw center-justify" href="{{ url('removeWishlist').'/'. $item['product_id']}}" role="button">
                  <i style="color: orangered;" class="fas fa-trash">
                  </i>
                </a>
              </td>
              <td class="py-1">
                <a href="{{url('e_commerce').'/'.$item['product_id']}}">
                  <img src="{{asset('uploads/'.$item['product_image'])}}" alt="image" style="height: 150px; width:150px; border-radius:20px;" />
                </a>
              </td>
              <td style="height: 150px; width: 200px;">
                {{ $item['product_name'] }}
              </td>

              <td style="height: 150px; width: 200px;">
                {{ $item['product_price']}}
              </td>
              <td>

                <form action="{{route('cart.add', $product->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" value="{{ $product->id }}" name="pid">
                  <input type="hidden" value="{{ $product->product_name }}" name="product_name">
                  <input type="hidden" value="{{ $product->product_price }}" name="product_price">
                  <input type="hidden" value="{{ $product->product_image }}" name="product_image">
                  <input type="hidden" value="{{ $product->product_id }}" name="category">
                  <input type="hidden" value="1" name="quantity">
                  <!-- <input class="product_quantity" type="number" value="1" name="quantity" style="float: none; margin-top: 30px; margin-right: 5px;"> -->
                  <button style="margin-top: 20px; "><img src="{{asset('assets1/images/shopping-cart.png')}}" alt="" style="height: 30px; width:25px">Move to Cart</button>
                </form>
              </td>
            </tr>
          </tbody>
          @endif
          @endforeach
          @endforeach
          </p>
          @else
          <h1 style="margin-top: 25px;"> Not found</h1>
          @endif
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
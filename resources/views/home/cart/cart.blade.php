@extends('home.layout.app')
@section('content')
@php
$totalAmount = 0;
$itemCount = 0;
@endphp
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

      <h4 class="card-title">Product Table</h4>
      <p class="card-description">
        <!-- <a href="" class="btn btn-inverse-success  btn-fw">ADD PRODUCT</a> -->
      </p>
      <div class="table-responsive">
        @if(Auth()->user())

        <table class="table table-striped">
          <thead>
            <tr>
              <th>
                Product Image
              </th>
              <th>
                Product Name
              </th>
              <th>
                Product Categoty
              </th>
              <th>
                Quantity
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
          @foreach($cart as $item)
          @if(Auth()->user()->email == $item->email)
          <tbody>
            <tr>
              <td class="py-1">
              <a href="{{url('e_commerce').'/'.$item->product->id}}">
                <img src="{{asset('uploads/'.$item->product->product_image)}}" alt="image" style="height: 50px; width:50px;" />
                </a>
              </td>
              <td>
                {{$item->product->product_name}}
              </td>
              <td>
                @if($item->product->category_id == 1)
                <p>Men</p>
                @elseif($item->product->category_id == 2)
                <p>Women</p>
                @else
                <p>Kid's</p>
                @endif
              </td>
              <td class=" mt-6 md:justify-end md:flex">
                <div class="h-10 w-28">
                  <div class="relative flex flex-row w-full h-8">

                    <form action="{{ url('cart_update').'/'. $item->id  }}" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{ $item->id}}">
                      <input type="number" min="1" name="quantity" value="{{$item->product_quantity}}" class="w-6 text-center bg-gray-300" style="width: 50px;" />
                      <button type="submit" class="btn btn-secondry btn-rounded btn-icon"><img src="{{url('assets1/images/updated.png')}}" alt="" style="width: 20px;"></button>
                    </form>
                  </div>
                </div>
              </td>
              <td>
                $ {{$item->product->product_price*$item->product_quantity }}
              </td>
              <td>
                <a onclick="return confirm('Are you sure?')" class="btn btn-inverse-danger btn-fw" href="{{ url('cdelete').'/'. $item->id}}" role="button">
                  <i class="fas fa-trash">
                  </i>
                  Remove
                </a>
              </td>
              @php
              $totalAmount += $item->product->product_price*$item->product_quantity;
              $itemCount += $item->product_quantity;
              @endphp
            </tr>
          </tbody>
          @endif
          @endforeach
          <p>Total Items: {{ $itemCount }}&nbsp;
            <span>Total Amount: {{ $totalAmount }}
            </span>
          </p>
          <div>
            <div class="row">
              <a class="btn btn-info btn-fw" href="{{url('cartCheckout')}}" role="button" style="margin-left: 20px;">Purchase all Cart </a>
              <a  href="{{ url()->previous() }}"  style="margin-left: 1050px;">Back </a>
            </div>
          </div>
        </table>

        @else

        <table class="table table-striped">
          @if(!empty($cart))
          <thead>
            <tr>
              <th>
                Product Image
              </th>
              <th>
                Product Name
              </th>
              <th>
                Quantity
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
          @php
          $totalCount = 0;
          $totalAmount = 0;
          @endphp
          @foreach($cart as $item)
          <tbody>
            <tr>
              <td class="py-1">
              <a href="{{url('e_commerce').'/'.$item['product_id']}}">
                <img src="{{asset('uploads/'.$item['product_image'])}}" alt="image" style="height: 50px; width:55px; border-radius:20px;" />
              </a>
              </td>
              <td>
                {{ $item['product_name'] }}
              </td>

              <td>
                {{ $item['product_quantity'] }}
              </td>
              <td>
                {{ $item['product_price']*$item['product_quantity'] }}
              </td>
              <td>
                <a onclick="return confirm('Are you sure?')" class="btn btn-inverse-danger btn-fw" href="{{ url('removeCart').'/'. $item['product_id']}}" role="button">
                  <i class="fas fa-trash">
                  </i>
                  Remove
                </a>
              </td>
            </tr>
          </tbody>
          @php
          $totalCount += $item['product_quantity'];
          $totalAmount += $item['product_price']*$item['product_quantity'];
          @endphp
          @endforeach
          <p>Total Items: {{ $totalCount }}
            <span>Total Amount: {{ $totalAmount }}</span>
          </p>
          <div>
            <a class="btn btn-danger btn-fw" href="{{url('remove_allCart')}}" role="button">Clear all Cart </a>
            <a class="btn btn-info btn-fw" href="{{url('cartCheckout')}}" role="button">Purchase all Cart </a>
          </div>
          @else
          <h1 style="margin-top: 25px;"> Not found</h1>
          @endif
        </table>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
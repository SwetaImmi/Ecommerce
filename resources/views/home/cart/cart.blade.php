@extends('admin.layouts.app')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">

      <!-- aklert -->
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
              <th></th>
              <th></th>
            </tr>
          </thead>
{{Auth()->user()->email}}
         
          @foreach($cart as $item)
          @if(Auth()->user()->email ==  $item->email)
          <tbody>
            <tr>
              <td class="py-1">
                <img src="{{asset('uploads/'.$item->product->product_image)}}" alt="image" />

              </td>
              <td>
                {{$item->product->product_name}}
              </td>
              <td>
                {{$item->product->product_category}}
              </td>

              <td class=" mt-6 md:justify-end md:flex">
                <div class="h-10 w-28">
                  <div class="relative flex flex-row w-full h-8">

                    <form action="{{ url('cart_update').'/'. $item->id  }}" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{ $item->id}}">
                      <input type="number" name="quantity" value="{{$item->product_quantity}}" class="w-6 text-center bg-gray-300" style="width: 50px;" />
                      <button type="submit" class="btn btn-secondry btn-rounded btn-icon"><img src="assets1/images/updated.png" alt=""></button>
                    </form>
                  </div>
                </div>
              </td>
              <td>
                $ {{$item->product->product_price*$item->product_quantity }}
              </td>
              <td>

                <!-- <a class="btn btn-inverse-warning btn-fw" href="{{ url('products_edit').'/'. $item->id}}" role="button">
                  <i class="fas fa-trash">
                  </i>
                  Edit
                </a> -->
                <a onclick="return confirm('Are you sure?')" class="btn btn-inverse-danger btn-fw" href="{{ url('cdelete').'/'. $item->id}}" role="button">
                  <i class="fas fa-trash">
                  </i>
                  Remove
                </a>
              </td>
            </tr>

          </tbody>
          @endif
          @endforeach
     
          <a class="btn btn-inverse-danger btn-fw" href="destroy_all" role="button">Clear all Cart </a>

        </table>


      </div>
    </div>
  </div>
</div>

@endsection
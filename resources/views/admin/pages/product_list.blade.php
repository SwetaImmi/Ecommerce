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

        <a href="products" class="btn btn-inverse-success  btn-fw">ADD PRODUCT</a>
      </p>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>
                 Image
              </th>
              <th>
                 Name
              </th>
              <th>
                 Description
              </th>
              <th>
                Quantity
              </th>
              <th>
                Amount
              </th>
              <th>
                Gallery Link
              </th>
              <th>
                Actions
              </th>
              <th></th>
            </tr>
          </thead>
          @foreach($product as $item)
          <tbody>
            <tr>
              <td class="py-1">
                <img src="{{asset('uploads/'.$item->product_image)}}" alt="image" style="border-radius: 20%; height:50px; width:50px;" />

              </td>
              <td>
                {{$item->product_name}}
              </td>
              <td>
                {{$item->product_description}}
              </td>
              <td>
                {{$item->product_quantity}}
              </td>
              <td>
                $ {{$item->product_price}}
              </td>
              <td>
                <a href="gallery_list">Gallery List</a>
              </td>
              <td>

                <a class="btn btn-inverse-warning btn-fw" href="{{ url('admin/products_edit').'/'. $item->id}}" role="button">
                  <i class="fas fa-trash">
                  </i>
                  Edit
                </a>

                <a onclick="return confirm('Are you sure?')" class="btn btn-inverse-danger btn-fw" href="{{ url('admin/delete').'/'. $item->id}}" role="button">
                  <i class="fas fa-trash">
                  </i>
                  Delete
                </a>
              </td>
            </tr>

          </tbody>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
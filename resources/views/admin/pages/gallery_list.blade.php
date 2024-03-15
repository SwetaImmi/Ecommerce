@extends('admin.layouts.app')
@section('content')
<?php if (Auth::check()) {
    if (Auth::user()->role == 'Admin') { // if the current role is Administrator
?>
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

                    <h4 class="card-title">GALLERY Table</h4>
                    <p class="card-description">

                        <a href="gallery" class="btn btn-inverse-success  btn-fw">ADD GALLERY</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Product Image
                                    </th>
                                    <th>
                                        Gallery Image
                                    </th>
                                    <th>
                                        User Email
                                    </th>

                                    <th>
                                        Actions
                                    </th>
                                    <th>
                                    </th>
                                    <th>
                                        
                                    </th>
                                </tr>
                            </thead>

                            @foreach($gallery as $item)
                     
     

                            <tbody>
                                <tr>
                                    <td class="py-1">

                                        <img src="{{asset('uploads/'.$item->products->product_image)}}" alt="image" style="width: 100px;    height: 100px;    border-radius: 20%" />

                                    </td>

                                    <td>
                                        @if($item->products_id)
                                        <?php $product_images = json_decode($item->product_gallery_image); ?>


                                        <img src="{{asset('uploads/'.$product_images[0])}}" alt="image" style="width: 60px;    height: 60px;    border-radius: 20%" />
                                        <img src="{{asset('uploads/'.$product_images[1])}}" alt="image" style="width: 60px;    height: 60px;    border-radius: 20%" />
                                        <img src="{{asset('uploads/'.$product_images[2])}}" alt="image" style="width: 60px;    height: 60px;    border-radius: 20%" />
                                        @endif
                                    </td>

                                    <td>
                                        {{$item->email}}
                                    </td>

                                    <td>

                                        <a onclick="return confirm('Are you sure you want to Delete ID :   {{$item->id}}')" class="btn btn-inverse-danger btn-fw" href="{{ url('banner_delete').'/'. $item->id}}" role="button">
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
<?php
    }
}

?>



@endsection
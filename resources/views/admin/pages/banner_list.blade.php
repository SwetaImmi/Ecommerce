@extends('admin.layouts.app')
@section('content')
<?php if (Auth::check()) {
    if (Auth::user()->role == 'Admin') { // if the current role is Administrator
?>
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

                    <h4 class="card-title">Banner Table</h4>
                    <p class="card-description">

                        <a href="banner" class="btn btn-inverse-success  btn-fw">ADD BANNER</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Banner Image
                                    </th>
                                    <th>
                                        Banner Side Image
                                    </th>
                                    <th>
                                        User Email
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                    <th>
                                    </th>
                                    <th>

                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach($banner as $item)
                            <tbody>
                                <tr>
                                    <td class="py-1">
                                        <img src="{{asset('banners/'.$item->main_banner_image)}}" alt="image" 
                                        style="width: 100px;    height: 100px;    border-radius: 20%" />

                                    </td>
                                    <td>
                                    <img src="{{asset('banners/'.$item->first_banner_image)}}" alt="image" style="width: 60px;    height: 60px;    border-radius: 20%"/>
                                    <img src="{{asset('banners/'.$item->second_banner_image)}}" alt="image" style="width: 60px;    height: 60px;    border-radius: 20%"/>
                                    <img src="{{asset('banners/'.$item->third_banner_image)}}" alt="image" style="width: 60px;    height: 60px;    border-radius: 20%"/>
                                    <img src="{{asset('banners/'.$item->last_banner_image)}}" alt="image" style="width: 60px;    height: 60px;    border-radius: 20%"/>
                                    </td>

                                    <td>
                                        {{$item->email}}
                                    </td>
                                    <td>
                                        <input id="checkbox" data-id="{{$item->id}}" class="toggle-class" type="checkbox" {{ $item->status ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-left">

                                        <a onclick="return confirm('Are you sure you want to Delete ID :   {{$item->id}}')" class="btn btn-inverse-danger btn-fw" href="{{ url('admin/banner_delete').'/'. $item->id}}" role="button">
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
<!-- ajax $ not defined -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- ajax $ not defined -->
<script>
    $(document).ready(function() {
        $('.toggle-class').click(function() {
            // alert("xxx");
            var url = "{{ route('changeStatus') }}";
            var status = $(this).prop('checked') == true ? 1 : 0;
            var status_un = $('#checkbox').not(this).prop('checked', false).val();

            // var status = $(this).prop('checked') == false ? 1 : 0;

            var user_id = $(this).data('id');
            alert(status);
            alert(status_un);

            $.ajax({
                type: "GET",
                dataType: "json",
                enctype: 'multipart/form-data',
                url: url,
                data: {
                    'status_un': status_un,
                    'status': status,
                    'user_id': user_id,
                },


                success: function(data) {
                    console.log(data.success)
                    location.reload();
                }
            });

        });
    });

    function toggle(chkBox) {
        alert();
        checkboxes = document.getElementById("checkbox").childNodes;
        var isChecked = chkBox.checked; //this just changed, so it really is whether the box wasn't checked beforehand.
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false; //clear all of them
        }
        if (isChecked) {
            chkBox.checked = true; //if the original one wasn't checked, check it
        }
    }
</script>
@endsection
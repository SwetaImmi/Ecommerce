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

            <h4 class="card-title">Payment List Table</h4>
           
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>S No.</th>
                            <th>
                                Actions
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Payment Method
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Details
                            </th>
                            <th>
                                Date
                            </th>


                            <th></th>
                        </tr>
                    </thead>
                    <?php $i = 0; ?>
                    @foreach($charges as $item)
                    <tbody>
                        <tr>
                        <td>{{++$i}}</td>
                            <td>

                                <!-- <a class="btn btn-inverse-warning btn-fw" href="{{ url('admin/products_edit').'/'. $item->id}}" role="button">
                                    <i class="ti-pencil-alt"></i>
                                </a> -->

                                <a onclick="return confirm('Are you sure?')" class="btn btn-inverse-danger btn-fw" href="{{ url('admin/refund').'/'. $item->id}}" role="button">
                                    <i class="ti-reload"></i>Refund
                                </a>
                            </td>
                            <td class="py-1">
                                {{$item->amount/100}}
                            </td>
                            <td>
                                @if($item->amount_refunded)
                                <span class="badge" style="background-color: dimgrey; border-radius: 15px;">Refunded</span>
                                @else
                                <span class="badge" style="background-color: #92c046; border-radius: 15px;">{{$item->status}}</span>
                                @endif
                            </td>

                            <td>
                                {{$item->payment_method_details->card->brand}}
                            </td>
                            <td>
                                {{$item->description}}
                            </td>
                            <td style="overflow: hidden;">
                            <a href="{{$item->receipt_url}}" target="_blank">{{$item->receipt_url}}</a>
                            </td>

                            <td></td>
                        </tr>

                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
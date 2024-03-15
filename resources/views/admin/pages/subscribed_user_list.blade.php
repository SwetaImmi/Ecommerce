<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Products</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>Stripe Products</h2>

    <table id="productsTable">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Interval</th>
            <th>Actions</th>
        </tr>
        <?php $i = 0; ?>


        @foreach($subscription as $plan)
        @foreach($customer as $cust)
        @if($plan->customer == $cust->id)
        <tbody>
            <!-- {{$plan->id}}subsr object -->
            <td>{{++$i}}</td>
            <td>{{$cust->name}} ({{$plan->plan->nickname}})</td>
            <td>{{$plan->plan->amount/100}}</td>
            <td>
                {{$plan->status}}
            </td>
            <td>{{$plan->plan->interval}}</td>
            <td>
                <a onclick="return confirm('Are you sure?')" class="btn btn-inverse-danger btn-fw" href="{{ url('admin/cancel_subs').'/'. $plan->id}}" role="button">
                    <i class="fas fa-trash">
                    </i>
                    Cancel
                </a>
            </td>
        </tbody>
        @endif
        @endforeach
        @endforeach

        @foreach($data as $cancel)
        <tbody>
            <!-- {{$plan->id}}subsr object -->
            <td>{{++$i}}</td>
            <td>{{$cancel->name}} ({{$cancel->plan->nickname}})</td>
            <td>{{$cancel->plan->amount/100}}</td>
            <td>
                {{$cancel->status}}
            </td>
            <td>{{$cancel->plan->interval}}</td>
            <td>
                Canceled
            </td>
        </tbody>
        @endforeach
    </table>

</body>

</html>
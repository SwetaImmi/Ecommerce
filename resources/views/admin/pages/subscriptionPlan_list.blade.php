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
      <th>Interval</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
    <?php $i = 0; ?>
    @foreach($price as $plan)

    <tbody>
      <td>{{++$i}}</td>
      <td>{{$plan->name}}</td>
      <td>{{$plan->price}}</td>
      <td>{{$plan->slug}}</td>
      <td>{{$plan->description}}</td>
      <td> 
        <a href="subs_usr_list"> Link</a>
         <!-- <a  class="btn btn-inverse-danger btn-fw" href="{{ url('admin/stripe_test').'/'. $plan->id}}" role="button">
          <i class="fas fa-trash">
          </i>
          Link
        </a> -->
      </td>
    </tbody>
    @endforeach
  </table>


</body>

</html>
<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Order Confirmation</h2>
    <p>Thank you for your order!</p>
    <p>Here are the details of your order:</p>
    <ul> 
        @foreach ($orderDetailsArray as $orderDetail)
            <li>Product: {{ $orderDetail->product_name }}</li>
            <li>Quantity: {{ $orderDetail->product_quantity }}</li>
            <li>Price: ${{ $orderDetail->product_price }}</li>
            <!-- Add more order detail fields as needed -->
        @endforeach
    </ul>
</body>
</html>

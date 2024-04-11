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
            <li>Product: {{ $orderDetailsArray->product_name }}</li>
            <li>Quantity: {{ $orderDetailsArray->product_quantity }}</li>
            <li>Price: ${{ $orderDetailsArray->product_price }}</li>
            <!-- Add more order detail fields as needed -->
    </ul>
</body>
</html>

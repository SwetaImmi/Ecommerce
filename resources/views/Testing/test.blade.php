<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('products.purchase') }}" method="POST" id="card-form">
        @csrf
        <!-- <input id="card-holder-name" type="text"> -->
        <input type="text" name="name" id="card-holder-name" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full">

        <!-- Stripe Elements Placeholder -->
        <div id="card-element"></div>

        <button id="card-button" data-secret="{{ $intent->client_secret }}">
            Update Payment Method
        </button>
    </form>
</body>
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');

    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');


    /**/
    const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
 
cardButton.addEventListener('click', async (e) => {
    const { paymentMethod, error } = await stripe.createPaymentMethod(
        'card', cardElement, {
            billing_details: { name: cardHolderName.value }
        }
    );
 
    if (error) {
        // Display "error.message" to the user...
    } else {
        // The card has been verified successfully...
    }
});
</script>

</html>
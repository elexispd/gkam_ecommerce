


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<button id="checkout-button">Checkout</button>


<script src="https://js.stripe.com/v3/"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var stripe = Stripe('pk_test_51PjSyUDq80qrBqISLFFz1Auc99k1AJspiSKNYis8yav7vTMo2fg1JhOWdEvNUSCK2oCTqhsbVsN14euo3c2crHK100i5juRtgY');
</script>

<script>
    $(document).ready(function() {
        $('#checkout-button').click(function() {
            $.ajax({
                url: '<?= BASE_URL ?>payment/generatePayment',
                method: 'POST',
                success: function(response) {
                    if (response.id) {
                        stripe.redirectToCheckout({ sessionId: response.id }).then(function(result) {
                            if (result.error) {
                                alert(result.error.message);
                            }
                        });
                    } else {
                        alert('Failed to create a checkout session.');
                    }
                },
                error: function(error) {
                    alert('Error creating checkout session');
                    console.error('Error:', error);
                }
            });
        });
    });
</script>



</body>
</html>
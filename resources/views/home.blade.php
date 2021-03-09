<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .alert.parsley {
            margin-top: 5px;
            margin-bottom: 0px;
            padding: 10px 15px 10px 15px;
        }
        .check .alert {
            margin-top: 20px;
        }
        .credit-card-box .panel-title {
            display: inline;
            font-weight: bold;
        }
        .credit-card-box .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 100%;
            text-align: center;
        }
        .credit-card-box .display-tr {
            display: table-row;
        }
    </style>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body id="app-layout">
<div class="container">
    <div class="row" style="margin-top: 100px;">
        <div class="col-md-6 col-md-offset-3">
                <button onclick="oneTimePayment()" class="btn btn-primary btn-block" id="one-time-payment"> One time payment</button><br>
                <button onclick="createSubscription()" class="btn btn-primary btn-block" id="subscription"> 20$ / month</button>
        </div>
    </div>

</div>
</body>
<script src="https://js.stripe.com/v3/"></script>

<script>
    function oneTimePayment()
    {
        window.location.href = '/ltd';
    }
    function createSubscription()
    {
        window.location.href = '/subscribe';
    }
</script>
{{--<script>
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    var stripe = Stripe('{{ .env("STRIPE_KEY") }}', { locale: 'en' }); // Create a Stripe client.
    const elements = stripe.elements(); // Create an instance of Elements.
    const card = elements.create('card', { style: style }); // Create an instance of the card Element.
    card.mount('#card-element');
    var response = fetch('/secret').then(function(response) {
        return response.json();
    })
        .then(function(responseJson) {
        var clientSecret = responseJson.client_secret;
        // Render the form to collect payment details, then
        // call stripe.confirmCardPayment() with the client secret.

        card.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        stripe.confirmCardPayment(clientSecret,{
            payment_method: {
                card: card
            }
        }).then(function (result){
            if(result.error)
            {
                alert(error.message);
            }
            else{
                alert('Success');
            }
        })


    });


    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>--}}
</body>
</html>

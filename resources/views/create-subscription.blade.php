<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Stripe
    </title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

</head>
<body id="app-layout">
<div class="container">
    <div class="row">
        <form class="form-group">

        </form>
    </div>

</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 pl-0 pr-0">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5 col-12 pt-2">
                            <h6 class="m-0"><strong>Payment Details</strong></h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <input class="form-control" placeholder="Name" id="card-holder-name" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Email" id="card-holder-email" type="email">
                        </div>


                        <!-- Stripe Elements Placeholder -->
                        <div id="card-element"></div>

                        <button class="btn btn-success w-100 pb-2 pt-2 mt-4" id="card-button" data-secret="{{ $intent->client_secret }}">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://js.stripe.com/v3/"></script>

<script>
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
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');

    const elements = stripe.elements();
    const cardElement = elements.create('card', { style: style });


    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            }
        );

        if (error) {
            alert(error.message);
            // Display "error.message" to the user...
        } else {
            const paymentMethod = setupIntent.payment_method;
            const data = { payment: paymentMethod,_token: '{{csrf_token()}}' };

            $.ajax('/create-subscription',{
                method:'POST',
                data : data,
                async : false,
                success:function (data){
                    alert(data);
                },
                error:function (data){
                    alert("Error");
                }
                });
/*            fetch('/create-subscription', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });*/
        }
    });
</script>
</html>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Checkout Ordine</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Additional Styles -->
        <style>
            body {
                margin: 24px 0;
            }
            .spacer {
                margin-bottom: 24px;
            }
            #card-number, #cvv, #expiration-date {
                background: white;
                height: 38px;
                border: 1px solid #CED4DA;
                padding: .375rem .75rem;
                border-radius: .25rem;
            }
        </style>

        <!-- Bootstrap 3 CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <div class="col-md-6 offset-md-3 mt-5">
                <h1>Completa Pagamento</h1>
                <div class="spacer"></div>

                @if (session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif

                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Payment Form --}}
                <form action="{{ route('braintree-checkout') }}" method="POST" id="payment-form">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstName">Nome</label>
                                <input type="text" class="form-control" id="firstName" name="firstName">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastName">Cognome</label>
                                <input type="text" class="form-control" id="lastName" name="lastName">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Indirizzo</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postalcode">Codice Postale</label>
                                <input type="text" class="form-control" id="postalcode" name="postalcode">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mail">Email</label>
                                <input type="email" class="form-control" id="mail" name="mail">

                                
                                <input type="text" class="form-control d-none" id="amount" name="amount" value="{{ $amount }}">
                                <input type="text" class="form-control d-none" id="id" name="id" value="{{ $id_order }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="cc_number">Numero Carta</label>

                            <div class="form-group" id="card-number">
                                
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="expiry">Scadenza</label>

                            <div class="form-group" id="expiration-date">
                                
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cvv">CVV</label>

                            <div class="form-group" id="cvv">
                                
                            </div>
                        </div>

                    </div>

                    <div class="spacer"></div>

                    <div class="spacer"></div>

                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button type="submit" class="btn btn-success">Paga € {{ $amount }} </button>
                </form>
                {{-- End Payment Form --}}
            </div>
        </div>

        <!-- Braintree Client CDN -->
        <script src="https://js.braintreegateway.com/web/3.38.1/js/client.min.js"></script>
        <!-- Braintree Hosted CDN -->
        <script src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script>

        <!-- Hosted Js Script -->
        <script>
            var form = document.querySelector('#payment-form');
            var submit = document.querySelector('input[type="submit"]');
            braintree.client.create({
                authorization: '{{ $token }}'
            }, function (clientErr, clientInstance) {
                if (clientErr) {
                    console.error(clientErr);
                    return;
                }
                // This example shows Hosted Fields, but you can also use this
                // client instance to create additional components here, such as
                // PayPal or Data Collector.
                braintree.hostedFields.create({
                    client: clientInstance,
                    styles: {
                        'input': {
                            'font-size': '14px'
                        },
                        'input.invalid': {
                            'color': 'red'
                        },
                        'input.valid': {
                            'color': 'green'
                        }
                    },
                    fields: {
                        number: {
                            selector: '#card-number',
                            placeholder: '4111 1111 1111 1111',
                            name: 'cc_number',
                        },
                        cvv: {
                            selector: '#cvv',
                            placeholder: '123', 
                            name: 'cvc',
                        },
                        expirationDate: {
                            selector: '#expiration-date',
                            placeholder: '10/2019',
                            name: 'expiry',
                        }
                    }
                }, function (hostedFieldsErr, hostedFieldsInstance) {
                    if (hostedFieldsErr) {
                        console.error(hostedFieldsErr);
                        return;
                    }
                    // submit.removeAttribute('disabled');
                    form.addEventListener('submit', function (event) {
                        event.preventDefault();
                        hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                            if (tokenizeErr) {
                                console.error(tokenizeErr);
                                return;
                            }
                            // If this was a real integration, this is where you would
                            // send the nonce to your server.
                            // console.log('Got a nonce: ' + payload.nonce);
                            document.querySelector('#nonce').value = payload.nonce;
                            form.submit();
                        });
                    }, false);
                });
            });

        </script>
    </body>
</html>

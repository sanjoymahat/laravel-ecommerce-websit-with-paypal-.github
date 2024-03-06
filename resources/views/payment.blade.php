@extends('layout.main')
@section('content')
<section class="container mt-5 my-3 py-5 card shadow ">
    <div class="container mt-2 text-center">
        <h4 class=" card-header">Payment</h4>
        @if (Session::has('total') && Session::get('total') != null)
        @if (Session::has('order_id') && Session::get('order_id') !=null)
        <h4 style="color:blue">Total: ${{ Session::get('total') }}</h4>  
        <div id="paypal-button-container" style="width:250px;height:100px; display:flex" class="container text-center card-body"></div>          
        @endif
        @endif
    </div>
</section>
<!-- Replace the "test" client-id value with your client-id -->
<script src="https://www.paypal.com/sdk/js?client-id=AT5JkdT8AGSu7RtUwcj0Xtmnw3Cbc0oR8v4pO0Npjda77JyOnsq4PUjdk2yPpzTLJfYNmlVjYpXVJqi7&currency=USD"></script>
<script>
    paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value:"{{Session::get('total')}}"// Can reference variable or function. Example: value: document.getElementById('..').value,
                    }
                }]
            });
        },
        // Finalizes the transaction after payer approval
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                // Successful capture: for dev/demo purpose
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction completed by ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                window.location.href ="/verify_payments/" + transaction.id;
            });
        }
    }).render('#paypal-button-container');
</script>
@endsection

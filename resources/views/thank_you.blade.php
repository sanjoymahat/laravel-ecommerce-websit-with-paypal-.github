@extends('layout.main')
@section('content')
<section class="container mt-5 my-3 py-5 card shadow ">
    <div class="container mt-2 text-center">
        <h4 class=" card-header">Payment</h4>
        @if (Session::has('total') && Session::get('total') != null)
        @if (Session::has('order_id') && Session::get('order_id') !=null)
        <h4 style="color:blue">Total: ${{ Session::get('total') }}</h4>  
        <p>please keep order id in safe place for feature reference  </p>
        <p>we will deliver you order under 7 day thank you have a good day</p>        
        @endif
        @endif
    </div>
</section>
@endsection
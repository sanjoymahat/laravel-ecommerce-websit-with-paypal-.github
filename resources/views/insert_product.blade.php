@extends('layout.main')
@section('content')

<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <div class="container  align-content-center">
    
   
<!-- Checkout -->
<section class="my-2 py-3 checkout card">
    @if(session('status'))
    <div class="alert alert-success">{{session('status')}}</div>
    @endif
    <div class="container text-center mt-1 pt-5 card-header ">
        <h1>Insert Product</h1>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container card-body  ">
        <form id="" action="{{url('insert_product')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group ">
                <label for="">Name</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="name" required>
            </div>
            <div class="form-group ">
                <label for="">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="product description" required>
            </div>
            <div class="form-group ">
                <label for="">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="product price" required>
            </div>
            <div class="form-group ">
                <label for="">Sale_price</label>
                <input type="number" class="form-control" id="sale price" name="sale_price" placeholder="product sale price" required>
            </div>
            <div class="form-group ">
                <label for="">Quantity</label>
                <input type="number" class="form-control" id="checkout-name" name="quantity" placeholder="product quantity" required>
            </div>
            <div class="form-group ">
                <label for="">Category</label>
                <input type="text" class="form-control" id="category" name="category" placeholder="product category" required>
            </div>
            <div class="form-group ">
                <label for="">Type</label>
                <input type="text" class="form-control" id="type" name="type" placeholder="product type" required>
            </div>
            <div class="form-group ">
                <label for="">Image</label>
                <input type="file" class="form-control" id="image" name="image" placeholder="product image" required>
            </div>
            <div class="form-group checkout-btn-container mx-auto">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
    
        </form>
    </div>
</section>
 </div>
</div>
<!-- Cart End -->
@endsection
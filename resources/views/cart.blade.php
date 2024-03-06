@extends('layout.main')
@section('content')
  <!-- Cart Start -->
  <div class="container-fluid pt-5">
    <div class="container card shadow ">
        <section class="cart container mt-2 my-3 py-5">
            <div class="container mt-2 card-header ">
                <h4>Your Cart</h4>
            </div>

            <table class="pt-5 card-body ">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>

                @if(Session::has('cart'))
                    @foreach (Session::get('cart') as $crd)
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="{{ asset('storage/'.$crd['image']) }}" alt="Product Image">


                                    <div>
                                        <p>{{ $crd['name']}}</p>
                                        <small><span>$</span>{{$crd['price']}}</small>
                                        <br>
                                        <form method="POST" action="{{ route('remove_form_cart') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $crd['id'] }}">
                                            <input type="submit" name="remove_btn" class="remove-btn" value="remove">
                                        </form>
                                        
                                    </div>
                                </div>
                            </td>

                            <td>
                                <form>
                                    <input type="number" name="quantity" value="{{$crd['quantity']}}">
                                    <input type="submit" value="edit" class="edit-btn" name="edit_product_quantity_btn">
                                </form>
                            </td>

                            <td>
                                <span class="product-price">${{ $crd['price']  }}</span>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>

            <div class="cart-total">
                <table>
                    @if(Session::has('cart'))
                    <tr>
                        <td>Total</td>
                        @if(Session::has('total'))
                        <td>${{ Session::get('total') }}</td>
                        @endif
                    </tr>
                    @endif
                </table>
            </div>

            <div class="checkout-container">
                @if (Session::has('total'))
                @if(Session::get('total') !=null)
                <form method="GET" action="{{route('checkout')}}" >
                <input type="submit" class="btn checkout-btn" value="Checkout" name="">
                </form>
                @endif
                @endif
            </div>
        </section>
    </div>
</div>
<!-- Cart End -->
@endsection

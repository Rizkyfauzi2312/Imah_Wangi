@extends('layouts.main')

@section('title', 'Shopping Cart - Imah Wangi')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Shopping Cart</h2>
    
    @if(empty($cart))
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
            <h3>Your cart is empty</h3>
            <p class="text-muted">Start shopping to add items to your cart</p>
            <a href="{{ route('shop.index') }}" class="btn btn-gold mt-3">Browse Products</a>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                @foreach($cart as $id => $item)
                    <div class="card card-valoria mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5>{{ $item['product_name'] }}</h5>
                                    @if($item['is_custom'])
                                        <span class="badge bg-warning text-dark">Custom Perfume</span>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm" onchange="this.form.submit()">
                                    </form>
                                </div>
                                <div class="col-md-2">
                                    <strong>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</strong>
                                </div>
                                <div class="col-md-2">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fas fa-trash"></i> Clear Cart
                    </button>
                </form>
            </div>
            
            <div class="col-md-4">
                <div class="card card-valoria">
                    <div class="card-body">
                        <h4>Order Summary</h4>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Items:</span>
                            <span>{{ count($cart) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong class="text-gold">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-gold w-100">
                            Proceed to Checkout
                        </a>
                        <a href="{{ route('shop.index') }}" class="btn btn-black w-100 mt-2">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

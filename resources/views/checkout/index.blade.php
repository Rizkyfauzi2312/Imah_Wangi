@extends('layouts.main')

@section('title', 'Checkout - Valoria Parfume')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card card-valoria">
                <div class="card-body">
                    <h4 class="mb-4">Customer Information</h4>
                    
                    <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label-valoria">Full Name</label>
                            <input type="text" name="customer_name" class="form-control form-control-valoria @error('customer_name') is-invalid @enderror" value="{{ old('customer_name', auth()->user()->name) }}" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-valoria">Email</label>
                            <input type="email" name="customer_email" class="form-control form-control-valoria @error('customer_email') is-invalid @enderror" value="{{ old('customer_email', auth()->user()->email) }}" required>
                            @error('customer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-valoria">Phone Number</label>
                            <input type="text" name="customer_phone" class="form-control form-control-valoria @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') }}" required>
                            @error('customer_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-valoria">Shipping Address</label>
                            <textarea name="customer_address" rows="3" class="form-control form-control-valoria @error('customer_address') is-invalid @enderror" required>{{ old('customer_address') }}</textarea>
                            @error('customer_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-valoria">Payment Proof</label>
                            <input type="file" name="payment_proof" class="form-control form-control-valoria @error('payment_proof') is-invalid @enderror" accept="image/*" required>
                            <small class="text-muted">Upload proof of payment (JPG, PNG, max 2MB)</small>
                            @error('payment_proof')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="alert alert-info">
                            <strong>Payment Instructions:</strong><br>
                            Please transfer to: Bank BCA 1234567890 (Valoria Parfume)<br>
                            Upload the payment proof above.
                        </div>
                        
                        <button type="submit" class="btn btn-gold btn-lg w-100">
                            <i class="fas fa-check"></i> Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card card-valoria">
                <div class="card-body">
                    <h4>Order Summary</h4>
                    <hr>
                    @foreach($cart as $item)
                        <div class="mb-2">
                            <strong>{{ $item['product_name'] }}</strong>
                            @if($item['is_custom'])
                                <span class="badge bg-warning text-dark">Custom</span>
                            @endif
                            <br>
                            <small>{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total:</strong>
                        <strong class="text-gold">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.main')

@section('title', $product->name . ' - Valoria Parfume')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-valoria">
                <div class="card-body p-0">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" class="img-fluid w-100" alt="{{ $product->name }}" style="border-radius: 8px; max-height: 500px; object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center" style="height: 500px; background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-radius: 8px;">
                            <i class="fas fa-wine-bottle fa-10x" style="color: var(--color-gold); opacity: 0.3;"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="lead text-muted">{{ $product->description }}</p>
            
            <div class="price-display mb-4">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>
            
            @if($product->stock > 0)
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> In Stock ({{ $product->stock }} available)
                </div>
                
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="is_custom" value="0">
                    
                    <div class="mb-3">
                        <label class="form-label-valoria">Quantity</label>
                        <input type="number" name="quantity" class="form-control form-control-valoria" value="1" min="1" max="{{ $product->stock }}">
                    </div>
                    
                    <button type="submit" class="btn btn-gold btn-lg w-100">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </form>
            @else
                <div class="alert alert-danger">
                    <i class="fas fa-times-circle"></i> Out of Stock
                </div>
            @endif
            
            <a href="{{ route('shop.index') }}" class="btn btn-black mt-3">
                <i class="fas fa-arrow-left"></i> Back to Shop
            </a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.main')

@section('title', 'Shop - Imah Wangi')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Our Collection</h2>
    
    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-md-4">
                <div class="card card-valoria">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 250px; background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);">
                            <i class="fas fa-wine-bottle fa-4x" style="color: var(--color-gold); opacity: 0.3;"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('shop.show', $product->id) }}" class="btn btn-sm btn-gold">View Details</a>
                        </div>
                        @if($product->stock > 0)
                            <small class="text-success"><i class="fas fa-check-circle"></i> In Stock ({{ $product->stock }})</small>
                        @else
                            <small class="text-danger"><i class="fas fa-times-circle"></i> Out of Stock</small>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                <p class="text-muted">No products available at the moment.</p>
                <a href="{{ route('custom.index') }}" class="btn btn-gold mt-3">Create Custom Perfume</a>
            </div>
        @endforelse
    </div>
    
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection

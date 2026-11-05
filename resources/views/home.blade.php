@extends('layouts.main')

@section('title', 'Imah Wangi - Your Signature, Your Scent')

@section('content')
<!-- Banner Carousel -->
@if($banners->count() > 0)
<section class="banner-carousel mb-5">
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($banners as $index => $banner)
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    @if($banner->link)
                        <a href="{{ $banner->link }}">
                            <img src="{{ asset($banner->image) }}" class="d-block w-100" alt="{{ $banner->title }}" style="max-height: 500px; object-fit: cover;">
                        </a>
                    @else
                        <img src="{{ asset($banner->image) }}" class="d-block w-100" alt="{{ $banner->title }}" style="max-height: 500px; object-fit: cover;">
                    @endif
                    @if($banner->title || $banner->subtitle)
                        <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); padding: 20px; border-radius: 8px;">
                            @if($banner->title)
                                <h2 style="color: var(--color-gold); font-weight: 700;">{{ $banner->title }}</h2>
                            @endif
                            @if($banner->subtitle)
                                <p style="font-size: 1.1rem;">{{ $banner->subtitle }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @if($banners->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>
</section>
@endif

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center fade-in-up">
                <h1>Imah Wangi</h1>
                <p class="lead">Your Signature, Your Scent</p>
                <p class="mb-4">Discover our exclusive collection or create your own luxury fragrance</p>
                <div class="mt-4">
                    <a href="{{ route('shop.index') }}" class="btn btn-gold me-3">Shop Now</a>
                    <a href="{{ route('custom.index') }}" class="btn btn-black">Create Custom Perfume</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Featured Collection</h2>
            <p class="text-muted">Explore our signature fragrances</p>
        </div>
        
        <div class="row g-4">
            @forelse($featuredProducts as $product)
                <div class="col-md-4">
                    <div class="card card-valoria">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 250px; background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);">
                                <i class="fas fa-image fa-3x" style="color: var(--color-gold); opacity: 0.3;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('shop.show', $product->id) }}" class="btn btn-sm btn-gold">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No products available at the moment.</p>
                </div>
            @endforelse
        </div>
        
        @if($featuredProducts->count() > 0)
            <div class="text-center mt-5">
                <a href="{{ route('shop.index') }}" class="btn btn-black">View All Products</a>
            </div>
        @endif
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Why Choose Valoria</h2>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="fas fa-gem fa-3x" style="color: var(--color-gold);"></i>
                </div>
                <h4>Premium Quality</h4>
                <p class="text-muted">Only the finest ingredients for our exclusive fragrances</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="fas fa-palette fa-3x" style="color: var(--color-gold);"></i>
                </div>
                <h4>Custom Creation</h4>
                <p class="text-muted">Design your own unique scent with our custom perfume builder</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="fas fa-shipping-fast fa-3x" style="color: var(--color-gold);"></i>
                </div>
                <h4>Fast Delivery</h4>
                <p class="text-muted">Quick and secure shipping to your doorstep</p>
            </div>
        </div>
    </div>
</section>
@endsection

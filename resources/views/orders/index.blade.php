@extends('layouts.main')

@section('title', 'My Orders - Valoria Parfume')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Orders</h2>
    
    @forelse($orders as $order)
        <div class="card card-valoria mb-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <strong>{{ $order->order_number }}</strong><br>
                        <small class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</small>
                    </div>
                    <div class="col-md-3">
                        <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="col-md-3">
                        <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                    </div>
                    <div class="col-md-3 text-end">
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-gold">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <i class="fas fa-shopping-bag fa-5x text-muted mb-4"></i>
            <h3>No orders yet</h3>
            <p class="text-muted">Start shopping to create your first order</p>
            <a href="{{ route('shop.index') }}" class="btn btn-gold mt-3">Browse Products</a>
        </div>
    @endforelse
    
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection

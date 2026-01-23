@extends('layouts.main')

@section('title', 'Order Details - Valoria Parfume')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Order Details</h2>
        <a href="{{ route('orders.index') }}" class="btn btn-black">
            <i class="fas fa-arrow-left"></i> Back to Orders
        </a>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card card-valoria mb-4">
                <div class="card-body">
                    <h4>Order Information</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                            <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                            <p><strong>Status:</strong> <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
                            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                            <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                        </div>
                    </div>
                    <p><strong>Address:</strong><br>{{ $order->customer_address }}</p>
                </div>
            </div>
            
            <div class="card card-valoria">
                <div class="card-body">
                    <h4>Order Items</h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            {{ $item->product_name }}
                                            @if($item->is_custom)
                                                <span class="badge bg-warning text-dark">Custom</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    <th>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            @if($order->payment_proof)
                <div class="card card-valoria">
                    <div class="card-body">
                        <h4>Payment Proof</h4>
                        <hr>
                        <img src="{{ asset($order->payment_proof) }}" alt="Payment Proof" class="img-fluid rounded">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

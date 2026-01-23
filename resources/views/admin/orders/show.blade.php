@extends('layouts.admin')

@section('title', 'Order Details')
@section('page-title', 'Order #' . $order->order_number)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="admin-card mb-4">
            <h5>Customer Information</h5>
            <hr>
            <p><strong>Name:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Address:</strong><br>{{ $order->customer_address }}</p>
        </div>
        
        <div class="admin-card">
            <h5>Order Items</h5>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
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
    
    <div class="col-md-4">
        <div class="admin-card mb-3">
            <h5>Order Status</h5>
            <hr>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <select name="status" class="form-select mb-3">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="btn btn-gold w-100">Update Status</button>
            </form>
        </div>
        
        @if($order->payment_proof)
            <div class="admin-card">
                <h5>Payment Proof</h5>
                <hr>
                <img src="{{ asset($order->payment_proof) }}" alt="Payment Proof" class="img-fluid rounded">
            </div>
        @endif
    </div>
</div>
@endsection

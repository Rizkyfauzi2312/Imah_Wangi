@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <h3>{{ $totalOrders }}</h3>
            <p>Total Orders</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <h3>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            <p>Total Revenue</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <h3>{{ $pendingOrders }}</h3>
            <p>Pending Orders</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <h3>{{ $totalProducts }}</h3>
            <p>Total Products</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <h4 class="mb-4">Monthly Revenue ({{ date('Y') }})</h4>
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="admin-card">
            <h4 class="mb-4">Recent Orders</h4>
            <div class="list-group">
                @forelse($recentOrders->take(5) as $order)
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $order->order_number }}</strong>
                            <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                        </div>
                        <small class="text-muted">{{ $order->customer_name }} - Rp {{ number_format($order->total_amount, 0, ',', '.') }}</small>
                    </a>
                @empty
                    <p class="text-muted">No orders yet</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const ctx = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Revenue (Rp)',
            data: @json($chartData),
            borderColor: '#D4AF37',
            backgroundColor: 'rgba(212, 175, 55, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top',
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>
@endpush

@extends('layouts.admin')

@section('title', 'Sales Reports')
@section('page-title', 'Sales Reports')

@section('content')
<div class="admin-card mb-4">
    <h5>Report Filters</h5>
    <hr>
    <form action="{{ route('admin.reports.index') }}" method="GET" class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Filter Type</label>
            <select name="filter" class="form-select" id="filterType">
                <option value="daily" {{ $filter == 'daily' ? 'selected' : '' }}>Daily</option>
                <option value="monthly" {{ $filter == 'monthly' ? 'selected' : '' }}>Monthly</option>
                <option value="yearly" {{ $filter == 'yearly' ? 'selected' : '' }}>Yearly</option>
                <option value="custom" {{ $filter == 'custom' ? 'selected' : '' }}>Custom Range</option>
            </select>
        </div>
        
        <div class="col-md-3" id="startDateDiv" style="display: {{ $filter == 'custom' ? 'block' : 'none' }};">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
        </div>
        
        <div class="col-md-3" id="endDateDiv" style="display: {{ $filter == 'custom' ? 'block' : 'none' }};">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
        </div>
        
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-gold w-100">
                <i class="fas fa-filter"></i> Apply Filter
            </button>
        </div>
    </form>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <h3>{{ $totalTransactions }}</h3>
            <p>Total Transactions</p>
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
            <h3>{{ $totalProducts }}</h3>
            <p>Products Sold</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <h3>{{ $customCount }} / {{ $readyStockCount }}</h3>
            <p>Custom / Ready Stock</p>
        </div>
    </div>
</div>

<!-- Chart -->
<div class="admin-card mb-4">
    <h5>Sales Trend</h5>
    <hr>
    <canvas id="salesChart"></canvas>
</div>

<!-- Export Buttons -->
<div class="admin-card mb-4">
    <h5>Export Report</h5>
    <hr>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.reports.exportPdf', request()->query()) }}" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <a href="{{ route('admin.reports.exportExcel', request()->query()) }}" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <button onclick="window.print()" class="btn btn-secondary">
            <i class="fas fa-print"></i> Print
        </button>
    </div>
</div>

<!-- Transactions Table -->
<div class="admin-card">
    <h5>Transactions</h5>
    <hr>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td><strong>{{ $transaction->order_number }}</strong></td>
                        <td>{{ $transaction->customer_name }}</td>
                        <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                        <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                        <td><span class="badge badge-{{ $transaction->status }}">{{ ucfirst($transaction->status) }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No transactions found for this period</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Filter type change handler
document.getElementById('filterType').addEventListener('change', function() {
    const customDivs = document.querySelectorAll('#startDateDiv, #endDateDiv');
    if (this.value === 'custom') {
        customDivs.forEach(div => div.style.display = 'block');
    } else {
        customDivs.forEach(div => div.style.display = 'none');
    }
});

// Sales Chart
const ctx = document.getElementById('salesChart').getContext('2d');
const chartData = @json($chartData);

const labels = chartData.map(item => item.date);
const data = chartData.map(item => item.revenue);

const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Revenue (Rp)',
            data: data,
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
            },
            title: {
                display: true,
                text: 'Daily Sales Revenue'
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

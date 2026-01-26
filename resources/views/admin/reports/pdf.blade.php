<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report - Valoria Parfume</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #2d2d2d;
            background: #fff;
            line-height: 1.5;
        }
        
        .container {
            padding: 30px;
        }
        
        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #D4AF37;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #1a1a2e;
            letter-spacing: 4px;
            margin-bottom: 5px;
        }
        
        .logo-accent {
            color: #D4AF37;
        }
        
        .tagline {
            font-size: 11px;
            color: #666;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
        
        .report-title {
            font-size: 20px;
            color: #1a1a2e;
            margin-top: 15px;
            font-weight: 600;
        }
        
        .report-period {
            font-size: 12px;
            color: #666;
            margin-top: 8px;
        }
        
        .report-date {
            font-size: 10px;
            color: #999;
            margin-top: 5px;
        }
        
        /* Statistics Section */
        .stats-section {
            margin-bottom: 30px;
        }
        
        .stats-title {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }
        
        .stats-grid {
            width: 100%;
        }
        
        .stats-grid td {
            width: 25%;
            padding: 15px;
            text-align: center;
            vertical-align: top;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            padding: 20px 15px;
            border-left: 4px solid #D4AF37;
        }
        
        .stat-value {
            font-size: 20px;
            font-weight: bold;
            color: #1a1a2e;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Transactions Table */
        .transactions-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }
        
        .transactions-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        .transactions-table th {
            background: linear-gradient(135deg, #1a1a2e 0%, #2d2d44 100%);
            color: #D4AF37;
            padding: 12px 10px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }
        
        .transactions-table th:first-child {
            border-radius: 8px 0 0 0;
        }
        
        .transactions-table th:last-child {
            border-radius: 0 8px 0 0;
            text-align: right;
        }
        
        .transactions-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
            font-size: 11px;
        }
        
        .transactions-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .transactions-table tr:hover {
            background: #fff3cd;
        }
        
        .transactions-table td:last-child {
            text-align: right;
            font-weight: 600;
            color: #1a1a2e;
        }
        
        .order-number {
            font-weight: 600;
            color: #D4AF37;
        }
        
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-completed {
            background: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-processing {
            background: #cce5ff;
            color: #004085;
        }
        
        /* Summary Row */
        .summary-row {
            background: linear-gradient(135deg, #1a1a2e 0%, #2d2d44 100%) !important;
        }
        
        .summary-row td {
            color: #fff !important;
            font-weight: 600;
            padding: 15px 10px;
            border-bottom: none;
        }
        
        .summary-row td:last-child {
            color: #D4AF37 !important;
            font-size: 14px;
        }
        
        /* No Data Message */
        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }
        
        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #D4AF37;
            text-align: center;
        }
        
        .footer-text {
            font-size: 10px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .footer-brand {
            font-size: 12px;
            color: #1a1a2e;
            font-weight: 600;
            letter-spacing: 2px;
        }
        
        .footer-contact {
            font-size: 9px;
            color: #999;
            margin-top: 8px;
        }
        
        /* Page Break */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <span class="logo-accent">V</span>ALORIA <span class="logo-accent">P</span>ARFUME
            </div>
            <div class="tagline">Luxury Custom Perfumes</div>
            <div class="report-title">📊 Sales Report</div>
            <div class="report-period">{{ $periodDescription }}</div>
            <div class="report-date">Generated: {{ $generatedAt }}</div>
        </div>
        
        <!-- Statistics -->
        <div class="stats-section">
            <div class="stats-title">📈 Report Summary</div>
            <table class="stats-grid">
                <tr>
                    <td>
                        <div class="stat-card">
                            <div class="stat-value">{{ $totalTransactions }}</div>
                            <div class="stat-label">Total Transactions</div>
                        </div>
                    </td>
                    <td>
                        <div class="stat-card">
                            <div class="stat-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                            <div class="stat-label">Total Revenue</div>
                        </div>
                    </td>
                    <td>
                        <div class="stat-card">
                            <div class="stat-value">{{ $totalProducts }}</div>
                            <div class="stat-label">Products Sold</div>
                        </div>
                    </td>
                    <td>
                        <div class="stat-card">
                            <div class="stat-value">{{ $customCount }} / {{ $readyStockCount }}</div>
                            <div class="stat-label">Custom / Ready Stock</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Transactions Table -->
        <div class="transactions-section">
            <div class="section-title">🧾 Transaction Details</div>
            @if($transactions->count() > 0)
                <table class="transactions-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td><span class="order-number">{{ $transaction->order_number }}</span></td>
                                <td>{{ $transaction->customer_name }}</td>
                                <td>{{ $transaction->customer_email ?? '-' }}</td>
                                <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <span class="status-badge status-{{ $transaction->status }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <!-- Summary Row -->
                        <tr class="summary-row">
                            <td colspan="5"><strong>TOTAL</strong></td>
                            <td>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <div class="no-data">
                    No transactions found for this period.
                </div>
            @endif
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="footer-text">This is a computer-generated document. No signature required.</div>
            <div class="footer-brand">VALORIA PARFUME</div>
            <div class="footer-contact">www.valoriaparfume.com | info@valoriaparfume.com</div>
        </div>
    </div>
</body>
</html>

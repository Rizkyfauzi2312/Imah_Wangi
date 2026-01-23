<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'monthly');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = Order::where('status', 'completed');

        // Apply date filters
        switch ($filter) {
            case 'daily':
                $query->whereDate('created_at', today());
                break;
            case 'monthly':
                $query->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year);
                break;
            case 'yearly':
                $query->whereYear('created_at', now()->year);
                break;
            case 'custom':
                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                }
                break;
        }

        // Statistics
        $totalTransactions = $query->count();
        $totalRevenue = $query->sum('total_amount');
        $totalProducts = OrderItem::whereIn('order_id', $query->pluck('id'))->sum('quantity');
        
        // Custom vs Ready Stock
        $customCount = OrderItem::whereIn('order_id', $query->pluck('id'))
                                ->where('is_custom', true)
                                ->count();
        $readyStockCount = OrderItem::whereIn('order_id', $query->pluck('id'))
                                    ->where('is_custom', false)
                                    ->count();

        // Transactions
        $transactions = $query->with('user')->latest()->get();

        // Chart data - Daily sales for the period
        $chartData = $query->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_amount) as revenue')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        return view('admin.reports.index', compact(
            'filter',
            'totalTransactions',
            'totalRevenue',
            'totalProducts',
            'customCount',
            'readyStockCount',
            'transactions',
            'chartData',
            'startDate',
            'endDate'
        ));
    }

    public function exportPdf(Request $request)
    {
        // Similar logic to index but return PDF
        $filter = $request->get('filter', 'monthly');
        $data = $this->getReportData($filter, $request->get('start_date'), $request->get('end_date'));
        
        $pdf = Pdf::loadView('admin.reports.pdf', $data);
        return $pdf->download('sales-report-' . date('Y-m-d') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        // Export to Excel - simplified version
        return response()->json(['message' => 'Excel export functionality']);
    }

    public function getData(Request $request)
    {
        // Return JSON data for AJAX requests
        $filter = $request->get('filter', 'monthly');
        $data = $this->getReportData($filter, $request->get('start_date'), $request->get('end_date'));
        
        return response()->json($data);
    }

    private function getReportData($filter, $startDate = null, $endDate = null)
    {
        $query = Order::where('status', 'completed');

        switch ($filter) {
            case 'daily':
                $query->whereDate('created_at', today());
                break;
            case 'monthly':
                $query->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year);
                break;
            case 'yearly':
                $query->whereYear('created_at', now()->year);
                break;
            case 'custom':
                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                }
                break;
        }

        return [
            'totalTransactions' => $query->count(),
            'totalRevenue' => $query->sum('total_amount'),
            'transactions' => $query->with('user')->latest()->get(),
        ];
    }
}

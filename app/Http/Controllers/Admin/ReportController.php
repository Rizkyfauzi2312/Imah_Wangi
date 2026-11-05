<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Exports\SalesReportExport;
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
        $chartData = (clone $query)->reorder()->select(
    DB::raw('DATE(created_at) as date'),
    DB::raw('SUM(total_amount) as revenue')
)
->groupBy('date')
->orderBy('date', 'desc')
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
        $filter = $request->get('filter', 'monthly');
        $data = $this->getReportData($filter, $request->get('start_date'), $request->get('end_date'));
        
        $pdf = Pdf::loadView('admin.reports.pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('sales-report-' . date('Y-m-d') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $filter = $request->get('filter', 'monthly');
        $data = $this->getReportData($filter, $request->get('start_date'), $request->get('end_date'));
        
        return Excel::download(
            new SalesReportExport($data),
            'sales-report-' . date('Y-m-d') . '.xlsx'
        );
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

        // Build period description
        $periodDescription = '';
        
        switch ($filter) {
            case 'daily':
                $query->whereDate('created_at', today());
                $periodDescription = 'Daily Report - ' . today()->format('d F Y');
                break;
            case 'monthly':
                $query->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year);
                $periodDescription = 'Monthly Report - ' . now()->format('F Y');
                break;
            case 'yearly':
                $query->whereYear('created_at', now()->year);
                $periodDescription = 'Yearly Report - ' . now()->format('Y');
                break;
            case 'custom':
                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                    $periodDescription = 'Custom Period: ' . 
                        \Carbon\Carbon::parse($startDate)->format('d M Y') . ' - ' . 
                        \Carbon\Carbon::parse($endDate)->format('d M Y');
                } else {
                    $periodDescription = 'All Time';
                }
                break;
            default:
                $periodDescription = 'Monthly Report - ' . now()->format('F Y');
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

        // Transactions with relationships
        $transactions = $query->with(['user', 'items'])->latest()->get();

        return [
            'filter' => $filter,
            'periodDescription' => $periodDescription,
            'generatedAt' => now()->format('d F Y, H:i:s'),
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
            'totalProducts' => $totalProducts,
            'customCount' => $customCount,
            'readyStockCount' => $readyStockCount,
            'transactions' => $transactions,
        ];
    }
}


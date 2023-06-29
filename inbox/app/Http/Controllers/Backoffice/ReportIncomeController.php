<?php

namespace App\Http\Controllers\Backoffice;

use PDF;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportIncomeController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        return view('backoffice.report-income.index', compact('fromDate', 'toDate'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        $reports = Transaction::with('details', 'user')
        ->whereDate('created_at', '>=', $fromDate)
        ->whereDate('created_at', '<=', $toDate)
        ->get();

        $grandTotal = TransactionDetail::with('products')
        ->whereDate('created_at', '>=', $fromDate)
        ->whereDate('created_at', '<=', $toDate)
        ->sum('grand_price');


        return view('backoffice.report-income.index', compact('fromDate', 'toDate', 'reports', 'grandTotal'));
    }

    public function pdf($fromDate, $toDate)
    {
        $reports = Transaction::with('details', 'user')
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate)
            ->get();

        $grandTotal = TransactionDetail::with('products')
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate)
            ->sum('grand_price');

        $pdf = PDF::loadView('backoffice.report-income.reportIncome', compact('fromDate', 'toDate', 'reports', 'grandTotal'))->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Data Pendapatan- '.Carbon::parse($fromDate)->format('d M Y').' - '.Carbon::parse($toDate)->format('d M Y').'.pdf');
    }
}

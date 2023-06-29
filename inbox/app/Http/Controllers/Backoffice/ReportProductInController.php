<?php

namespace App\Http\Controllers\Backoffice;

use PDF;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportProductInController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        return view('backoffice.report-product-in.index', compact('fromDate', 'toDate'));
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


        return view('backoffice.report-product-in.index', compact('fromDate', 'toDate', 'reports'));
    }

    public function pdf($fromDate, $toDate)
    {
        $reports = Transaction::with('details', 'user')
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate)
            ->get();

        $grandQuantity = TransactionDetail::with('products')
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate)
            ->sum('quantity');

        $pdf = PDF::loadView('backoffice.report-product-in.report', compact('fromDate', 'toDate', 'reports', 'grandQuantity'))->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Barang Masuk- '.Carbon::parse($fromDate)->format('d M Y').' - '.Carbon::parse($toDate)->format('d M Y').'.pdf');
    }
}

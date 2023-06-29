<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if(Auth::user()->hasRole('admin')){
            $transactions = Transaction::search('invoice')
                ->with('details')
                ->latest()
                ->paginate(10)
                ->withQueryString();
        }else{
            $transactions = Transaction::search('invoice')
                ->with('details')
                ->where('user_id', Auth::id())
                ->paginate(10)
                ->withQueryString();
        }
        return view('backoffice.transaction.transaction', compact('transactions'));
    }
}

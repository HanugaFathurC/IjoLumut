<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = User::count();
        $products = Product::count();
        $transactions = Transaction::count();

        $bestTypeWarehouses = TransactionDetail::join('products', 'products.id', 'transaction_details.product_id')
                            ->join('warehouses', 'warehouses.id', 'products.warehouse_id')
                            ->join('types', 'types.id', 'warehouses.type_id')
                            ->selectRaw('types.name as name, types.image, sum(transaction_details.quantity) as total')
                            ->groupBy('transaction_details.product_id')
                            ->orderBy('total', 'DESC')
                            ->take(3)->get();

        return view('landing.welcome', compact('bestTypeWarehouses', 'users', 'products', 'transactions'));
    }
}

<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Warehouse;

class ProductStockController extends Controller
{
    public function index()
    {
        $products = Product::with(['warehouse', 'category'])
            ->search('name')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('backoffice.product-stock.index', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $warehouse = Warehouse::findOrFail($product->warehouse_id);

        $warehouse_old_stotage = $warehouse->storage;
        $product_old_stock = $product->quantity;
        $increment_product_stock = $request->quantity - $product_old_stock;

        if ($warehouse->storage <= $warehouse->capacity) {
            if($warehouse->capacity < $request->quantity){
                return back()->with('toast_error', 'Kapasitas gudang tidak mencukupi');
            }elseif($request->quantity < 0){
                return back()->with('toast_error', 'Mohon masukan jumlah yg valid');
            }elseif($increment_product_stock < 0){
                return back()->with('toast_error', 'Pertambahan produk tidak valid');
            }else{
                $product->update([
                    'quantity' => $request->quantity,
                ]);
                $warehouse->increment('storage', $increment_product_stock);
                if($warehouse->capacity < $warehouse->storage){
                    $warehouse->update([
                        'storage' => $warehouse_old_stotage,
                    ]);
                    $product->update([
                        'quantity' => $product_old_stock,
                    ]);
                    return back()->with('toast_error', 'Penambahan melebihi batas kapasitas');
                } else {

                    return back()->with('toast_success', 'Stok berhasil ditambah');
                }
            }

        } else {
            return back()->with('toast_error', 'Kapasitas gudang penuh tidak bisa menambah stok');
        }





    }
}

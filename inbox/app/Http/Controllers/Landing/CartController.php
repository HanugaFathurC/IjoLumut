<?php

namespace App\Http\Controllers\Landing;

use App\Models\Cart;
use App\Models\Product;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->latest()
            ->whereBelongsTo(Auth::user())->get();

        $grandQuantity = Cart::count();
        $grandPrice = $carts->sum('tagihan');

        return view('landing.cart.index', compact('carts', 'grandQuantity', 'grandPrice'));
    }


    public function store(Request $request, Product $product)
    {

        $alreadyInCart = Cart::with('product')
            ->whereBelongsTo($request->user())
            ->where('product_id', $product->id)
            ->first();

        $price = $product->price;
        $duration = 1;
        $quantity = 1;

        $grandPrice = $price * $duration * $quantity;

        if($alreadyInCart){
            return back()->with('toast_error', 'Produk sudah ada di dalam keranjang');
        } else {
            $request->user()->carts()->create([
                    'product_id' => $product->id,
                    'quantity' => $duration,
                    'durasi' => $quantity,
                    'tagihan' => $grandPrice,
            ]);
            return redirect(route('cart.index'))
                    ->with('toast_success', 'Produk berhasil ditambahkan keranjang');
        }

    }

    public function update(Request $request, Cart $cart)
    {
        $product = Product::whereId($cart->product_id)->first();

        $price = $product->price;

        if($request->filled('quantity')) {
            if($product->quantity < $request->quantity){
                return back()->with('toast_error', 'Stok produk tidak mencukupi');
            }elseif($request->quantity <= 0){
                return back()->with('toast_error', 'Mohon masukan data yg valid');
            }else{
                $grandPrice = $price * $request->quantity * $cart->durasi;
                $cart->update([
                    'quantity' => $request->quantity,
                    'tagihan' => $grandPrice,
                ]);

            }
        }

        if($request->filled('durasi')) {
            if($request->durasi <= 0){
                return back()->with('toast_error', 'Mohon masukan data yg valid');
            }else{
                $grandPrice = $price * $request->durasi * $cart->quantity;
                $cart->update([
                    'durasi' => $request->durasi,
                    'tagihan' => $grandPrice,
                ]);
            }
        }



        return back()->with('toast_success', 'Keranjang berhasil diperbaharui');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return back()->with('toast_success', 'Produk berhasil dikeluarkan dari keranjang');
    }


}

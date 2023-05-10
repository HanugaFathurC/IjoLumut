<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use App\Traits\HasImage;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class OrderController extends Controller
{
    use HasImage;

    public $path = 'public/orders/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $orders = Order::with('user')
                ->search('name')
                ->latest()
                ->paginate(10)
                ->withQueryString();

            $categories = Category::get();

            $warehouses = Warehouse::get();

            return view('backoffice.order.index', compact('orders', 'categories', 'warehouses'));

        } else {

            $orders = Order::with('user')
                ->where('user_id', Auth::id())
                ->search('name')
                ->latest()
                ->paginate(10)
                ->withQueryString();

            $product = [];

            foreach($orders as $order){
                    $product = Product::where('name', $order->name)->where('quantity', $order->quantity)->first();
            }

            return view('backoffice.order.index', compact('orders','product'));

        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $this->uploadImage($request, $this->path);

        $request->user()->orders()->create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'image' => $image->hashName(),
            'unit' => $request->unit,
        ]);

        return back()->with('toast_success', 'Data berhasil disimpan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $image = $this->uploadImage($request, $this->path);

        if($order->status == OrderStatus::Pending){
            $order->update([
                'status' => OrderStatus::Verified,
            ]);
        }else{
            Product::create([
                'category_id' => $request->category_id,
                'warehouse_id' => $request->warehouse_id,
                'name' => $request->name,
                'image' => $image->hashName(),
                'unit' => $request->unit,
                'description' => $request->description,
                'quantity' => $request->quantity
            ]);

            $order->update([
                'status' => OrderStatus::Success
            ]);
        }

        return back()->with('toast_success', 'Permintaan Barang Berhasil Dikonfirmasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        Storage::disk('local')->delete($this->path. basename($order->image));

        $order->delete();

        return back()->with('toast_success', 'Data berhasil dihapus');
    }
}

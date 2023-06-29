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

    public $path = 'public/products/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $orders = Order::with('user')
                ->withTrashed()
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
                ->whereNull('deleted_at')
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
        $validationData = $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'quantity' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'unit' => 'required',
        ]);

        $image = $this->uploadImage($request, $this->path);

        $validationData['image'] = $validationData['image']->hashName();

        $request->user()->orders()->create($validationData);

        return back()->with('toast_success', 'Data berhasil disimpan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order){


        if($order->status == OrderStatus::Pending){
            $order->update([
                'status' => OrderStatus::Verified,
            ]);
        }else{

            $dataProductValidation = $request->validate([
                'name' => 'required',
                'image' => 'mimes:png,jpg,jpeg|max:2048',
                'category_id' => 'required',
                'warehouse_id' => 'required',
                'description' => 'required',
                'price' => 'required',
                'unit' => 'required',
                'quantity' => 'required',
            ]);

            $image = $this->uploadImage($request, $this->path);
            $dataProductValidation['image'] = $dataProductValidation['image']->hashName();

            Product::create($dataProductValidation);

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
        // Storage::disk('local')->delete($this->path. basename($order->image));

        $order->delete();

        return back()->with('toast_success', 'Data berhasil dihapus');
    }
}

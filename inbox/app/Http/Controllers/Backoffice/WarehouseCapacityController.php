<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseCapacityController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::with('type')
            ->search('name')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('backoffice.warehouse-capacity.index', compact('warehouses'));
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);

        if($request->kapasitas >= 0){
            $warehouse->update([
                'capacity' => $request->kapasitas,
            ]);
            return back()->with('toast_success', 'Kapasitas berhasil ditingkatkan');
        } else {
            return back()->with('toast_error', 'Mohon masukan kapasitas yg valid');
        }


    }
}

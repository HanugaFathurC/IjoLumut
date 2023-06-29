<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Warehouse;
use App\Traits\HasImage;
use App\Http\Requests\WarehouseRequest;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    use HasImage;
    public $path = 'public/warehouses/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::with(['type', 'city', 'province', 'district', 'village'])
        ->search('name')
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('backoffice.warehouse.index', compact('warehouses'));
    }

    public function provinces()
    {
        return \Indonesia::allProvinces();

    }

    public function cities(Request $request)
    {
        $data['cities'] = \Indonesia::findProvince($request->id, ['cities'])->cities->pluck('name', 'id');

        return response()->json($data);
    }

    public function districts(Request $request)
    {
        $data['districts'] = \Indonesia::findCity($request->id, ['districts'])->districts->pluck('name', 'id');

        return response()->json($data);
    }

    public function villages(Request $request)
    {

        $data['villages'] = \Indonesia::findDistrict($request->id, ['villages'])->villages->pluck('name', 'id');

        return response()->json($data);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $provinces = $this->provinces();

        return view('backoffice.warehouse.create', compact('types','provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseRequest $request)
    {
        $image = $this->uploadImage($request, $this->path);


        Warehouse::create([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'indonesia_provinces_id' => $request->indonesia_provinces_id,
            'indonesia_cities_id' => $request->indonesia_cities_id,
            'indonesia_districts_id' => $request->indonesia_districts_id,
            'indonesia_villages_id' => $request->indonesia_villages_id,
            'address' => Str::upper($request->address) ,
            'telp' => $request->telp,
            'image' => $image->hashName(),
        ]);

        return redirect(route('backoffice.warehouse.index'))->with('toast_success', 'Data berhasil disimpan');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        $types = Type::all();
        $provinces = $this->provinces();
        $city = \Indonesia::FindCity($warehouse->indonesia_cities_id, null);
        $distric = \Indonesia::FindDistrict($warehouse->indonesia_districts_id, null);
        $village = \Indonesia::FindVillage($warehouse->indonesia_villages_id, null);
        return view('backoffice.warehouse.edit', compact('types','warehouse', 'provinces', 'city', 'distric', 'village'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WarehouseRequest $request, Warehouse $warehouse)
    {
        $image = $this->uploadImage($request, $this->path);

        $warehouse->update([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'indonesia_provinces_id' => $request->indonesia_provinces_id,
            'indonesia_cities_id' => $request->indonesia_cities_id,
            'indonesia_districts_id' => $request->indonesia_districts_id,
            'indonesia_villages_id' => $request->indonesia_villages_id,
            'address' => Str::upper($request->address) ,
            'telp' => $request->telp,
        ]);

        if($request->file('image')){
            $this->updateImage($this->path, $warehouse, $name = $image->hashName());
        }

        return redirect(route('backoffice.warehouse.index'))->with('toast_success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        Storage::disk('local')->delete($this->path. basename($warehouse->image));

        $warehouse->delete();

        return redirect(route('backoffice.warehouse.index'))->with('toast_success', 'Data berhasil dihapus');

    }
}

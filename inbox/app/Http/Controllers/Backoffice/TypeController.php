<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Traits\HasImage;
use App\Http\Requests\TypeRequest;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{
    use HasImage;
    private $path = 'public/types/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::search('name')
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('backoffice.type.index', compact('types'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {
        $image = $this->uploadImage($request, $this->path);

        Type::create([
            'name' => $request->name,
            'image' => $image->hashName(),
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
    public function update(TypeRequest $request, Type $type)
    {
        $image = $this->uploadImage($request, $this->path);

        $type->update([
            'name' => $request->name,
        ]);

        if($request->file('image')){
            $this->updateImage($this->path, $type, $name = $image->hashName());
        }

        return back()->with('toast_success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        Storage::disk('local')->delete($this->path. basename($type->image));

        $type->delete();

        return back()->with('toast_success', 'Data berhasil dihapus');
    }
}

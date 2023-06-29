@extends('layouts.backoffice.master', ['title' => 'Ubah Produk'])

@section('content')
    <x-container>
        <div class="col-12">
            <x-card title="Ubah Produk" class="card-body">
                <form action="{{ route('backoffice.product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-input title="Nama Produk" name="name" type="text" placeholder="Masukan Nama Produk"
                        value="{{ $product->name }}" />
                    <x-input title="Gambar Produk" name="image" type="file" placeholder=""
                        value="{{ $product->image }}" />
                    <div class="row">
                        <div class="col-6">
                            <x-input title="Harga Produk" name="harga" type="number" placeholder="Masukan Harga Produk"
                                value="{{ $product->price }}" />
                        </div>
                        <div class="col-6">
                            <x-input title="Satuan Produk" name="unit" type="text" placeholder="Masukan Satuan Produk"
                                value="{{ $product->unit }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <x-select title="Kategori" name="category_id">
                                <option value="" selected>Silahkan Pilih Kategori Produk</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-6">
                            <x-select title="Warehouse" name="warehouse_id">
                                <option value="" selected>Silahkan Pilih Gudang Produk</option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}" @selected($product->warehouse_id == $warehouse->id)>
                                        {{ $warehouse->name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                        <x-textarea title="Deskripsi Produk" name="description" placeholder="Masukan Deskripsi Produk">
                            {{ $product->description }}</x-textarea>
                    </div>
                    <x-button-save title="Simpan" />
                </form>
            </x-card>
        </div>
    </x-container>
@endsection

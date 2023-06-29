@extends('layouts.backoffice.master', ['title' => 'Warehouse'])

@section('content')
    <x-container>
        <div class="col-12">
            @can('warehouse-create')
                <a href="{{ route('backoffice.warehouse.create') }}" class="btn btn-dark mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-plus" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                        <line x1="9" y1="12" x2="15" y2="12"></line>
                        <line x1="12" y1="9" x2="12" y2="15"></line>
                    </svg>
                    Tambah Gudang
                </a>
            @endcan
            <x-card-action title="Daftar Gudang" url="{{ route('backoffice.warehouse.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th class="align-middle">#</th>
                            <th class="align-middle">Gambar</th>
                            <th class="align-middle">Nama Gudang</th>
                            <th class="align-middle">Tipe</th>
                            <th class="align-middle">Alamat</th>
                            <th class="align-middle">Telpon</th>
                            <th class="align-middle">Ketersediaan Produk</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($warehouses as $i => $warehouse)
                            <tr>
                                <td>{{ $i + $warehouses->firstItem() }}</td>
                                <td>
                                    <span class="avatar rounded avatar-md"
                                        style="background-image: url({{ $warehouse->image }})"></span>
                                </td>
                                <td>{{ $warehouse->name }}</td>
                                <td>{{ $warehouse->type->name }}</td>
                                <td>{{ $warehouse->address }}, DESA {{ $warehouse->village->name }}, KECAMATAN
                                    {{ $warehouse->district->name }}, {{ $warehouse->city->name }},
                                    {{ $warehouse->province->name }}</td>
                                <td>{{ $warehouse->telp }}</td>
                                <td>{{ $warehouse->storage }}</td>
                                <td>
                                    @can('warehouse-update')
                                        <a href="{{ route('backoffice.warehouse.edit', $warehouse->id) }}"
                                            class="btn btn-info btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                </path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>
                                            Ubah Data
                                        </a>
                                    @endcan
                                    @can('warehouse-delete')
                                        <x-button-delete id="{{ $warehouse->id }}" title="Hapus Data"
                                            url="{{ route('backoffice.warehouse.destroy', $warehouse->id) }}" />
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $warehouses->links() }}</div>
        </div>
    </x-container>
@endsection

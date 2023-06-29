@extends('layouts.backoffice.master', ['title' => 'Kapasitas Gudang'])

@section('content')
    <x-container>
        <div class="col-12">
            <x-card-action title="Daftar Gudang" url="{{ route('backoffice.warehouse-capacity.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama Gudang</th>
                            <th>Tipe</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
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
                                <td class="text-blue">
                                    {{ $warehouse->capacity }}
                                </td>
                                <td>
                                    <x-button-modal id="{{ $warehouse->id }}" title="Tambah Kapasitas" />
                                    <x-modal id="{{ $warehouse->id }}" title="Tambah Kapasitas">
                                        <form action="{{ route('backoffice.warehouse-capacity.update', $warehouse->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <x-input title="Jumlah Kapasitas" name="kapasitas" type="number" placeholder=""
                                                value="{{ $warehouse->capacity }}" />
                                            <x-button-save title="Simpan" />
                                        </form>
                                    </x-modal>
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

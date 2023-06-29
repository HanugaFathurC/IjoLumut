@extends('layouts.backoffice.master', ['title' => 'Type'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card-action title="Daftar Tipe" url="{{ route('backoffice.type.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama Tipe</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $i => $type)
                            <tr>
                                <td>{{ $i + $types->firstItem() }}</td>
                                <td>
                                    <span class="avatar rounded avatar-md"
                                        style="background-image: url({{ $type->image }})"></span>
                                </td>
                                <td>{{ $type->name }}</td>
                                <td>
                                    @can('type-update')
                                        <x-button-modal id="{{ $type->id }}" title="Ubah Data" />
                                        <x-modal id="{{ $type->id }}" title="Ubah Data">
                                            <form action="{{ route('backoffice.type.update', $type->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <x-input title="Nama Tipe" name="name" type="text"
                                                    placeholder="Masukan Nama Tipe" value="{{ $type->name }}" />
                                                <x-input title="Gambar Tipe" name="image" type="file" placeholder=""
                                                    value="{{ $type->image }}" />
                                                <x-button-save title="Simpan" />
                                            </form>
                                        </x-modal>
                                    @endcan
                                    @can('type-delete')
                                        <x-button-delete id="{{ $type->id }}" title="Hapus Data"
                                            url="{{ route('backoffice.type.destroy', $type->id) }}" />
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $types->links() }}</div>
        </div>
        @can('type-create')
            <div class="col-12 col-lg-4">
                <form action="{{ route('backoffice.type.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-card title="Tambah Tipe" class="card-body">
                        <x-input title="Nama Tipe" name="name" type="text" placeholder="Masukan Nama Tipe"
                            value="{{ old('name') }}" />
                        <x-input title="Gambar Tipe" name="image" type="file" placeholder=""
                            value="{{ old('image') }}" />
                        <x-button-save title="Simpan" />
                    </x-card>
                </form>
            </div>
        @endcan
    </x-container>
@endsection

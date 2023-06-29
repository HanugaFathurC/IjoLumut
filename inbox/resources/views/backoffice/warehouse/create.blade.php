@extends('layouts.backoffice.master', ['title' => 'Tambah Gudang'])

@section('content')
    <x-container>
        <div class="col-12">
            <x-card title="Tambah Gudang" class="card-body">
                <form action="{{ route('backoffice.warehouse.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <x-input title="Nama Gudang" name="name" type="text" placeholder="Masukan Nama Gudang"
                                value="{{ old('name') }}" />

                        </div>
                        <div class="col-6">
                            <x-input title="Nomor Telpon" name="telp" type="tel"
                                placeholder="Masukan Nomor Telpon Gudang" value="{{ old('telp') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <x-input title="Gambar Gudang" name="image" type="file" placeholder=""
                                value="{{ old('image') }}" />
                        </div>
                        <div class="col-6">
                            <x-select title="Tipe" name="type_id" id="type_id">
                                <option value="" selected>Silahkan Pilih Tipe Gudang</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" @selected(old('type_id') == $type->id)>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <x-select title="Provinsi" name="indonesia_provinces_id" id="indonesia_provinces_id">
                                <option value="" selected>-- Pilih Provinsi --</option>
                                {{-- @foreach ($provinces as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach --}}
                                @foreach ($provinces as $item)
                                    <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-6">
                            <x-select title="Kabupaten/Kota" name="indonesia_cities_id" id="indonesia_cities_id">
                                <option value="" selected>-- Pilih Kabupaten/Kota --</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <x-select title="Kecamatan" name="indonesia_districts_id" id="indonesia_districts_id">
                                <option value="" selected>-- Pilih Kecamatan --</option>
                            </x-select>
                        </div>
                        <div class="col-6">
                            <x-select title="Desa" name="indonesia_villages_id" id="indonesia_villages_id">
                                <option value="" selected>-- Pilih Desa --</option>
                            </x-select>
                        </div>
                    </div>

                    <div class="row">
                        <x-textarea title="Alamat Gudang" name="address" placeholder="Masukan Alamat Gudang" />
                    </div>
                    <a href="{{ route('backoffice.warehouse.index') }}" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="11 7 6 12 11 17"></polyline>
                            <polyline points="17 7 12 12 17 17"></polyline>
                        </svg> Kembali
                    </a>
                    <x-button-save title="Simpan" />
                </form>
            </x-card>
        </div>
    </x-container>
@endsection
@push('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#indonesia_provinces_id').on('change', function() {
                let id_provinsi = this.value;
                console.log('Code provinsi: ' + id_provinsi);
                $.ajax({
                    url: '{{ url('backoffice/warehouse/create/cities') }}',
                    method: 'POST',
                    data: {
                        id: id_provinsi,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {

                        $.each(response.cities, function(id, name) {
                            $('#indonesia_cities_id').append('<option value="' + id +
                                '">' + name + '</option>');
                        });
                    }
                })
            });
            $('#indonesia_cities_id').on('change', function() {
                let id_kota = this.value;
                console.log('code kota: ' + id_kota);
                $.ajax({
                    url: '{{ url('backoffice/warehouse/create/districts') }}',
                    method: 'POST',
                    data: {
                        id: id_kota,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {

                        $.each(response.districts, function(id, name) {
                            $('#indonesia_districts_id').append('<option value="' + id +
                                '">' + name + '</option>');
                        });
                    }
                })
            })
            $('#indonesia_districts_id').on('change', function() {
                let id_kecamatan = this.value;
                console.log('code kecamatan: ' + id_kecamatan);
                $.ajax({
                    url: '{{ url('backoffice/warehouse/create/villages') }}',
                    method: 'POST',
                    data: {
                        id: id_kecamatan,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        $.each(response.villages, function(id, name) {
                            $('#indonesia_villages_id').append('<option value="' + id +
                                '">' + name + '</option>');
                        });
                    }
                })
            })
        });
    </script>
@endpush

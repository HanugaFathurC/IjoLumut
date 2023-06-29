@extends('layouts.backoffice.master', ['title' => 'Edit Kriteria'])

@section('content')
    <x-container>
        <div class="col-12">
            <x-card title="Edit Kriteria" class="card-body">
                <form action="{{ route('backoffice.criteria.update', $criteria) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <x-input title="Bobot" name="weight" type="text" placeholder=""
                                value="{{ $criteria->weight }}" />
                        </div>
                    </div>
                    <a href="{{ route('backoffice.criteria.index') }}" class="btn btn-danger">
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

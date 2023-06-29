@extends('layouts.backoffice.master', ['title' => 'Criteria'])

@section('content')
    <x-container>
        <div class="col-12">
            <x-card title="Kriteria SAW" class="card-body">
                <x-table>
                    <thead>
                        <tr>
                            <th class="align-middle">Nama Kriteria</th>
                            <th class="align-middle">Bobot</th>
                            <th class="align-middle">Sifat</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($criterias as $criteria)
                            <tr>
                                <td>{{ $criteria->name }}</td>
                                <td>{{ $criteria->weight }}</td>
                                <td>{{ $criteria->attribute }}</td>
                                <td>
                                    {{-- @can('criteria-update') --}}
                                    <a href="{{ route('backoffice.criteria.edit', $criteria) }}" class="btn btn-info btn-sm">
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
                                    {{-- @endcan --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card>


        </div>
    </x-container>
@endsection

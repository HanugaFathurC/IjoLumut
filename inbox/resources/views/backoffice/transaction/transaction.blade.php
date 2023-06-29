@extends('layouts.backoffice.master', ['title' => 'Barang Masuk'])

@section('content')
    <x-container>
        <div class="col-12">
            <x-card-action title="Daftar Transaksi" url="{{ route('backoffice.transaction') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Invoice</th>
                            <th>Nama Produk</th>
                            <th>Kuantitas Produk</th>
                            <th>Tanggal Transaksi</th>
                            <th colspan="2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $i => $transaction)
                            <tr>
                                <td>{{ $i + $transactions->firstItem() }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->invoice }}</td>
                                <td>
                                    @foreach ($transaction->details as $detail)
                                        <li>{{ $detail->product->name }}</li>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($transaction->details as $detail)
                                        <li>{{ $detail->quantity }}</li>
                                    @endforeach
                                </td>
                                <td>
                                    <li>{{ $transaction->created_at->format('d-m-Y') }}</li>
                                </td>
                                <td>
                                    {{ $transaction->payment_status }}
                                </td>
                                <td>
                                    @if ($transaction->payment_status == 'waiting')
                                        <a href="{{ $transaction->midtrans_url }}">Bayar Sekarang</a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $transactions->links() }}</div>
        </div>
    </x-container>
@endsection

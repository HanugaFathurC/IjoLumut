@extends('layouts.landing.master', ['title' => 'Inbox'])

@section('content')
    <section class="grid min-h-full place-items-center bg-white  py-24 sm:py-32 lg:px-8">
        <div class="text-center ">
            <img src="{{ asset('resources/Image/success-order.png') }}" alt="success" class="w-100 mb-8 mx-auto">
            <h1 class="text-2xl font-bold text-blue-500 mb-2">Permintaan Penyewaan Telah Sukses Dilakukan</h1>
            <p class="text-xl text-gray-600 mb-12">Lakukan pembayaran lalu tunggu kami menghubungi Anda dalam 24 jam</p>
            <a href="{{ route('backoffice.dashboard') }}"
                class="bg-blue-500 text-white py-2 px-4 rounded  hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                Bayar Sekarang
            </a>
        </div>
    </section>
@endsection

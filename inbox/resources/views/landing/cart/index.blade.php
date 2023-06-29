@extends('layouts.landing.master', ['title' => 'Keranjang'])

@section('content')
    <div class="container my-4 px-6 mx-auto">
        <h1 class="text-2xl font-extrabold mb-5 ml-28 pt-7">Keranjang</h1>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8">
                <x-landing.cart-table :carts=$carts :grandQuantity=$grandQuantity />
            </div>
            <div class="lg:col-span-4">
                <x-landing.cart-form :carts=$carts :grandPrice=$grandPrice />
            </div>
        </div>
    </div>
@endsection

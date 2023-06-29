@extends('layouts.landing.master', ['title' => 'Inbox'])

@section('content')
    @include('layouts.landing.partials.hero')
    <section class="container my-4 mx-auto px-6 ">
        <h2 class="text-gray-700 font-semibold text-lg">Daftar Kategori</h2>
        <div
            class="lg:p-4 flex flex-row gap-4 flex-cols-4 overflow-x-auto sm:grid sm:grid-cols-2 md:gap-2 lg:gap-3 lg:grid-cols-4">
            <a href="{{ route('product.index') }}"
                class="min-w-full p-2 flex flex-row items-center gap-4 rounded-lg bg-white border border-l-4 border-l-sky-700 lg:hover:scale-105 duration-100 lg:transition-transform  hover:border-l-sky-400 transition-colors group shadow-md">
                <img src="#" alt="all" class="object-cover w-10 rounded-lg">
                <div>
                    <h2 class="text-base text-gray-700 ">All</h2>
                </div>
            </a>
            @foreach ($types as $type)
                <x-landing.type-item :type=$type />
            @endforeach
        </div>
    </section>
    <section class="container my-4 mx-auto px-6 ">
        <x-landing.search-header title="Daftar Produk" url="" />
        <div class="my-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @if (count($products) == null)
                <p class="my-3 font-semibold text-gray-700 text-center col-start-1 col-end-7 ">Produk tidak tersedia</p>
            @else
                @foreach ($products as $product)
                    <x-landing.product-item :product=$product />
                @endforeach
            @endif
        </div>
        <div class="flex justify-end mt-3">
            {{ $products->links('pagination::tailwind') }}</div>
    </section>
@endsection

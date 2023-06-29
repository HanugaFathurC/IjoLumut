@extends('layouts.landing.master', ['title' => 'Inbox'])


@section('content')
    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-5/6 mx-auto flex flex-wrap">
                <img alt="{{ $product->name }}"
                    class="lg:w-1/2 lg:h-4/5 w-full object-cover object-center rounded border border-gray-200 mt-6 shadow-md"
                    src="{{ $product->image }}">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-14 lg:mt-0 flex flex-col justify-between">
                    <h1 class="text-gray-900 text-2xl font-bold  ">{{ $product->name }}</h1>
                    <h2 class="text-sm text-gray-500 mt-2 mb-2 tracking-widest">{{ $product->warehouse->type->name }}</h2>

                    <span class="title-font font-bold text-3xl text-gray-900 mt-6">Rp
                        {{ number_format($product->price, 2, ',', '.') }}</span>

                    @if ($product->quantity > 0)
                        <p class="mb-3 font-bold text-orange-600 my-4 ">Stok tersedia: {{ $product->quantity }}</p>
                    @else
                        <p class="mb-3 font-semibold text-gray-700 ">Stok tidak tersedia</p>
                    @endif
                    <div class="border-t border-b mt-10 mb-6">
                        <span class="inline-block font-bold  py-2 bg-white text-blue-700">
                            Detail
                        </span>
                    </div>
                    <h3 class="title-font text-gray-500 "> Kategori <br />
                        <span class="text-black font-medium"> {{ $product->category->name }}</span>
                    </h3>

                    <h3 class="title-font text-gray-500 py-4"> Deskripsi Produk <br>
                        <span class="text-black font-medium"> {{ $product->description }}</span>
                    </h3>

                    <h3 class="title-font text-gray-500 "> Tersimpan di {{ $product->warehouse->name }}<br>
                        <span class="text-black font-medium">
                            {{ $product->warehouse->address }}, {{ $product->warehouse->village->name }},
                            {{ $product->warehouse->district->name }}, {{ $product->warehouse->city->name }},
                            {{ $product->warehouse->province->name }}
                        </span>
                    </h3>
                    @if ($product->quantity > 0)
                        <div class="flex justify-between mt-8 items-center">
                            <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                @csrf
                                <button
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                    type="submit">
                                    <img src="{{ asset('resources/Image/add-shopping-cart.svg') }}" alt="icon-add-chart">
                                    Pilih Produk
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex justify-between mt-8 items-center">
                            <a href="#" style="pointer-events: none"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                                <img src="{{ asset('resources/Image/add-shopping-cart.svg') }}" alt="icon-add-chart">
                                Pilih Produk
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@props(['product'])

<div
    class="bg-white border border-gray-200 justify-center rounded-lg shadow hover:scale-105 transition-transform duration-200">
    <div class="w-13 h-64">
        <img class="rounded-t-lg w-full h-full object-cover " src="{{ $product->image }}" alt="{{ $product->name }}" />
    </div>
    <div class="p-5">
        <a href="{{ route('product.show', $product->slug) }}">
            <h4 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $product->name }}</h4>
        </a>
        <p class="text-gray-800 text-xl font-bold">
            Rp {{ number_format($product->price, 2, ',', '.') }}/Bulan
        </p>
        @if ($product->quantity > 0)
            <p class="mb-3 font-bold text-orange-600">Stok tersedia: {{ $product->quantity }}</p>
            <div class="flex justify-between  items-center">
                <p class="font-light">{{ $product->warehouse->type->name }}</p>
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
            <p class="mb-3 font-semibold text-gray-700 ">Stok tidak tersedia</p>
            <div class="flex justify-between  items-center">
                <p class="font-light">{{ $product->warehouse->type->name }}</p>
                <a href="#" style="pointer-events: none"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                    <img src="{{ asset('resources/Image/add-shopping-cart.svg') }}" alt="icon-add-chart">
                    Pilih Produk
                </a>
            </div>
        @endif
    </div>
</div>

@props(['carts', 'grandPrice'])
<form action="{{ route('transaction.store') }}" method="POST">
    @csrf
    <div class="border rounded-lg overflow-hidden">
        <div class="bg-white px-4 py-3 flex items-center">
            <p class="text-black text-2xl font-extrabold ml-1">Konfirmasi Pesanan</p>
        </div>
        <div class="p-4 bg-white">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-y-2">
                    <input type="text"
                        class="rounded-md border p-2 text-sm text-gray-700 focus:outline-none bg-gray-100 cursor-not-allowed"
                        value="{{ Auth::user()->name }}" name="name" readonly />
                </div>
                <div class="flex flex-col gap-y-2">
                    <input type="email"
                        class="rounded-lg border p-2 text-sm text-gray-700 focus:outline-none bg-gray-100 cursor-not-allowed"
                        value="{{ Auth::user()->email }}" name="email" readonly />

                </div>
                <h2 class="pt-2 font-extrabold ml-1">Rekap Order</h2>
                @forelse ($carts as $i=>$cart)
                    <div class="flex flex-col ml-1 gap-y-3 justify-between">
                        <label class="text-lg font-semibold">
                            {{ $cart->product->name }}
                        </label>
                        <div class="flex justify-between ">
                            <label class="text-gray-600 "> Harga </label>
                            <label>Rp {{ number_format($cart->product->price, 3, '.') }} </label>
                        </div>
                        <div class="flex justify-between ">
                            <label class="text-gray-600 w-12 justify-between"> Banyak </label>
                            <label> {{ $cart->quantity }} </label>
                        </div>
                        <div class="flex justify-between ">
                            <label class="text-gray-600 w-12 justify-between"> Durasi </label>
                            <label> {{ $cart->durasi }} Bulan</label>
                        </div>
                        <div class="flex justify-between">
                            <label class="text-gray-600"> Biaya </label>
                            <label class="text-blue-700 font-extrabold ml-16"> Rp
                                {{ number_format($cart->tagihan, 3, '.') }} </label>
                        </div>
                    </div>
                    <hr>
                @empty
                    <label class="text-base text-gray-700">
                        Belum ada produk di keranjang
                    </label>
                @endforelse
                <div class="flex justify-between">
                    <h3 class="text-base text-gray-700 font-bold">
                        Total Tagihan
                    </h3>
                    <p class=" text-blue-700 font-extrabold ">
                        Rp {{ number_format($grandPrice, 3, '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="my-3">
        <button class="text-white bg-blue-700 rounded-lg w-full p-2" type="submit"
            {{ $carts->isEmpty() ? 'disabled' : '' }}>
            Order Sekarang
        </button>
    </div>
</form>

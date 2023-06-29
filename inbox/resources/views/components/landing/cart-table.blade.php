@props(['carts', 'grandQuantity'])

@forelse ($carts as $i=>$cart)
    <div
        class="flex flex-col md:flex-row md:justify-between items-start shadow-md rounded-md py-4 px-4 my-4 md:max-w-2xl">
        <div class="flex items-center justify-between sm:gap-4 md:gap-12 ">
            <div>
                <a href="#" class="text-red-600 " onclick="deleteData({{ $cart->id }})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-minus"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                        <line x1="9" y1="12" x2="15" y2="12"></line>
                    </svg>
                </a>
                <form id="delete-form-{{ $cart->id }}" action="{{ route('cart.destroy', $cart->id) }}"
                    method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            <div class="sm:w-min-12  sm:w-min-12 md:w-40 md:h-40 ">
                <img class="md:w-full md:h-full md:object-cover" src="{{ $cart->product->image }}"
                    alt="{{ $cart->product->name }}">
            </div>
            <div class=" ">
                <p class="text-xl font-bold mb-2">{{ $cart->product->name }}</p>
                <p class="text-blue-600 text-lg font-bold mb-4"> Rp{{ number_format($cart->product->price, 3, '.') }}
                </p>
                <div class="flex items-center flex-wrap md:justify-between sm:justify-end sm:gap-4">
                    <div class="md:flex md:gap-4">
                        <div class="flex sm:justify-evenly">
                            <label for="quantity" class=" flex-col text-md font-bold mr-4 mt-1">Jumlah:</label>
                            <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number"value="{{ $cart->quantity }}" type="number" name="quantity"
                                    min="1" class="border border-gray-300 rounded-lg py-2 px-4 text-sm w-16  ">
                            </form>

                        </div>
                        <div class="flex sm:justify-evenly">
                            <label for="quantity" class=" flex-col text-md font-bold mr-4 mt-1 ">Sewa/Bulan:</label>
                            <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="durasi" value="{{ $cart->durasi }}" min="1"
                                    class="border border-gray-300 rounded-lg py-2 px-4 text-sm w-16  ">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@empty
    <table class="w-full text-sm text-left text-gray-500  divide-y divide-gray-200 ">
        <tbody class="divide-y divide-gray-200 bg-white">
            <tr>
                <td class="px-6 py-4" colspan="6">
                    <div class="flex items-center justify-center h-96">
                        <div class="text-center flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-basket"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <polyline points="7 10 12 4 17 10"></polyline>
                                <path d="M21 10l-2 8a2 2.5 0 0 1 -2 2h-10a2 2.5 0 0 1 -2 -2l-2 -8z"></path>
                                <circle cx="12" cy="15" r="2"></circle>
                            </svg>
                            <div class="mt-5">
                                Keranjang Anda Kosong
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
@endforelse
<!-- <tr>
            <td class="py-3 px-20 ml-24 whitespace-nowrap text-green-400">Total item</td>
            {{ $grandQuantity }} Item
            </td>
        </tr> -->
</tbody>
</table>

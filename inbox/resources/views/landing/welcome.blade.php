@extends('layouts.landing.master', ['title' => 'Inbox'])

@section('content')
    <section class="grid min-h-full place-items-center bg-no-repeat bg-cover bg-center px-6 py-24 sm:py-32 "
        style="background-image: url({{ asset('resources/Image/landingpage.png') }});">
        <article class="container my-4 mx-auto lg:py-24 lg:px-6">
            <h1 class="text-4xl font-bold md:text-6xl lg:pt-10 text-white " data-aos="fade-up">DAPATKAN PELAYANAN
                <br>TERBAIK DARI INBOX
            </h1>
            <p class="text-lg text-white pt-5 sm:text-xl" data-aos="fade-up">INBOX akan membantu Anda dalam menyimpan produk
                Anda</p>
            <p class="text-lg text-white pb-6 sm:text-xl" data-aos="fade-up">Fasilitas penyimpanan yang aman, terpercaya, dan
                terjangkau</p>
            <button type="button" class="w-80  bg-orange-500 rounded-lg text-white   sm:w-48 py-3 px-4 "
                data-aos="fade-up"><a href="{{ route('product.index') }}">MULAI SEKARANG</a></button>
        </article>
    </section>


    <section class="container my-4 mx-auto px-6 text-center">
        <article class="py-14 md:py-24 ">
            <h2 class="text-4xl font-bold" data-aos="fade-up">Top Gudang Penyimpanan</h2>
            <p class="text-base text-gray-500 pt-3 sm:text-xl" data-aos="fade-up">Kami menyediakan beberapa kategori
                gudang
                yang akan membantu Anda <br>
                dalam menyimpan produk dengan aman dan mudah.</p>

            @if (count($bestTypeWarehouses) <= 3)
                <p class="text-base text-gray-500 pt-3 sm:text-xl">Mohon maaf, belum ada rekomendasi gudang untukmu</p>
            @else
                <div class="grid mt-10 md:grid-cols-3 gap-6 md:gap-x-12">
                    <!-- Star contents top category of warehousing -->
                    @foreach ($bestTypeWarehouses as $type)
                        <div class="mb-6 bg-white shadow-md p-5 lg:mb-0" data-aos="fade-up">
                            <img src="{{ asset('storage/types/') }}/{{ basename($type->image) }}"
                                alt="gudang-{{ $type->name }}" class="w-full rounded-sm">
                            <p class="font-semibold pt-4 pb-6 text-left">{{ $type->name }}

                            </p>
                        </div>
                    @endforeach

                    <!--End contents top category -->

                </div>
            @endif
        </article>
    </section>


    <section class="bg-back">
        <article class="container my-4 mx-auto px-6 py-10 md:py-24 lg:py-32">
            <div class="mb-10 lg:mb-20" data-aos="fade-up">
                <h2 class="font-inter text-4xl font-bold text-center">Kenapa INBOX?</h2>
                <p class="text-base text-gray-500 pt-3 mx-10 sm:text-xl text-center" data-aos="fade-up">INBOX telah
                    digunakan oleh {{ $users }} pengguna dalam selama beroperasi.
                    <br>INBOX telah menawarkan sebanyak {{ $products }} produk jasa penyimpanan.
                    <br>INBOX juga telah mencapai {{ $transactions }} transaksi.
                </p>
            </div>
            <div class="flex flex-col gap-10 text-center md:flex-row md:justify-evenly">
                <div data-aos="fade-up">
                    <h3 class="text-4xl font-bold text-blue-700 md:text-6xl lg:text-8xl">{{ $users }}</h3>
                    <p class="font-semibold text-xl pt-2 sm:pt-5">Pengguna</p>
                </div>
                <div data-aos="fade-up">
                    <h3 class="text-4xl font-bold text-blue-700 md:text-6xl lg:text-8xl">{{ $transactions }}</h3>
                    <p class="font-semibold text-xl pt-2 sm:pt-5">Transaksi</p>
                </div>
                <div data-aos="fade-up">
                    <h3 class="text-4xl font-bold text-blue-700 md:text-6xl lg:text-8xl">{{ $products }}</h3>
                    <p class="font-semibold text-xl pt-2 sm:pt-5">Produk</p>
                </div>
            </div>
        </article>
    </section>

    <section class="container my-4 mx-auto px-6 py-10">
        <article class="py-10 md:py-15">
            <h2 class="text-4xl font-bold text-center mb-14 md:mb-28" data-aos="fade-up">Tentang Kami</h2>
            <div class="flex flex-col justify-between gap-10 lg:flex-row">
                <img src="{{ asset('resources/Image/ijolumut.png') }}" alt="company-image" class="w-full lg:w-1/2"
                    data-aos="fade-up">
                <div class="my-auto">
                    <h3 class="font-inter text-2xl font-bold text-center lg:text-left  " data-aos="fade-up">INBOZ
                    </h3>
                    <p class="font-inter text-2xl font-bold text-center lg:text-left" data-aos="fade-up">Warehouse
                        Company
                    </p>
                    <p class="pt-4 text-lg" data-aos="fade-up">INBOX adalah sebuah perusahaan yang
                        bergerak dalam bidang ERP terutama dalam
                        hal inventory management yaitu penyedia
                        jasa sewa penyimpanan barang di gudang
                        dengan mengedepankan kualitas dan kuantitas,
                        serta inovasi teknologi. </p>
                </div>
            </div>
        </article>

        <article class="text-center py-10 md:py-15">
            <div class="grid grid-cols-1 gap-10 md:grid-cols-3 md:justify-evenly">
                <div>
                    <img src="{{ asset('resources/Image/perusahaan.png') }}" alt="company-icon"
                        class="mx-auto mb-5 w-16 h-16" data-aos="fade-up">
                    <h3 class="font-bold text-lg" data-aos="fade-up">Informasi Perusahaan</h3>
                    <p class="text-gray-500" data-aos="fade-up">INBOX</p>
                    <p class="text-gray-500" data-aos="fade-up">Jalan Kaliurang</p>
                </div>
                <div>
                    <img src="{{ asset('resources/Image/lokasi.png') }}" alt="address-icon" class="mx-auto mb-5 w-16 h-16"
                        data-aos="fade-up">
                    <h3 class="font-bold text-lg" data-aos="fade-up">Alamat</h3>
                    <p class="text-gray-500" data-aos="fade-up">Sleman, DI Yogyakarta</p>
                    <p class="text-gray-500" data-aos="fade-up">Jalan Kaliurang KM.14</p>
                    <P data-aos="fade-up">Zip Codes/Postal <span class="text-gray-500" data-aos="fade-up">code:
                            03875</span>
                    </P>
                </div>
                <div>
                    <img src="{{ asset('resources/Image/hubungi.png') }}" alt="call-icon" class="mx-auto mb-5 w-16 h-16"
                        data-aos="fade-up">
                    <h3 class="font-bold text-lg" data-aos="fade-up">Hubungi Kami</h3>
                    <p class="text-gray-500" data-aos="fade-up">Hubungi kami untuk keperluan marketing
                        maupun kerjasama.</p>
                    <p class="font-semibold" data-aos="fade-up">hello@inbox.com</p>
                </div>
            </div>
        </article>
    </section>
@endsection

@push('aos')
    <script>
        AOS.init()
    </script>
@endpush

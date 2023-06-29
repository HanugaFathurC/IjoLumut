@extends('layouts.landing.master', ['title' => 'Inbox'])

@section('content')
    <section>
        <article class="container my-4 mx-auto px-6 text-center">
            <div class="py-10 md:py-20">
                <h1 class="text-4xl font-bold md:text-6xl " data-aos="fade-up">Inovasi Gudang Modern & Aman</h1>
                <p class="text-xl text-gray-500 mt-5 md:text-lg" data-aos="fade-up">Kami akan memberikan pelayanan maksimal
                    untuk menjaga kualitas
                    dan kuantitas produk Anda
                </p>
            </div>
        </article>
    </section>

    <section class="bg-back">
        <article class="container my-4 mx-auto px-6">
            <div class="grid grid-cols-1 gap-5 items-center py-10 md:py-20 md:grid-cols-5 justify-evenly" data-aos="fade-up">
                <img src="{{ asset('resources/Image/tentang/image 2.png') }}" alt="brand-matahari" class="mx-auto h-8">
                <img src="{{ asset('resources/Image/tentang/image 3.png') }}" alt="brand-nike" class="mx-auto h-8">
                <img src="{{ asset('resources/Image/tentang/image 6.png') }}" alt="brand-mayora" class="mx-auto h-8 ">
                <img src="{{ asset('resources/Image/tentang/image 4.png') }}" alt="brand-underarmor" class="mx-auto h-8">
                <img src="{{ asset('resources/Image/tentang/image 5.png') }}" alt="brand-sharp" class="mx-auto h-8">
            </div>
        </article>
    </section>

    <section>
        <article class="container my-4 mx-auto px-6">
            <div class="py-10 items-center flex flex-col gap-10 md:py-20 md:flex-row-reverse">
                <img src="{{ asset('resources/Image/tentang/laptop.png') }}" alt="dashboard-monitoring"
                    class="w-full md:w-1/2" data-aos="fade-up">
                <div data-aos="fade-up">
                    <h2 class="font-inter text-3xl font-bold md:text-4xl">Sistem Manajemen Gudang</h2>
                    <p class="text-gray-500 text-left mt-5 md:mt-10">Kami hadir untuk meningkatkan efisiensi operasional
                        dan menyediakan pelacakan inventaris sehingga Anda mendapatkan
                        kendali penuh atas produk Anda</p>
                </div>
            </div>
            <hr class="border-t-2">
        </article>
    </section>

    <section>
        <article class="container my-4 mx-auto px-6 py-10 md:py-20 ">
            <h2 class="font-inter text-center text-3xl font-bold md:text-4xl" data-aos="fade-up">Fasilitas Gudang</h2>
            <div class="grid grid-cols-1 items-center gap-10 py-10 md:py-20 lg:py-32 md:grid-cols-2 md:gap-20 lg:gap-30">
                <!-- Stars Facilities -->
                <div class="flex items-start gap-x-5">
                    <img src="{{ asset('resources/Image/tentang/fasil/key.png') }}" alt="folder-key"
                        class="w-10 h-1/2 md:w-20" data-aos="fade-up">
                    <div data-aos="fade-up">
                        <h3 class="font-bold text-lg">Aman & Transparan</h3>
                        <p class="text-gray-500">Sistem manajemen gudang kami memudahkan untuk
                            memonitor seluruh operasional produk Anda.
                        </p>
                    </div>
                </div>
                <div class="flex items-start  gap-x-5">
                    <img src="{{ asset('resources/Image/tentang/fasil/warehouse-bold.png') }}" alt="warehouse"
                        class="w-10 h-1/2 md:w-20" data-aos="fade-up">
                    <div data-aos="fade-up">
                        <h3 class="font-bold text-lg">Perawatan Sesuai</h3>
                        <p class="text-gray-500">Perawatan setiap produk Anda akan dilakukan
                            sesuai dengan jenis & kebutuhannya.
                        </p>
                    </div>

                </div>
                <div class="flex items-start  gap-x-5">
                    <img src="{{ asset('resources/Image/tentang/fasil/suhu.png') }} " alt="suhu"
                        class="w-10 h-1/2 md:w-20" data-aos="fade-up">
                    <div data-aos="fade-up">
                        <h3 class="font-bold text-lg">Suhu Gudang Terkontrol</h3>
                        <p class="text-gray-500">Perawatan setiap produk Anda akan dilakukan
                            sesuai dengan jenis & kebutuhannya.
                        </p>
                    </div>
                </div>
                <div class="flex items-start  gap-x-5">
                    <img src="{{ asset('resources/Image/tentang/fasil/telephone.png') }}" alt="telephone"
                        class="w-10 h-1/2 md:w-20" data-aos="fade-up">
                    <div data-aos="fade-up">
                        <h3 class="font-bold text-lg">Layanan Pelanggan 24/7</h3>
                        <p class="text-gray-500">Tim dukungan kami siap melayani Anda setiap hari.
                        </p>
                    </div>
                </div>
                <!-- End Facilities -->
            </div>
        </article>
    </section>
@endsection

@push('aos')
    <script>
        AOS.init()
    </script>
@endpush

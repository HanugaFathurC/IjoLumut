<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Inbox</title>
    <link rel="icon" href="{{ asset('resources/Image/Logo.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('resources/Image/Logo.png') }}" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body>

    <!-- <main class="font-inter">
        <h1>Pembayaran Sukses</h1>
        <a href="/" class="btn bg-blue-600">Kembali berbelanja</a>
    </main> -->

    
                <div class="text-center ">
                    <img src="{{ asset('resources/Image/checklist.png') }}" alt="success" class="w-100 mb-8 mx-auto">
                    <h1 class="text-2xl font-bold text-blue-500 mb-2">Pembayaran Sukses</h1>
                    <p class="text-xl text-gray-600 mb-12">Selamat menikmati kemudahan dalam aplikasi INBOX</p>
                    <a href="{{ route('backoffice.dashboard') }}"
                        class="bg-blue-500 text-white py-2 px-4 rounded  hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                        Back to home
                    </a>
                </div>
            </section>
        

</body>

</html>

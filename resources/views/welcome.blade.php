<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Магазин смартфонов</title>

        <!-- Шрифты -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- css -->
        <link rel="stylesheet" href="/css/basket.css">
        <!-- script -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script type="text/javascript" src="/js/ServerRequest.js" defer=""></script>
        <script type="text/javascript" src="/js/basket.js" defer=""></script>

    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <!-- навигационная панель -->
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <!-- показывает число товаров в корзине-->
                        @if($basket_phone_count == 0)
                        <span id='basket-phone-count' class='border-2 border-solid rounded-full bg-yellow-300 p-2 hidden'>0</span>
                        @else
                        <span id='basket-phone-count' class='border-2 border-solid rounded-full bg-yellow-300 p-2'>{{$basket_phone_count}}</span>
                        @endif

                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Корзина</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Вход</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Регистрация</a>
                        @endif
                    @endauth
                </div>
            @endif
            <!-- контент -->
            <div class="max-w-7xl mx-auto p-6 lg:p-8 w-3/4 flex flex-wrap justify-around">
                <!-- список телефонов магазина -->
                @foreach ($phones as $phone)
                <div class='inline-block py-6 px-12 mb-6 border-solid border-2 shadow-xl m-1 w-96'>
                    <form class='form-add-to-basket'>
                        @csrf
                        <input type="text" name='name' class='text-5xl p-2 mb-2 bg-inherit w-full' value="{{$phone->name}}" readonly>
                        <input type="text" name='price' class='text-2xl p-2 mb-2 bg-inherit w-full' value="{{$phone->price}}" readonly>
                        @if($is_auth)
                            Количество:
                            <input type="number" name='count' class='text-2xl p-2 mb-2 bg-inherit border-solid border-2' value=1 min=1 max=1000>
                            <br>
                            <input type='submit' class=' border-solid border-2 py-3 px-6 bg-yellow-300 border-inherit rounded-md' value='Добавить в корзину'>
                        @endif
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </body>
</html>

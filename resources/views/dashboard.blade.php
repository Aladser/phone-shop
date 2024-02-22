<x-app-layout>
    @section('title')
    <title>Корзина</title>
    @endsection
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Корзина
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(count($basket_phones) > 0)
                    <table class='w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-4'>
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th  scope="col" class="px-6 py-3 text-center">Название</th>
                                <th  scope="col" class="px-6 py-3 text-center">Цена</th>
                                <th  scope="col" class="px-6 py-3 text-center">Количество</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($basket_phones as $basket_phone)
                            <tr  class="phone bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="phone__name px-6 py-4 text-center">{{$basket_phone['name']}}</td>
                                <td class="phone__price px-6 py-4 text-center">{{$basket_phone['price']}} р.</td>
                                <td class="phone__count px-6 py-4 text-center">{{$basket_phone['count']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id='total-price' class='w-full py-2 text-center font-bold mb-4'>Итоговая сумма: {{$total_price}} руб.</div>
                    <form action="{{route('order.store')}}" method='post'>
                        @csrf
                        <input type="submit" class='border-solid border-2 py-3 px-6 bg-yellow-300 border-inherit rounded-md inline-block m-auto' value='Оформить заказ'>
                        <a href="{{route('order.index')}}" class='border-solid border-2 py-3 px-6 bg-yellow-300 border-inherit rounded-md inline-block m-auto'>Мои заказы</a>
                    </form>
                    @else
                        <p class='text-center text-2xl mb-4 text-red-600'>Ваша корзина пуста</p>
                        <a href="{{route('order.index')}}" class='border-solid border-2 py-3 px-6 bg-yellow-300 border-inherit rounded-md inline-block m-auto'>Мои заказы</a>
                    @endif
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>

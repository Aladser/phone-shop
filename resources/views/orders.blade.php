<x-app-layout>

    @section('js')
    <script type="text/javascript" src="/js/order.js" defer=""></script>
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мои заказы
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="p-6 text-gray-900">
                    <h2 class='text-center p-4 text-3xl'>Ваши заказы</h2>
                    @foreach ($orders as $key=>$order)
                    <article class='order py-6 px-12 mb-6 border-solid border-2 shadow-xl m-1 w-full'>
                        <h3 class='font-semibold p-2'><span class='order__id font-bold text-xl'>Заказ {{$key}}</span> от {{$order['created_at']}}</h3>
                        <p class='p-2'>Модели: {{$order['phones']}}</p>
                        <p class='p-2 mb-3'>Общая стоимость: {{$order['total_price']}} руб.</p>
                        <button class='border-solid border-2 py-3 px-6 bg-yellow-300 border-inherit rounded-md inline-block m-auto'>Отменить заказ</button>
                    </article>
                    @endforeach
                    <p class='text-center font-bold text-4xl'>Общая стоимость всех заказов</p>
                    <p class='text-center font-bold text-5xl'>{{$all_total_price}} руб.</p>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>

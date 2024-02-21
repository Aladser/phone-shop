<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="p-6 text-gray-900">
                    <h2 class='text-center p-4 text-3xl'>Ваши заказы</h2>
                    @foreach ($orders as $key=>$order)
                    <article class='py-6 px-12 mb-6 border-solid border-2 shadow-xl m-1 w-full'>
                        <h3 class='font-semibold'><span class='font-bold text-xl'>Заказ {{$key}}</span> от {{$order['created_at']}}</h3>
                        <p>Модели: {{$order['phones']}}</p>
                        <p>Общая стоимость: {{$order['total_price']}} руб.</p>
                    </article>
                    @endforeach
                    <p class='text-center font-bold text-4xl'>Общая стоимость всех заказов</p>
                    <p class='text-center font-bold text-5xl'>{{$all_total_price}} руб.</p>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>

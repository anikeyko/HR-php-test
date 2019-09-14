<h1>Заказ №{{ $order->id }} завершен</h1>
<br>
<h4>Список продуктов</h4>
<table class="table">
    <thead>
        <tr>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Стоимость</th>
            <th>Сумма</th>
        </tr>
    </thead>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>{{ $product->product->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->price }}</td>
            <td>{!! $product->price*$product->quantity !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<hr>
Общая стоимость: {{ $order->totalSum() }}
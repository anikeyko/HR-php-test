@extends('app')

@section('title')
    Заказы
@endsection

@section('content')
    <h1>Заказы</h1>
    @if (count($orders))
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Партнер</th>
                <th>Продукты</th>
                <th>Сумма</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>
                        <a href="{!! route('edit_order', ['id'=>$order->id]); !!}" target="_blank">{{ $order->id }}</a>
                    </td>
                    <td>{{ $order->partner->name }}</td>
                    <td>{{ $order->productsNames }}</td>
                    <td>{{ $order->totalSum() }}</td>
                    <td>
                        @switch($order->status)
                            @case(0)
                            <span class="label label-warning">Новый</span>
                            @break
                            @case(10)
                            <span class="label label-primary">Подтвержден</span>
                            @break
                            @case(20)
                            <span class="label label-success">Завершен</span>
                            @break
                        @endswitch
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-right">
            {{ $orders->links() }}
        </div>
    @else
        <p>Нет данных.</p>
    @endif

@endsection
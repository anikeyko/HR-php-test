@extends('app')

@section('title')
    Редактирование - {{ $order->id }}
@endsection

@section('content')
    <h1>Редактировать заказ</h1>
    <form action="{!! route('update_order', ['id'=>$order->id]) !!}" class="form-horizontal" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" name="client_email" id="email" type="email" required
                   value="{{ $order->client_email }}">
        </div>
        <div class="form-group">
            <label for="partner_id">Партнер</label>
            <select name="partner_id" id="partner_id" class="form-control">
                @foreach($partners as $partner)
                    <option value="{{ $partner->id }}" @if($partner==$order->partner) selected @endif>
                        {{ $partner->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" id="status" class="form-control">
                @foreach($statuses as $status => $statusName)
                    <option value="{{ $status }}" @if($status==$order->status) selected @endif>
                        {{ $statusName }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <h4>Состав заказа</h4>
            <table class="table">
                @foreach($order->products as $product)
                    <tr>
                        <td>{{ $product->product->name }}</td>
                        <td class="text-right">{{ $product->quantity }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <hr>
        <div class="text-right">
            <strong>Стоимость:</strong> {{ $order->totalSum() }}
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>

    </form>
@endsection
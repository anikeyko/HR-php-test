@extends('app')

@section('styles')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
          rel="stylesheet"/>
@endsection

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.price').editable({
                url: '{!! route('update_product') !!}',
                type: 'text',
                name: 'price',
                title: 'Цена',
                params: {
                    '_token': '{{ csrf_token() }}'
                }
            });
        });
    </script>
@endsection

@section('title')
    Продукты
@endsection

@section('content')
    <h1>Продукты</h1>
    @if (count($products))
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Наименование</th>
                <th>Поставщик</th>
                <th>Цена</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->vendor->name }}</td>
                    <td>
                        <a href="#" data-pk="{{ $product->id }}" class="price">{{ $product->price }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-right">
            {{ $products->links() }}
        </div>
    @else
        <p>Нет данных.</p>
    @endif

@endsection
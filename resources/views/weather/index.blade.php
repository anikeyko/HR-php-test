@extends('app')

@section('title')
    Погода в Брянске
@endsection

@section('content')
    <h1>Погода в Брянске</h1>
    <div>
        Температура: {{ $weather->getCurrentTemp() }}°, {{ $weather->getCondition() }} <br>
        Ветер: {{ $weather->getWindSpeed() }} м/с, {{ $weather->getWindDirection() }} <br>
        Давление: {{ $weather->getPressure() }} мм.рт.ст. <br>
        Влажность: {{ $weather->getHumidity() }}%
    </div>
@endsection
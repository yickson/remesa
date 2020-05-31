@extends('layouts.main')

@section('content')
    <div class="jumbotron">
        <p>Portal para el envío de remesas a Venezuela de forma óptima y segura, pagando la mejor tasa posible en el mercado,
            para que ayudes a tus familiares, amigos, de forma que se le de un gran valor a tu dinero, y así generes un lazo
            de confianza con nosotros.</p>
        <p class="lead">
            <a class="btn btn-primary" href="{{ route('register') }}" role="button">Regístrarme</a>
        </p>
    </div>
    <div class="row">
    <rate-now-component></rate-now-component>
    <rate-component></rate-component>
    </div>
@endsection

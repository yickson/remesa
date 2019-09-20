@extends('layouts.app')

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
        <div class="col-6">
            <div class="card bg-light mb-3">
                <div class="card-header">La tasa de hoy</div>
                <div class="card-body">
                    <h4 class="card-title">1 CLP a 21 Bs</h4>
                </div>
            </div>
        </div>
        <div id="app" class="col-6">
            <div class="card bg-light mb-3">
                <div class="card-header">Calculadora en tiempo real</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="monto">Pesos chilenos a Bolívares</label>
                        <input type="text" id="monto" class="form-control" value="100000">
                    </div>
                    <p id="total"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

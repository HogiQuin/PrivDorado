@extends('layouts.layout')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bienvenido!</h1>
    @if(!$no_house)
    <a href="{{ url('/payment/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-money-check fa-sm text-white-50"></i> Hacer Pago
    </a>
    @endif
</div>

@if($no_house)

<div class="row">
    <div class="col-lg-8 offset-lg-2 col-sm-12">
        <h2 class="text-center text-warning">Aun no tienes una casa asignada, por favor contacta al administrador</h2>
    </div>
</div>

@else

@include('dashboard.balance')
@include('dashboard.transactions')

@endif
@endsection
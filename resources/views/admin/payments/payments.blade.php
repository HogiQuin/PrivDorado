@extends('layouts.layout')

@section('content')
<h1>Gestion de pagos</h1>

<form action="{{ url('/admin/payments/') }}" method="GET">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <div class="form-group">
                <label for="paymentDate">Mes:</label>
                <select name="month" id="month" class="form-control">
                    <option value="1" {{ $ene }} >Enero</option>
                    <option value="2" {{ $feb }} >Febrero</option>
                    <option value="3" {{ $mar }} >Marzo</option>
                    <option value="4" {{ $abr }} >Abril</option>
                    <option value="5" {{ $may }} >Mayo</option>
                    <option value="6" {{ $jun }} >Junio</option>
                    <option value="7" {{ $jul }} >Julio</option>
                    <option value="8" {{ $ago }} >Agosto</option>
                    <option value="9" {{ $sep }} >Septiembre</option>
                    <option value="10" {{ $oct }} >Octubre</option>
                    <option value="11" {{ $nov }} >Noviembre</option>
                    <option value="12" {{ $dec }} >Diciembre</option>
                </select>
            </div>
        </div>
        <div class="col-md-2 col-sm-12">
            <div class="form-group">
                <label for="paymentDate"> &nbsp;</label>
                <button class="btn btn-primary btn-block">
                    <i class="fas fa-search fa-sm text-white-50"></i>
                    Filtrar
                </button>
            </div>
        </div>
    </div>
</form>

@if(session()->has('message') && session()->has('status'))
<div class="row">
    <div class="col-sm-12">
        @if(session('status') == 0)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Perfecto!</strong> {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('status') == 1)
        <div class="alert alert-danger" role="alert">
            {{ session('message') }}
        </div>
        @endif
    </div>
</div>
@endif

@include('admin.payments.paymentsTable')

@push('scripts')
<script>

</script>
@endpush

@endsection
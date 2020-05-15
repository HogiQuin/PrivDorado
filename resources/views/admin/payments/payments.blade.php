@extends('layouts.layout')

@section('content')
<h1>Gestion de pagos</h1>

<div class="row">
    <div class="col-lg-3 col-sm-12">
        <div class="form-group">
            <label for="paymentDate">Fecha:</label>
            <input type="date" class="form-control" id="datePayments" name="date">
        </div>
    </div>
</div>

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
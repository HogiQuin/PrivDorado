@extends('layouts.layout')

@section('content')
<h1>Hola desde casas</h1>

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

@include('admin.houses.housesTable')
@endsection
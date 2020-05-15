@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="col-sm-12">
        @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
        @endif

    </div>
</div>

<div class="row">
    <div class="col-lg-6 offset-lg-3 col-sm-12">
        <div class="card show mb-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    Registrar Pago
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        @if (count($errors) > 0)
                        @foreach($errors->all() as $error)
                        <div class="alert alert-dark" role="alert">
                            {{ $error }}
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <form method="POST" action="{{ url('/payment/create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="payment_type">Tipo de pago:</label>
                                <select name="payment_type" id="payment_type" class="form-control" required>
                                   @foreach( $paymentTypes as $p)
                                        <option value="{{$p->id}}">{{$p->description}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="amount">Monto a pagar:</label>
                                <input type="number" name="amount" id="amount" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="attachment">Comprobante de pago:</label>
                                <input type="file" id="attachment" name="file" class="form-control" accept="image/*,application/pdf">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
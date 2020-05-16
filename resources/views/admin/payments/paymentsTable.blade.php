<div class="row">
    <div class="col-sm-12">
        <div class="card show mb-3">
            <div class="card-header py-3">
            </div>
            <div class="card-body">

                @if(count($payments) > 0)
                <table class="table table-bordered dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fecha</th>
                            <th>Vecino</th>
                            <th>Monto</th>
                            <th>Tipo</th>
                            <th>Estatus</th>
                            <th>File</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $p)
                        <tr>
                            <td>{{ $p['id'] }}</td>
                            <td>{{ $p['date'] }}</td>
                            <td>{{ $p['user'] }}</td>
                            <td>${{ $p['amount'] }}</td>
                            <td>{{ $p['type'] }}</td>
                            <td style="color:{{$p['status_color']}}">{{ $p['status'] }}</td>
                            <td><a href="{{ asset($p['file']) }}" target="_blank">Comprobante pago</a></td>
                            <td>
                                @if($p['status_name'] == 'PA')
                                <form method="post" action="{{ url('/admin/payments/') }}">
                                    @csrf
                                    <input type="hidden" name="payment_id" value="{{ $p['id'] }}">
                                    <button class="btn btn-success btn-sm" type="submit">
                                        Aprovar Pago
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h3 class="text-center">Aun no hay pagos registrados en el sistema!</h3>
                @endif
            </div>
        </div>
    </div>
</div>
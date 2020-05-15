<div class="row">
    <div class="col-sm-12">
        <div class="card show mb-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Mis transacciones:</h6>
            </div>
            <div class="card-body">
                
                @if(count($payments) > 0)
                <table class="table table-bordered dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Tipo</th>
                            <th>Estatus</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $p)
                        <tr>
                            <td>{{ $p['id'] }}</td>
                            <td>{{ $p['created_at'] }}</td>
                            <td>${{ $p['amount'] }}</td>
                            <td>{{ $p['type'] }}</td>
                            <td style="color:{{$p['status_color']}}">{{ $p['status'] }}</td>
                            <td><a href="{{ asset($p['file']) }}">Comprobante pago</a></td>
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
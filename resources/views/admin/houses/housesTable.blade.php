<div class="row">
    <div class="col-sm-12">
        <div class="card show mb-3">
            <div class="card-header py-3">
            </div>
            <div class="card-body">

                @if(count($houses) > 0)
                <table class="table table-bordered dataTable">
                    <thead>
                        <tr>
                            <th>Numero de casa</th>
                            <th>Vecino</th>
                            <th>Balance</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($houses as $h)
                        @if($h['has_user'] == 0)
                        <tr>
                            <td>{{ $h['number'] }}</td>
                            <td>{{ $h['user'] }}</td>
                            <td>{{ $h['balance'] }}</td>
                            <td></td>
                        </tr>
                        @elseif($h['has_user'] == 1)
                        <tr>
                            <form action="{{ url('/admin/houses/') }}" method="post">
                                @csrf
                                <td>{{ $h['number'] }}</td>
                                <td>
                                    <input type="hidden" name="house_id" value="{{ $h['id'] }}">
                                    <select name="user_id" id="user_id">
                                        @foreach($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                 <td>{{ $h['balance'] }}</td>
                                <td>
                                    <button 
                                        class="btn btn-success btn-block"
                                        type="submit" >
                                        Asignar
                                    </button>
                                </td>
                            </form>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                @else
                <h3 class="text-center">Aun no hay casas registradas!</h3>
                @endif
            </div>
        </div>
    </div>
</div>
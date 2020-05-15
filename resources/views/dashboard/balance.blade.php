<div class="row">
    <div class="col-lg-6 col-xs-12">
        <div class="card show mb-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mi saldo:</h6>
            </div>
            <div class="card-body">
                @if($balance >= 0)
                <h1 id="txtBalance" class="text-center text-success">${{money_format('%.2n', $balance)}}</h1>
                @elseif($balance < 0)
                <h1 id="txtBalance" class="text-center text-danger">- ${{money_format('%.2n', $balance * -1)}}</h1>
                @endif
            </div>
        </div>
    </div>
</div>


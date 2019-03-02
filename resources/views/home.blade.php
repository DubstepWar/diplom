@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <button class=" btn btn-success">
                        <a href="/parse">parse</a>
                    </button>
                    <button class=" btn btn-success">
                        <a href="/korresp_chart">KORRESP</a>
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>

<canvas id="myChart"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js" charset="utf-8"></script>
<script src="/public/js/JSchart.js"></script>


@endsection

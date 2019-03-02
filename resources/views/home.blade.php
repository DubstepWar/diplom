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


                    <canvas id="myChart"></canvas>


                </div>
            </div>
        </div>
    </div>
</div>




@endsection

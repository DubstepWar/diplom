@extends('layouts.app')
@section('content')

    {!! $chart->container() !!}
    <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>

    {!! $chart->script() !!}

@endsection
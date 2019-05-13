@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Статистика с сайта korrespondent.net</h2>
                    <p>Нажмите на картинку чтоб посмотреть новости на сайте</p>
                    <a href="https://korrespondent.net/all/ukraine/"><img src="{{asset('images/Корреспондент_лого.JPG')}}"></a>
                </div>


                <div class="panel-body">
                    <p>Получить свежие новости с сайта в базу данных</p>
                        <a class="btn btn-success" href="/parse">Получить</a>
                    <p>Показать график просмотров новостей</p>
                        <a class="btn btn-success" href="/korresp_chart">Показать</a>
                    <p>CENSOR</p>
                        <a class="btn btn-success" href="/censor_chart">Показать</a>

                </div>
            </div>
        </div>
    </div>
</div>





@endsection

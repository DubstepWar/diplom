<?php

namespace App\Http\Controllers;

use App\Article;
use App\Charts\KorrespondentChart;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function korrespChart(){
        $chart = new KorrespondentChart();
        $articles = Article::all();
        $titlesArr = [];
        $viewsArr = [];
        foreach ($articles as $article){
            $titlesArr[] = $article->title;
            $viewsArr[] = $article->views;
        }
        $chart->title('KORRESPONDENT', '14', 'blue', true, 'Arial');
        $chart->labels($titlesArr); //тайтлы
        $chart->dataset('Korrespondent', 'line', $viewsArr)->color('green'); //просмотры
        return view('korrespView',['chart' => $chart]);
    }
}

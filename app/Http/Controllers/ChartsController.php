<?php

namespace App\Http\Controllers;

use App\Article;
use App\Charts\KorrespondentChart;
use Illuminate\Http\Request;
use Yangqi\Htmldom\Htmldom;

class ChartsController extends Controller
{
    public function korrespChart(){
        $this->korrespondent();
        $chart = new KorrespondentChart();
        $articles = Article::all()->sortByDesc('created_at')->where('source','==','koresp')->take(10);
//dd($articles);
        $titlesArr = [];
        $viewsArr = [];
        foreach ($articles as $article){
            $titlesArr[] = $article->title;
            $viewsArr[] = $article->views;
        }
        $chart->labels($titlesArr);
        $chart->dataset('Статистика с сайта Корреспондент', 'line', $viewsArr)->color('red');
        return view('korrespView',['chart' => $chart]);
    }

    private function korrespondent()
    {
        try {
            $korrespondentMainPage = new Htmldom('https://korrespondent.net/all/ukraine/');
        } catch (\Exception $e) {
            return '';
        }
        $divWithNews = $korrespondentMainPage->find('div[class="article article_rubric_top"]');
        $allArticles = Article::all()->keyBy('title')->toArray();
        //dd($divWithNews);//keyBy('title') - ключи ассоц массива - тайтлы
        $created = 0;
        foreach ($divWithNews as $item) {
            try {
                $korrespondentNewsPage = new Htmldom($item->children(0)->href);
            } catch (\Exception $e) {
                return '    ';
            }
            $title = $korrespondentNewsPage->find('.post-item__title')[0]->plaintext;
            $clearViews = $korrespondentNewsPage->find('.post-item__views')[0]->find('span')[0]->plaintext;
            // ЗАНОШУ В БД
            //dd($title);
            if (!isset($allArticles[$title])) { //провер есть ли такой тайтл в бд
                $article = new Article();
                $article->title = $title;
                $article->views = $clearViews;
                $article->source = 'koresp';
                if ($article->save()) {
                    $created++;
                }

            }
        }
    }

    public function censorChart(){
        $this->censor();

        return view('censorView');
    }

    public function censor(){
        $censorNewsPage = new Htmldom('https://censor.net.ua/news/all');
        $allArticles = Article::all()->keyBy('title')->toArray();
        $created = 0;
        $title = $censorNewsPage->find('.item type2')->find('a')->plaintext;
        dd($title);



    }

}

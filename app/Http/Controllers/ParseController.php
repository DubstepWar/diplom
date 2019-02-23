<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Yangqi\Htmldom\Htmldom;

class ParseController extends Controller
{
    public function index()
    {
        $html_1 = new Htmldom('https://www.segodnya.ua/allnews.html');
        $links_1 = $html_1->find('a[class$="b-news"]');

        $hrefs_1 = [];
        foreach ($links_1 as $item) {
            $hrefs_1[] = 'https://www.segodnya.ua' . $item->href;
        }
        $hrefs_2 = [];
        foreach ($hrefs_1 as $href) {
            dd($href);
            $html_2 = new Htmldom($href);
            dd($html_2);
            $links_2 = $html_2->find('id="article_views_cont"');
            dd($links_2);
            $hrefs_2[] = $links_2;

        }
        dd($hrefs_2);
    }


    public function gazetaUa()
    {
        $gazeta = new Htmldom('https://gazeta.ua');
        //тяну заголовки статей
        $titles = $gazeta->find('a[class="block fs18 black mb10"]');
        $titlesArr = [];
        foreach ($titles as $item) {
            $titlesArr[] = $item->plaintext;
        }
dd($titlesArr);

        //тяну просмотры
        $viewsArr = [];
        $views = $gazeta->find('section[class="pull-right gray"]');
        foreach ($views as $item) {
            $stringWithViews = $item->plaintext;
            $clearViews = filter_var($stringWithViews, FILTER_SANITIZE_NUMBER_INT);
            $viewsArr[] = $clearViews;
        }
        $viewsTitlesArr = array_combine($viewsArr, $titlesArr);
        dd($viewsTitlesArr);

        foreach ($viewsTitlesArr as $view => $title) {
            $article = new Article();
            $allArticles = $article->all();
//            dd(Article::where('title',$title)->isNotEmty());
           /* if (Article::where('title','!==',$title)->exists()){
                $article->title = $title;
                $article->views = $view;
                $article->save();
            }
            */
            if ($allArticles->isEmpty()) {
                $article->title = $title;
                $article->views = $view;
                $article->save();
            } else {
                foreach ($allArticles as $arrWithArticleData) {
//                    dd($arrWithArticleData->title, $title);
                    if (strcmp($arrWithArticleData->title, $title) == 1){
//                       dd($arrWithArticleData->title !== $title);
                        $article->title = $title;
                        $article->views = $view;
                        $article->save();
                    }
                }

            }
        }

//        foreach ($viewsTitlesArr as $key=>$val){
//            $article = new Article();
//            $article->title = $val;
//            $article->views = $key;
//            $article->save();
//        }

        dd($viewsArr, $titlesArr);
    }

    public function MyKorrespondent(){
        $korrespondentMainPage = new Htmldom('https://korrespondent.net/all/ukraine/');
        $divWithNews = $korrespondentMainPage->find('div[class="article article_rubric_top"]');
        $hrefsToArticlesArr = []; //тут лежат ссылки на статьи с главной страницы новостей
        foreach ($divWithNews as $item) {
            $hrefsToArticlesArr[] = $item->children(0)->href;
        }
        $titlesArr = [];
        $viewsArr = [];
        foreach ($hrefsToArticlesArr as $href){
            $korrespondentNewsPage = new Htmldom($href);
            $divWithViewsAndTitles = $korrespondentNewsPage->find('div[class="post-item clearfix"]'); //див с просмотрами
            foreach ($divWithViewsAndTitles as $div){
                // ПРОСМОТРЫ
                $stringWithViews = $div->children(2)->children(0)
                ->children(1)->children(1)->plaintext; //тяну просмотры
                $clearViews = filter_var($stringWithViews, FILTER_SANITIZE_NUMBER_INT); //стринг ту инт
                $viewsArr[] = $clearViews; //массив с просмотрами
                // ТАЙТЛЫ
                $titles = $div->children(0)->plaintext;
                $titlesArr[] = $titles;
                // ЗАНОШУ В БД
                $article = new Article();
                $allArticles = $article->all();
                if ($allArticles->isEmpty()) {
                    $article->title = $titles;
                    $article->views = $clearViews;
                    $article->save();
                    //dd('ВФТ ВООБЩЕ');
                } else {
                    foreach ($allArticles as $arrWithArticleData) {
//                    dd($arrWithArticleData->title, $title);
                        if ($arrWithArticleData->title !== $titles){
//                       dd($arrWithArticleData->title !== $title);
                            $article->title = $titles;
                            $article->views = $clearViews;
                            $article->save();
                        }else{
                            echo '-Hello-';
                        }
                    }

                }
            }
        }
          dd($viewsArr, $titlesArr);
    }

    public function korrespondent()
    {
        try {
            $korrespondentMainPage = new Htmldom('https://korrespondent.net/all/ukraine/');
        } catch (\Exception $e) {
            return '';
        }
        $divWithNews = $korrespondentMainPage->find('div[class="article article_rubric_top"]');
        $allArticles = Article::all()->keyBy('title')->toArray(); //keyBy('title') - ключи ассоц массива - тайтлы
        dd($allArticles);
        $created = 0;
        foreach ($divWithNews as $item) {
            try {
                $korrespondentNewsPage = new Htmldom($item->children(0)->href);
            } catch (\Exception $e) {
                return '    ';
            }
            $divWithViewsAndTitles = $korrespondentNewsPage->find('div[class="post-item clearfix"]'); //див с просмотрами
            foreach ($divWithViewsAndTitles as $div) {
                // ПРОСМОТРЫ
                $stringWithViews = $div->children(2)->children(0)
                    ->children(1)->children(1)->plaintext; //тяну просмотры
                $clearViews = filter_var($stringWithViews, FILTER_SANITIZE_NUMBER_INT); //стринг ту инт
                // ТАЙТЛЫ
                $title = $div->children(0)->plaintext;
                // ЗАНОШУ В БД
                if (!isset($allArticles[$title])) { //провер есть ли такой тайтл в бд
                    $article = new Article();
                    $article->title = $title;
                    $article->views = $clearViews;
                    if ($article->save()) {
                        $created++;
                    }
                }
            }
        }
        echo "Создано $created записей";
    }

}

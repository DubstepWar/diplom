<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Yangqi\Htmldom\Htmldom;

class ParseController extends Controller
{
    public function index(){
      $html_1 = new Htmldom('https://www.segodnya.ua/allnews.html');
    $links_1 =  $html_1->find('a[class$="b-news"]');

     $hrefs_1 = [];
        foreach ($links_1 as $item) {
            $hrefs_1[]='https://www.segodnya.ua'.$item->href;
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


    public function gazetaUa(){
        $gazeta = new Htmldom('https://gazeta.ua');
        //тяну заголовки статей
        $titles = $gazeta->find('a[class="block fs18 black mb10"]');
        $titlesArr = [];
        foreach ($titles as $item){
            $titlesArr[] = $item->plaintext;
        }


        //тяну просмотры
        $viewsArr = [];
        $views = $gazeta->find('section[class="pull-right gray"]');
        foreach ($views as $item){
            $stringWithViews = $item->plaintext;
            $clearViews = filter_var($stringWithViews, FILTER_SANITIZE_NUMBER_INT);
            $viewsArr[] = $clearViews;
        }
        $viewsTitlesArr = array_combine($viewsArr,$titlesArr);

        foreach ($viewsTitlesArr as $view => $title){
            $article = new Article();
            $allArticles = $article->all();
//            dd($allArticles->title);
            foreach ($allArticles as $arrWithArticleData){
                if ($arrWithArticleData->title != $title){
                    $article->title = $title;
                    $article->views = $view;
                    $article->save();
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


}

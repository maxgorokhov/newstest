<?php


namespace App\controllers;
use \App\services\PaginationBuilder;

class NewsController
{
    private $model;

    public function __construct($model) {
        $this->model = $model;

    }

    // Отдельная страница с новостью

    public function showNews($id) {
        $newsItem = $this->model->getNewsId($id);

        if (count($newsItem) == 0) {
            $this->showNotFound();
            return;
        }

        if (isset($_GET['from-page'])) {
            $page = (int)$_GET['from-page'];
            $fromPage = $page > 0  ? $page : 1;
        } else {
            $fromPage = 1;
        }

        $data = [
            'newsItem' => $newsItem,
            'fromPage' => $fromPage,
        ];

        require APP_PATH . './src/views/show.php';
    }


    // Вывдод главной страницы со списком новостей
    public function showPaginationNews(int $page = 1)
    {
        $limit = 4;
        $totalNews = $this->model->getAllCountNews();
        $totalPage = ceil($totalNews / $limit);

        if (($page < 1 || $page > $totalPage) && $totalNews > 0) {
            $this->showNotFound();
            return;
        }

        $newsList = $this->model->getNewsList($page, $limit);

        $lastNews = $this->model->getLastNews();

        $pagination = PaginationBuilder::build($page,$totalPage, URL_ADR );

         $data = [
             'totalNews' => $totalNews,
             'totalPage' => $totalPage,
             'newsList' => $newsList,
             'lastNews' => $lastNews,
             'page' => $page,
             'pagination' => $pagination,
         ];

        require APP_PATH . './src/views/news.php';
    }

    //Не существующая страница
    public function showNotFound()
    {
        require APP_PATH . './src/views/notfound.php';
    }


}
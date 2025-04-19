<?php
require_once('../vendor/autoload.php');

define('APP_PATH', __DIR__ . '/../');
define('URL_ADR', (isset($_SERVER['HTTPS']) ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].'/');

use \App\models\NewsModel;
use \App\controllers\NewsController;


//подключаемся к БД
$config = require APP_PATH . '/config/database.php';

try {
    $pdo = new PDO("mysql:host={$config['host']};dbname={$config['dbname']};port={$config['port']};", $config['username'], $config['password']);
} catch (PDOException $exception) {
    echo "Error: $exception";
}


$db = new NewsModel($pdo);
$controller = new NewsController($db);

//Маршрутизация

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),'/');
$segments = explode('/', $uri);

if (empty($segments[0])) {
    header('Location: /news');
    exit;
}


if ($segments[0] == 'news') {
    if(isset($segments[1])) {

        //Обработка если news/show/{id}
        if ($segments[1] == 'show' && isset($segments[2])) {
            // Проверка если  {id} не целое положительное число
            if (!ctype_digit($segments[2])) {
                $controller->showNotFound();
                exit;
            }
            $id = (int)$segments[2];
            $controller->showNews($id);
        }

        //Обработка если news/{id}
        elseif (ctype_digit($segments[1])) {
            // Если  news/{id} id = целое положительное число
            if ((int) $segments[1] > 0) {
                $page = (int) $segments[1];
                $controller->showPaginationNews($page);
            } else {
                $controller->showNotFound();
                exit;
            }
        }

        //Обработка если news/sometings - что то неизвестное
        else {
            $controller->showNotFound();
            exit;
        }
    } else {
        $controller->showPaginationNews(1);
    }
} else {
    $controller->showNotFound();
    exit;
}



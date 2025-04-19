<?php
    /** @var array $data */
    $totalNews = $data['totalNews'];
    $totalPage = $data['totalPage'];
    $newsList  = $data['newsList'];
    $lastNews  = $data['lastNews'];
    $page = $data['page'];
    $pagination = $data['pagination'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/news.css">
</head>
<body>
    <div class="page">
        <h1 class="visual-hidden">Галактический вестник, новости</h1>
        <?php require APP_PATH . './src/views/layouts/header.php'?>
        <main class="main">
           <section class="last-news" style="background-image:url('/assets/images/<?php echo $lastNews['image']?>')" onclick="location.href='<?php echo URL_ADR.'news/show/'.$lastNews['id'].'?from-page='.$page?>' ">
               <div class="last-news__container">
                   <h2 class="last-news__title"><?php echo $lastNews['title'];?></h2>
                   <?php echo $lastNews['announce'];?>
               </div>
           </section>
           <section class="news">
               <h2 class="news__title">Новости</h2>
               <div class="news__container">
                   <?php foreach ($newsList as $item): ?>
                        <article class="news__article" onclick="location.href='<?php echo URL_ADR.'news/show/'.$item['id'].'?from-page='.$page?>'">
                            <time class="news__time" datetime="<?php echo $item['date'];?>">
                                <?php
                                    $date = new DateTime($item['date']);
                                    $formatted_date = $date->format("d.m.Y");
                                    echo $formatted_date;
                                ?>
                            </time>
                            <h3 class="news__name"><?php echo $item['title'];?></h3>
                            <div class="news__announce"><?php echo $item['announce'];?></div>
                            <a href="<?php echo URL_ADR.'news/show/'.$item['id'].'?from-page='.$page;?>" class="news__link">Подробнее
                                <svg class="news__link-arrow" xmlns="http://www.w3.org/2000/svg" width="26" height="13.32" >
                                    <path  fill-rule="evenodd" d="m22.58 5.66-3.95-3.95a.99.99 0 0 1 0-1.42 1 1 0 0 1 1.42 0l5.65 5.66c.4.39.4 1.02 0 1.41l-5.65 5.66c-.4.4-1.02.4-1.42 0a.98.98 0 0 1 0-1.41l3.95-3.95H0v-2h22.58Z"/>
                                </svg>
                            </a>
                        </article>
                   <?php endforeach; ?>
               </div>
               <div class="pagination">
                   <?php echo $pagination; ?>
               </div>
           </section>
        </main>
        <?php require  APP_PATH . './src/views/layouts/footer.php'?>
    </div>
</body>
</html>


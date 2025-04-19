<?php
   /** @var array $data */
   $newsItem = $data['newsItem'];
   $fromPage = $data['fromPage'];
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
    <link rel="stylesheet" href="/assets/css/show.css">
</head>
<body>
<div class="page">
    <h1 class="visual-hidden">Галактический вестник, новости</h1>
    <?php require APP_PATH . './src/views/layouts/header.php'?>
    <main class="main">
        <section class="new">
            <div class="new__nav">
                <a href="<?php echo URL_ADR.'news'; ?>" class="new__link">Главная</a>
                <span>/</span>
                <p class="new__nav-name"><?php echo $newsItem['title'];?></p>
            </div>
            <h2 class="new__title"><?php echo $newsItem['title'];?></h2>
            <div class="new__container">
                <div class="new__content">
                    <time class="new__time" datetime="<?php echo $newsItem['date'];?>">
                        <?php
                        $date = new DateTime($newsItem['date']);
                        $formatted_date = $date->format("d.m.Y");
                        echo $formatted_date;
                        ?>
                    </time>
                    <h3 class="new__announce"><?php echo strip_tags($newsItem['announce']); ?></h3>
                    <div class="new__text">
                        <?php echo $newsItem['content']; ?>
                    </div>
                    <a href="<?php echo URL_ADR.'news/'.$fromPage;?>" class="new__back-link">
                        <svg class="new__back-link-arrow" xmlns="http://www.w3.org/2000/svg" width="26" height="13.32" >
                            <path  fill-rule="evenodd" d="m3.41 5.66 3.95-3.95c.4-.4.4-1.02 0-1.42a1 1 0 0 0-1.41 0L.29 5.95a1 1 0 0 0 0 1.41l5.66 5.66c.39.4 1.02.4 1.41 0 .4-.4.4-1.02 0-1.41L3.41 7.66H26v-2H3.41Z"/>
                        </svg>
                        назад к новостям
                    </a>
                </div>
                <picture class="new__picture">
                    <img src="/assets/images/<?php echo $newsItem['image'];?>" alt="<?php echo $newsItem['title'];?>" class="new__img">
                </picture>
            </div>
        </section>
    </main>
    <?php require  APP_PATH . './src/views/layouts/footer.php'?>
</div>
</body>
</html>



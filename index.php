<?php require 'functions.php'; ?>
<html>
<head>
<title>AJ Blog</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">

        <div class="welcome">
            <h1>AJ Blog</h1>
            <p>Welkom op het test blog</p>
        </div>

        <div class="news-box">

            <div class="news">
              <?php
              // get the database handler
              $dbh = connect_to_db();
              // Fetch news
              $news = fetchNews($dbh);
              ?>

              <?php if ( $news && !empty($news) ) :?>

              <?php foreach ($news as $key => $article) :?>
                  <h2><a href="read-news.php?newsid=<?= $article->news_id ?>"><?= stripslashes($article->news_title) ?></a></h2>
                  <p><?= stripslashes($article->news_short_description) ?></p>
                  <span>gepubliceerd op <?= date("M, jS  Y, H:i", $article->news_published_on) ?> by <?= stripslashes($article->news_author) ?></span>
              <?php endforeach?>

              <?php endif?>
            </div>


            </div>

        </div>
    </div>
</body>
</html>
<?php require 'functions.php'; ?>
<html>
<head>
  <meta charset="utf-8">
  <title>AJ's Blog</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <div class="container">

    <div class="welcome">
      <h1>AJ Blog</h1>
        <p>Welcome my blog project</p>
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
          <h2><a href="readnews.php?news_id=<?= $article->news_id ?>"><?= stripslashes($article->news_title) ?></a></h2>
          <p><?= stripslashes($article->news_desc) ?></p>
          <div id="betweenline"> </div>
          <!--<span>gepubliceerd op </?= date("M, jS  Y, H:i", $article->news_published_on) ?> by </?= stripslashes($article->news_author) ?></span>-->
        <?php endforeach?>

        <?php endif?>
        </div>

    </div>

  </div>

</body>
</html>

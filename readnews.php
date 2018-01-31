<?php require 'functions.php'; ?>
<html>
<head>
  <meta charset="utf-8">
  <title>AJ Blog</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <div class="container">

    <div class="welcome">
      <h1>AJ Blog</h1>
      <a href="index.php">Back to home page</a>
      </div>

    <div class="news-box">

        <div class="news">
            <?php
                // get the database handler
                $dbh = connect_to_db();
                $id_article;
                if(isset($_GET['news_id'])){
                $id_article = (int)$_GET['news_id'];
              }
                $other_articles;
                if ( !empty($id_article) && $id_article > 0) {
                    // Fetch news
                    $article = getAnArticle( $id_article, $dbh );
                    $article = $article[0];
                    $other_articles = getOtherArticles( $id_article, $dbh );

                }else{
                    $article = false;
                    echo "<strong>Verkeerd Artikel!</strong>";
                }


                ?>

            <?php if (!empty($article) && $article) :?>

            <h2><?= stripslashes($article->news_title) ?></h2>
            <!--<span>gepubliceerd op </?= date("M, jS  Y, H:i", $article->news_published_on) ?> by </?= stripslashes($article->news_author) ?></span>-->
            <div>
                <?= stripslashes($article->news_content) ?>
            </div>
            <?php else:?>

            <?php endif?>
        </div>

        <hr>
        <br>
        <br>
        <br>
        <br>
        <h3>Other articles</h3>
        <div class="similar-posts">
        <?php if ( !empty($other_articles) && $other_articles ) :
                $i = 0;
                foreach ($other_articles as $key => $article) :?>
          <h2><a href="readnews.php?news_id=<?= $article->news_id ?>"><?= stripslashes($article->news_title) ?></a></h2>
          <p><?= stripslashes($article->news_desc) ?></p>
          <div id="betweenline"> </div>
          <?php
                  if (++$i == 4) break;
                endforeach?>

        <?php endif?>
        </div>

      </div>

    </div>
</body>
</html>

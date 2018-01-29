<?php require 'functions.php'; ?>
<html>
<head>
    <title>AJ Blog</title>
    <link rel="stylesheet" type="text/css" href="design/style.css">
</head>
<body>
    <div class="container">

        <div class="welcome">
            <h1>AJ Blog</h1>
            <p>Welkom op het test blog</p>
            <a href="index.php">terug naar home page</a>
        </div>

        <div class="news-box">

            <div class="news">
                <?php
                    // get the database handler
                    $dbh = connect_to_db();

                    $id_article = (int)$_GET['newsid'];

                    if ( !empty($id_article) && $id_article > 0) {
                        // Fecth news
                        $article = getAnArticle( $id_article, $dbh );
                        $article = $article[0];
                    }else{
                        $article = false;
                        echo "<strong>Wrong article!</strong>";
                    }

                    $other_articles = getOtherArticles( $id_article, $dbh );

                ?>

                <?php if ( $article && !empty($article) ) :?>

                <h2><?= stripslashes($article->news_title) ?></h2>
                <span>gepubliceerd op <?= date("M, jS  Y, H:i", $article->news_published_on) ?> by <?= stripslashes($article->news_author) ?></span>
                <div>
                    <?= stripslashes($article->news_full_content) ?>
                </div>
            <?php else:?>

                <?php endif?>
            </div>

            <hr>
            <h1>andere artikelen</h1>
            <div class="similar-posts">
                <?php if ( $other_articles && !empty($other_articles) ) :?>

                <?php foreach ($other_articles as $key => $article) :?>
                <h2><a href="read-news.php?newsid=<?= $article->news_id ?>"><?= stripslashes($article->news_title) ?></a></h2>
                <p><?= stripslashes($article->news_short_description) ?></p>
                <span>gepubliceerd op <?= date("M, jS  Y, H:i", $article->news_published_on) ?> by <?= stripslashes($article->news_author) ?></span>
                <?php endforeach?>

                <?php endif?>

            </div>

        </div>

    </div>
</body>
</html>

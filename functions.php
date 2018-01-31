<?php
    require 'dbconnect.php';

    function fetchNews( $conn )
    {

        $request = $conn->prepare(" SELECT news_id, news_title, news_desc, news_author
          FROM blogarticles
          ORDER BY news_id DESC ");
        return $request->execute() ? $request->fetchAll() : false;
    }


    function getAnArticle( $id_article, $conn )
    {

        $request =  $conn->prepare(" SELECT news_id,  news_title, news_content, news_author
          FROM blogarticles WHERE news_id = ? ");
        return $request->execute(array($id_article)) ? $request->fetchAll() : false;
    }


    function getOtherArticles( $differ_id, $conn )
    {
        $request =  $conn->prepare(" SELECT news_id,  news_title, news_desc, news_content, news_author
          FROM blogarticles  WHERE news_id != ? ORDER BY news_id DESC ");
        return $request->execute(array($differ_id)) ? $request->fetchAll() : false;
    }

?>

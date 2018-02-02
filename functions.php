<?php
require 'dbconnect.php';

function fetchNews( $conn )
{
  $request = $conn->prepare(" SELECT postid, title, description, postdate, category_id
    FROM blogarticles
    ORDER BY postid DESC ");
  return $request->execute() ? $request->fetchAll() : false;
}


function getAnArticle( $id_article, $conn )
{
  $request =  $conn->prepare(" SELECT postid, title, content, postdate, category_id
    FROM blogarticles WHERE postid = ? ");
  return $request->execute(array($id_article)) ? $request->fetchAll() : false;
}

function getOtherArticles( $differ_id, $conn )
{
  $request =  $conn->prepare(" SELECT postid, title, description, content, postdate, category_id
    FROM blogarticles  WHERE postid != ? ORDER BY postid DESC ");
  return $request->execute(array($differ_id)) ? $request->fetchAll() : false;
}


function getCategories( $id_category, $conn )
{
  $request =  $conn->prepare(" SELECT postid, title, description, content, postdate, category_id
    FROM blogarticles WHERE category_id = ? ORDER BY postid DESC");
  return $request->execute(array($id_category)) ? $request->fetchAll() : false;
}

?>

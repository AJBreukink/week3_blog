<?php
require 'functions.php';
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Add Post</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <!--
  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });

  </script>
-->
</head>
<body>

<div id="container">

  <div class="welcome">
    <h1>AJ Blog</h1>
      <p>Blogpost toevoegen</p>
  </div>

    <?php

    //if form has been submitted process it
    if(isset($_POST['submit'])){

        $_POST = array_map( 'stripslashes', $_POST );

        //collect form data
        extract($_POST);

        //very basic validation
        if($postTitle ==''){
            $error[] = 'Please enter the title.';
        }

        if($postDesc ==''){
            $error[] = 'Please enter the description.';
        }

        if($postCont ==''){
            $error[] = 'Please enter the content.';
        }

        if(!isset($error)){

            try {

                //insert into database
                $pdo = connect_to_db();
                $sendPost = "INSERT INTO blogarticles(news_title, news_desc, news_content) " .
                            "VALUES ('$postTitle', '$postDesc', '$postCont')";
                $pdo->exec($sendPost);
                /*
                //redirect to index page
                header('Location: index.php?action=added');
                exit;
                */
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }

    }

    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo '<p class="error">'.$error.'</p>';
        }
    }
    ?>
    <div class="news-box">
      <form action='' method='post'>

        <p><label>Title</label><br />
        <input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

        <p><label>Description</label><br />
        <textarea name='postDesc' cols='100' rows='3'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

        <p><label>Content</label><br />
        <textarea name='postCont' cols='100' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

        <p><input type='submit' name='submit' value='Post'></p>

      </form>
    </div>
  </div>

</body>
</html>
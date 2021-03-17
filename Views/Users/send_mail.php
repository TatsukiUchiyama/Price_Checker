<?php
  $before_page = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : NULL;

  if(!strpos($before_page,'reset_password.php')){
    header('Location: /Items/index.php');
    exit();
  }
  ?>

<!DOCTYPE html>
<html lang="ja">
 <head>
  <meta charset="utf-8">
  <title>Price checker</title>
  <link rel="stylesheet" type="text/css" href="/css/reset.css">
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/User/reset_password.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">

 </head>
 <body>
  <header>
    <h1 class="app_logo"><a href="/Items/index.php"> Price Checker</a></h1>
  </header>
  <main>
    <div class="container">
      <p class="Explanatory_text">メールを送信しました。<br>
      メールの内容に沿って再設定をお願いします。</p>

      <a href="reset_password.php" class="link_text">もう一度入力する</a>

      
  
    </div>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>
 </body>
</html>

<?php
  session_start();
  if(empty($_SESSION['email'])){
    header('location: /Items/index.php');
  }else{
    $_SESSION['email'] = null;
  }

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/reset.css">
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/User/reset_password.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
  <title>Price Checker</title>
</head>
<body>
  <header>
    <h1 class="app_logo"><a href="/Items/index.php">Price Checker</a></h1>
  </header>
  <main>
    <div class="container">
      <p class="Explanatory_text">
        パスワードの変更が完了しました。
      </p>
      <a href="log_in.php" class="link_text">ログインページに戻る</a>
    </div>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>
</body>
</html>


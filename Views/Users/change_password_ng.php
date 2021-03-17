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
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js?ver=3.4.1"></script>
  <script type="text/javascript" src="/js/validation.js"></script>
  <title>パスワードの変更</title>
</head>
<body>
  <header>
    <h1 class="app_logo"><a href="/Items/index.php">Price Checker</a></h1>
  </header>
  <main>
    <div class="container">
      <p class="Explanatory_text">
        URLの有効期限が切れています。<br>
        再度URLを発行してパスワードの再設定を行ってください。
      </p>
      <a href="reset_password.php" class="link_text">戻る</a>
    </div>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>
</body>
</html>


<?php 
  session_start();
  if(empty($_SESSION['log_in'])){ 
      // ログイン前の表示      
  header('location: /Items/index.php');
  }
  $name  = $_SESSION['log_in']['name'];
  $email = $_SESSION['log_in']['email'];
  $user_id = $_SESSION['log_in']['id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/reset.css">
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/User/show.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="/js/my_page.js"></script>
  <script type="text/javascript">
    let user_id = <?= json_encode($user_id); ?>;
  </script>
  <title>Price Checker マイページ</title>
</head>
<body>


  <header>
    <h1 class="app_logo"><a href="/Items/index.php"> Price Checker</a></h1>
  </header>
  <main>
    <section class="spending">
    </section>

    <section class="my_profile">
      <div class="value"><?= $name ?></div>
      <div class="value"><?= $email ?></div>

      <a href="edit.php" class="btn btn--orange">編集</a>
      
    </section>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>


</body>
</html>
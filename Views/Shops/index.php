<?php
  require_once(ROOT_PATH .'Controllers/ShopController.php');

  session_start(); 
  $user_id = $_SESSION['log_in']['id'];
  if(empty($user_id)){
    header('Location: /Items/index.php');
  }
  $shop = new ShopController;
  $result = $shop->shop_all($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/reset.css">
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/Shop/index.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
  <title>Price Checker</title>
</head>
<body>
  
  <header>
    <h1 class="app_logo"><a href="/Items/index.php"> Price Checker</a></h1>
    <div class="create_shop"><a href="new.php">店舗登録</a></div>
  </header>
  <main>
    <div class="container">




      <?php if(!empty($result)){ ?>
        <?php foreach($result as $shop): ?>
          <div class="shop">
            <div class="name"><?= $shop['name']." ".$shop['branch_name'] ?></div>
            <button><a class="btn btn--orange" href="show.php?id=<?= $shop['id'] ?>">詳細</a></button>
          </div>
        <?php endforeach; ?>
      <?php }else{ ?>
        <p class="no_shop">店舗が一つも登録されていません。</p>
      <?php } ?>
          
    </div>

  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>

</body>
</html>

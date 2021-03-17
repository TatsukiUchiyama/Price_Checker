<?php 
  require_once(ROOT_PATH .'Controllers/ShopController.php');

  session_start();

  if(empty($_SESSION['log_in'])){ 
    // ログイン前の表示      
    header('location: /Items/index.php');
  }
 
  $shop = new ShopController;
  $result = $shop->shop_select(); 

  $user_id = $_SESSION['log_in']['id'];
  $shop_user_id = $result['user_id'];
 
  if($user_id != $shop_user_id || empty($result)){
    // 他人の店の場合
    header("Location: /Items/index.php");
  }
  function h($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    // 特殊文字を変換する
  }

  $id = $_GET['id'];
  $name = $result['name'];
  $branch_name = $result['branch_name'];
  $prefecture = $shop->prefecture($result['prefecture_id']);
  $city = $result['city'];
  $block_number = $result['block_number'];
  $collapse = $result['collapse'];
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/reset.css">
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/Shop/show.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
  <title>Price Checker 店舗詳細ページ</title>
</head>
<body>


  <header>
    <h1 class="app_logo"><a href="/Items/index.php"> Price Checker</a></h1>
  </header>
  <main>
    <section class="container">

        <div class="value"><?= h($name)." ".h($branch_name); ?></div>

        <div class="value"><?= h($prefecture)." ".h($city)." ".h($block_number); ?></div>

      <?php if($collapse == 1){  ?>
        <div class="value">営業中</div>
      <?php }elseif($collapse == 2){ ?>
        <div class="value">閉店</div>
      <?php } ?>

      <button><a class="btn btn--orange" href="edit.php?id=<?= $id ?>">編集</a></button>

    </section>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>

</body>
</html>
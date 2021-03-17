<?php
  require_once(ROOT_PATH .'Controllers/ItemController.php');
  require_once(ROOT_PATH .'Controllers/ShopController.php');

  session_start(); 
  $SHOP = new ShopController;
  $ITEM = new ItemController;
  $name = "";
  $user_id = "";

  if(!empty($_SESSION['log_in'])){
    $name = $_SESSION['log_in']['name'];
    $user_id = $_SESSION['log_in']['id'];
    $shops = $SHOP->shop_all($user_id);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/reset.css">
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/Item/index.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="/js/check.js"></script>
  <script type="text/javascript" src="/js/search.js"></script>
  <script type="text/javascript" src="/js/pulldown.js"></script>
  <script type="text/javascript">
    let username = <?= json_encode($name); ?>;
    let user_id = <?= json_encode($user_id); ?>;
  </script>

  <title>Price Checker</title>
</head>
<body>

    <header>
      <h1 class="app_logo"><a href="/Items/index.php"> Price Checker</a></h1>
      <?php if(empty($_SESSION['log_in'])){ ?>  
        <!-- ログイン前の表示 -->
        <p class="log_in"><a href="/Users/log_in.php">ログイン</a></p>
        
      <?php }elseif(!empty($_SESSION['log_in'])){ ?>
        <!-- ログイン後の表示 -->

        <?php if(!empty($shops)) { ?>
          <p id="pulldown" class="user_name"><?= $name ?>さん</p>
        <?php }else{ ?>
          <p id="pulldown_noShop" class="user_name"><?= $name ?>さん</p>
        <?php  } ?>
        <?php } ?>
    </header>

  <main>
    <section class="search">
      <div class="input_content">
        <p class="label_text">商品名</p>
        <input type="search" id="search_name" class="text_box">
      </div>
      <div class="input_content">
        <p class="label_text">住所</p>
        <input type="search" id="search_address" class="text_box">
      </div>

      <p class="label_text">安い順</p>
      <input id="search_asc" type="checkbox" class="check_box">
      <p class="label_text">閉店中を表示</p>
      <input id="search_close" type="checkbox" class="check_box">
      <?php if(!empty($_SESSION['log_in'])){ ?>  
      <p class="label_text">My Item</p>
      <input id="search_MyItem" type="checkbox" class="check_box" checked>
      <?php } ?>
    </section>
    <section class="item_index">
      <div class="item_lists">

      </div>
    </section>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>

</body>
</html>




<?php 
  require_once(ROOT_PATH .'Controllers/ItemController.php');
  require_once(ROOT_PATH .'Controllers/ShopController.php');

  session_start();


  function h($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    // 特殊文字を変換する
  }
  $SHOP = new ShopController;
  

  $ITEM = new ItemController;
  $result = $ITEM->select_item();
 
  if(empty($result)){
    header('location: /Items/index.php');
  }
  
  $id = $_GET['id'];
  $name = $result['name'];
  $kana = $result['kana'];
  $item_name = $result['item_name'];
  $price = $result['price'];
  $comment = $result['comment'];
  $shop_id = $result['shop_id'];
  $result_shop = $SHOP->get_shop_name($shop_id);
  $shop_name = $result_shop['name'];
  $date = $result['purchase_date'];
  $theDate = new DateTime($date);
  $purchase_date = $theDate->format('Y年m月d日');
  $item_user_id = $result['user_id'];
  if(!empty($_SESSION['log_in'])){
    $logIn_user_id = $_SESSION['log_in']['id'];
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/reset.css">
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/Item/show.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
  <title>Price Checker 商品詳細ページ</title>
</head>
<body>

  <header>
    <h1 class="app_logo"><a href="/Items/index.php">Price Checker</a></h1>
  </header>
  <main>
    <section class="container">

        <div class="content">
          <div class="index">購入店舗</div>
          <div class="value"><?= h($shop_name); ?></div>
        </div>

        <div class="content">
          <div class="index">品目</div>
          <div class="value"><?= h($name); ?></div>
        </div>

        <div class="content">
          <div class="index">商品名</div>
          <div class="value"><?= h($item_name); ?></div>
        </div>

        <div class="content">
          <div class="index">金額</div>
          <div class="value"><?= h($price); ?>円</div>
        </div>

        <div class="content">
          <div class="index">コメント</div>
          <div class="value text_area"><?= nl2br(h($comment)); ?></div>
        </div>

        <div class="content">
          <div class="index">購入日</div>
          <div class="value"><?= $purchase_date; ?></div>
        </div>


    <?php if(!empty($_SESSION['log_in'])){ ?>
      <?php if($item_user_id == $logIn_user_id){ ?>
        <div class="mt"><a class="btn--orange btn" href="edit.php?id=<?= $id ?>">編集</a></div>
      <?php } ?>
    <?php } ?>

    </section>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>

</body>
</html>


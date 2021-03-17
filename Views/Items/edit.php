<?php
  require_once(ROOT_PATH.'Controllers/ItemController.php');
  require_once(ROOT_PATH.'Controllers/ShopController.php');

  function h($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    // 特殊文字を変換する
  }
  session_start();
  $ITEM = new ItemController;
  $id = $_GET['id'];
  $result = $ITEM->select_item();
  $item_user_id = $result['user_id'];
  $user_id = $_SESSION['log_in']['id'];

  if($user_id != $item_user_id || empty($result)){
    header("Location: /Items/index.php");
  }





  $SHOP = new ShopController;
  $shops = $SHOP->shop_all($user_id);

  $id = $_GET['id'];
  $name = $result['name'];
  $kana = $result['kana'];
  $item_name = $result['item_name'];
  $price = $result['price'];
  $comment = $result['comment'];
  $shop_id = $result['shop_id'];
  $result_shop = $SHOP->shop_select();
  $date = $result['purchase_date'];
  $theDate = new DateTime($date);
  $purchase_date = $theDate->format('Y年m月d日');
  $view_date = $theDate->format('Y-m-d');


  if(!empty($_POST)){

    // //POSTのValidate。
    if(empty($_POST['shop_id'])){
      $err['shop'] = '店名は必須項目です。';
    }
    if(empty($_POST['date'])){
      $err['date'] = '購入日は必須項目です。';
    }

    if(empty($_POST['name'])){
      $err['name'] = '品名は必須項目です。';
    }elseif(mb_strlen($_POST['name']) > 20){
      $err['name'] = '品名は20文字以内です。';
    }
    if(empty($_POST['kana'])){
      $err['kana']= '品名(カナ)は必須項目です。';
    }elseif(mb_strlen($_POST['kana']) > 50){
      $err['kana'] = '品名(カナ)は50文字以内です。';
    }


    if(empty($_POST['price'])){
      $err['price'] = '値段は必須項目です。';
    }elseif(!preg_match('/^[0-9]+$/', $_POST['price'])){
      $err['price'] = '半角数字で入力してください。';
    }
    

    if(empty($err)){

      $result = $ITEM->edit_item();
      $url = "/Items/show.php?id=".$id;
      header("Location: ".$url);
      exit();
    }

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/reset.css">
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/Item/edit.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js?ver=3.4.1"></script>
  <script type="text/javascript" src="/js/validation.js"></script>
  <script type="text/javascript" src="/js/jquery.autoKana.js"></script>
  <script type="text/javascript">
  $(document).ready(
      function() {
      $.fn.autoKana('input[name="name"]', 'input[name="kana"]', {
          katakana : true
          });
      });
  </script>
  <title>商品情報編集ページ</title>
</head>
<body>
  <header>
    <h1 class="app_logo"><a href="/Items/index.php">Price Checker</a></h1>
  </header>
  <main>
    <div class="container">
      <form id="item_edit" action="edit.php?id=<?= $id ?>" method="post">

        <input type="hidden" name="id" value="<?= $id ?>">
        
      <div class="input_content">
        <p class="label_text">店舗</p>
        <select  id="shop" class="select_box" name="shop_id">
          <?php foreach($shops as $shop): ?>
            <option value="<?= $shop['id']; ?>" <?php if($shop['id'] == $shop_id){ echo "selected"; } ?>><?= $shop['name']." ".$shop['branch_name']; ?></option>
          <?php endforeach ?>
        </select>
        <p class="err_message red"><?php if(isset($err['shop'])){ echo $err['shop']; } ?> </p>
        <p class="err_shop red text_center"></p>
      </div>


      <div class="input_content">

        <p class="label_text">購入日</p>
        <input id="date" class="date_input" name="date" type="date" value="<?= $view_date; ?>" />
        <p class="err_message red"><?php if(isset($err['date'])){ echo $err['date']; } ?> </p>
        <p class="err_date red text_center"></p>
      </div>

      <div class="input_content">

        <p class="label_text">品名</p>
        <input id="name" class="text_box" name="name" value="<?= h($name); ?>">
        <p class="err_message red"><?php if(isset($err['name'])){ echo $err['name']; } ?> </p>
        <p class="err_name red text_center"></p>
      </div>


      <div class="input_content">
        <p class="label_text">品名(カナ)</p>
        <input id="kana" class="text_box" name="kana" value="<?= h($kana); ?>">
        <p class="err_message red"><?php if(isset($err['kana'])){ echo $err['kana']; } ?> </p>
        <p class="err_kana red text_center"></p>
      </div>

      <div class="input_content">
        <p class="label_text">商品名称</p>
        <input id="item_name" class="text_box" name="item_name" value="<?= h($item_name); ?>">
        <p class="err_message red"><?php if(isset($err['item_name'])){ echo $err['item_name']; } ?> </p>
        <p class="err_item_name red text_center"></p>
      </div>

      <div class="input_content">
        <p class="label_text">金額(税込)</p>
        <input id="price" class="text_box" name="price" value="<?= h($price); ?>">
        <p class="err_message red"><?php if(isset($err['price'])){ echo $err['price']; } ?> </p>
        <p class="err_price red text_center"></p>
      </div>
        
      <div class="input_content">
        <p class="label_text">コメント</p>
        <textarea id="comment" class="textarea" name="comment" cols="30" rows="10" ><?= h($comment) ?></textarea>
        <p class="err_message red"><?php if(isset($err['comment'])){ echo $err['comment']; } ?> </p>
        <p class="err_comment red text_center"></p>
      </div>

        <button class="btn btn--orange" type="submit">更新</button>
      </form>
      <br>
    </div>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>
</body>



</html>
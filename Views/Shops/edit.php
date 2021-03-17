<?php
  require_once(ROOT_PATH.'Controllers/ShopController.php');
  function h($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    // 特殊文字を変換する
  }
  session_start();
  $SHOP = new ShopController;
  $id = $_GET['id'];
  $result = $SHOP->shop_select();


  $user_id = $_SESSION['log_in']['id'];
  $shop_user_id = $result['user_id'];
 
  if($user_id != $shop_user_id || empty($result)){
    // 他人の店の場合
    header("Location: /Items/index.php");
  }


  $name = $result['name'];
  $branch_name = $result['branch_name'];
  $prefecture_id = $result['prefecture_id'];
  $prefecture = $SHOP->prefecture($result['prefecture_id']);
  $city = $result['city'];
  $block_number = $result['block_number'];
  $collapse = $result['collapse'];


// -----------------------------------------------------------------------------------
  // 編集操作のバリデーション

  if(!empty($_POST)){

    if(empty($_POST['name'])){
      $err['name'] = '店名は必須項目です。';
    }elseif(mb_strlen($_POST['name']) > 20){
      $err['name'] = '店名は20文字以内です。';
    }

    $p_id = $_POST['prefecture_id'];
    if($p_id >= 1 && !empty($_POST['city']) && !empty($_POST['block_number'])){
    }elseif($p_id == 0 && empty($_POST['city']) && empty($_POST['block_number'])){
    }else{
      $err['address'] = '住所は全て入力してください';
    }

    if(empty($err)){
      $result = $SHOP->edit_shop();
      $url = "/Shops/show.php?id=".$id;
      header("Location: ".$url);
      exit();
    }


  }

  // ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/reset.css">
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/Shop/edit.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js?ver=3.4.1"></script>
  <script type="text/javascript" src="/js/validation.js"></script>
  <title>店舗情報編集ページ</title>
</head>
<body>
  <header>
    <h1 class="app_logo"><a href="/Items/index.php">Price Checker</a></h1>
  </header>
  <main>
    <div class="container">
      <form id="shop" action="edit.php?id=<?= $id ?>" method="post">

        <input type="hidden" name="id" value="<?= $id ?>">

      <br><br>
      <div class="input_content"> 
        <p class="label_text">店舗名</p>
        <input id="name" class="text_box" name="name" value="<?= h($name); ?>">
        <p class="err_message red"><?php if(isset($err['name'])){ echo $err['name']; } ?> </p>
        <p class="err_name red text_center"></p>
      </div>


      <div class="input_content">
        <p class="label_text">支店名</p>
        <input id="branch_name" class="text_box" name="branch_name" value="<?= h($branch_name); ?>">
        <p class="err_message red"><?php if(isset($err['branch_name'])){ echo $err['branch_name']; } ?> </p>
      </div>

      <div class="input_content">
        <p class="label_text">都道府県</p>
        <select id="prefecture" class="select_box" name="prefecture_id">
          <option value="<?= $prefecture_id ?>"><?= $prefecture ?></option>
          <?php require_once(ROOT_PATH .'Views/template/prefecture_list.php'); ?>
        </select>
        <p class="err_message red"><?php if(isset($err['address'])){ echo $err['address']; } ?> </p>
        <p class="err_prefecture red text_center"></p>
      </div>


      <div class="input_content">
        <p class="label_text">市区町村</p>
        <input id="city" class="text_box" name="city" value="<?= h($city); ?>">
        <p class="err_city red text_center"></p>
      </div>


      <div class="input_content">
        <p class="label_text">所番地</p>
        <input id="block_number" class="text_box" name="block_number" value="<?= h($block_number); ?>">
        <p class="err_block_number red text_center"></p>
      </div>


        <?php if($collapse == 1){ ?>
          <fieldset>
            <input id="item-1" class="radio-inline__input" type="radio" name="collapse" value="1" checked="checked"/>
            <label class="radio-inline__label" for="item-1">
                営業中
            </label>
            <input id="item-2" class="radio-inline__input" type="radio" name="collapse" value="2"/>
            <label class="radio-inline__label" for="item-2">
                閉店
            </label>
          </fieldset>
        <?php }elseif($collapse == 2){ ?>
          <fieldset>
            <input id="item-1" class="radio-inline__input" type="radio" name="collapse" value="1"/>
            <label class="radio-inline__label" for="item-1">
                営業中
            </label>
            <input id="item-2" class="radio-inline__input" type="radio" name="collapse" value="2" checked="checked" />
            <label class="radio-inline__label" for="item-2">
                閉店
            </label>
          </fieldset>

        <?php } ?>

        <p class="err_message red"><?php if(isset($err['collapse'])){ echo $err['collapse']; } ?> </p>


        <button class="btn btn--orange" type="submit">更新</button>
      </form>
      <br>
    </div>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>
</body>
</html>
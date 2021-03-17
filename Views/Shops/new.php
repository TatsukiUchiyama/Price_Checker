<?php
  require_once(ROOT_PATH.'Controllers/ShopController.php');
  function h($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    // 特殊文字を変換する
  }
  session_start();

  if(empty($_SESSION['log_in'])){
    header('Location: /Items/index.php');
  }

  if(!empty($_POST)){

  //   //POSTのValidate。

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
      $shop = new ShopController();
      $shop->create_shop();
      header('Location: /Shops/index.php');
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
  <link rel="stylesheet" type="text/css" href="/css/Shop/new.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js?ver=3.4.1"></script>
  <script type="text/javascript" src="/js/validation.js"></script>
  <title>新規登録</title>
</head>
<body>

  <header>
    <h1 class="app_logo"><a href="/Items/index.php">Price Checker</a></h1>
  </header>
  <main>
    <div class="container">
      <form id="shop" action="new.php" method="post">

      <br><br>
      <div class="input_content">
          <p class="label_text">店名</p>
          <input id="name" class="text_box" name="name" value="<?php echo isset($_POST['name']) ? h($_POST['name']) : ''; ?>">
          <p class="err_message red"><?php if(isset($err['name'])){ echo $err['name']; } ?> </p>
          <p class="err_name red text_center"></p>
      </div>

      <div class="input_content">
          <p class="label_text">支店名</p>
          <input class="text_box" name="branch_name" value="<?php echo isset($_POST['branch_name']) ? h($_POST['branch_name']) : ''; ?>">
          <p class="err_message red"><?php if(isset($err['branch_name'])){ echo $err['branch_name']; } ?> </p>
      </div>

      <div class="input_content">
          <p class="label_text">都道府県</p>
          <select id="prefecture" class="select_box" name="prefecture_id">
            <?php require_once(ROOT_PATH .'Views/template/prefecture_list.php'); ?>
          </select>
          <p class="err_message red"><?php if(isset($err['address'])){echo $err['address'];} ?></p>
          <p class="err_prefecture red text_center"></p>
      </div>


      <div class="input_content">
          <p class="label_text">市区町村</p>
          <input id="city" class="text_box" name="city" value="<?php echo isset($_POST['city']) ? h($_POST['city']) : ''; ?>">
          <p class="err_city red text_center"></p>
      </div>


      <div class="input_content">
          <p class="label_text">所番地</p>
          <input id="block_number" class="text_box" name="block_number" value="<?php echo isset($_POST['block_number']) ? h($_POST['block_number']) : ''; ?>">
          <p class="err_block_number red text_center"></p>
      </div>

          <input type="hidden" name="user_id" value="<?= $_SESSION['log_in']['id']; ?>">

          <button class="btn btn--orange" type="submit">登録</button>
      </form>
    </div>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>
</body>
</html>


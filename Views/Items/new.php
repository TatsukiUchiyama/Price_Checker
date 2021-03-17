<?php
  require_once(ROOT_PATH.'Controllers/ItemController.php');
  require_once(ROOT_PATH.'Controllers/ShopController.php');
  session_start();

  $user_id = $_SESSION['log_in']['id'];
  $Shop = new ShopController;
  $shops = $Shop->shop_all($user_id);

  if(empty($shops)){
    header('Location: index.php');
  }
  if(empty($user_id)){
    header('Location: index.php');
  }


  function h($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    // 特殊文字を変換する
  }


  if(!empty($_POST)){

  //   //POSTのValidate。

    if(empty($_POST['shop_id'])){
      $err['shop'] = '店名は必須項目です。';
    }
    if(empty($_POST['date'])){
      $err['date'] = '購入日は必須項目です。';
    }



    $length = count($_POST['item']['name']);

    for($i = 0;$i < $length; $i++){


      if(empty($_POST['item']['name'][$i])){
        $err['name'] = '品名は必須項目です。';
      }elseif(mb_strlen($_POST['item']['name'][$i]) > 20){
        $err['name'] = '品名は20文字以内です。';
      }
      if(empty($_POST['item']['kana'][$i])){
        $err['kana']= '品名(カナ)は必須項目です。';
      }elseif(mb_strlen($_POST['item']['kana'][$i]) > 50){
        $err['kana'] = '品名(カナ)は50文字以内です。';
      }

      if(empty($_POST['item']['price'][$i])){
        $err['price'] = '値段は必須項目です。';
      }elseif(!preg_match('/^[0-9]+$/', $_POST['item']['price'][$i])){
        $err['price'] = '半角数字で入力してください。';
      }

    }


    if(empty($err)){
      $item = new ItemController();
      $result = $item->create_item();
      header('Location: index.php');
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
  <link rel="stylesheet" type="text/css" href="/css/Item/new.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js?ver=3.4.1"></script>
  <script type="text/javascript" src="/js/add_item.js"></script>
  <script type="text/javascript" src="/js/plus_tax.js"></script>
  <script type="text/javascript" src="/js/validation.js"></script>
  <script type="text/javascript" src="/js/check.js"></script>
  <script type="text/javascript" src="/js/jquery.autoKana.js"></script>
  <script type="text/javascript">
let tax = 1.1;
  $(document).ready(
      function() {
      $.fn.autoKana('.auto_name', '.auto_kana', {
          katakana : true
          });
      });
  </script>
  <title>Price checker  商品登録</title>
</head>
<body>

  <header>
    <h1 class="app_logo"><a href="/Items/index.php">Price Checker</a></h1>

  </header>
  <main>
    <div class="container">
      <form id="item_new" action="new.php" method="post">

        <div class="one_shopping">


          <div class="input_content">
            <p class="label_text">店舗</p>
            <select tabindex="1" class="select_box" name="shop_id">
              <?php foreach($shops as $shop): ?>
                <option value="<?= $shop['id']; ?>"><?= $shop['name']."".$shop['branch_name']; ?></option>
              <?php endforeach ?>
            </select>
            <p class="err_message red"><?php if(isset($err['shop'])){ echo $err['shop']; } ?> </p>
            <p class="err_shop red text_center"></p>
          </div>

          <div class="input_content">
            <p class="label_text">購入日</p>
            <input tabindex="2" class="date_input" name="date" type="date" />
            <p class="err_message red"><?php if(isset($err['date'])){ echo $err['date']; } ?> </p>
            <p class="err_date red text_center"></p>
          </div>

        </div>

        <div class="items">

          <div class="one_item">
                  <div class="input_contents">
                    <div class="input_content">
                      <p class="label_text">品名</p>
                      <input tabindex="3" id="name_0" class="text_box auto_name" name="item[name][]">
                      <p class="err_message red"><?php if(isset($err['name'][0])){ echo $err['name'][0]; } ?> </p>
                      <p class="err_name_0 red text_center"></p>
                    </div>
                    <div class="input_content">
                      <p class="label_text">品名(カナ)</p>
                      <input tabindex="4" id="kana_0" class="text_box auto_kana" name="item[kana][]">
                      <p class="err_message red"><?php if(isset($err['kana'][0])){ echo $err['kana'][0]; } ?> </p>
                      <p class="err_kana_0 red text_center"></p>
                    </div>
                  </div>
  
                  <div  class="input_contents">
                    <div class="input_content">
                      <p class="label_text">商品名称</p>
                      <input tabindex="5" id="item_name_0" class="text_box" name="item[item_name][]">
                      <p class="err_message red"><?php if(isset($err['item_name'][0])){ echo $err['item_name'][0]; } ?> </p>
                      <p class="err_item_name_0 red text_center"></p>
                    </div>
                    <div class="input_content">
                      <p class="label_text">金額(税込)</p>
                      <div class="price_area"><input tabindex="6" id="price_0" class="text_box price" name="item[price][]"><p class="yen">円</p><button tabindex="7" type="button" id="plus_tax_0" class="btn btn--orange tax_btn">+tax</button></div>
                      <p class="err_message red"><?php if(isset($err['price'][0])){ echo $err['price'][0]; } ?></p>
                      <p class="err_price_0 red text_center"></p>
                    </div>
                  </div>
  
  
                  <div class="input_content">
                    <p class="label_text">コメント</p>
                    <textarea tabindex="8" id="comment_0" class="textarea" name="item[comment][]" cols="30" rows="10" value="<?php echo isset($_POST['comment']) ? nl2br(h($_POST['comment'])) : ''; ?>"></textarea>
                    <p class="err_message red"><?php if(isset($err['comment'][0])){ echo $err['comment'][0]; } ?> </p>
                    <p class="err_comment_0 red text_center"></p>
                  </div>
          </div>
                <!-- appendメソッドで２個目以降の要素を追加 -->
        </div>
        
        <button tabindex="10000" id="delete_item" class="btn btn--orange" type="button" onClick="return delete_alert()">削除する</button>

        <input type="hidden" name="user_id" value="<?= $_SESSION['log_in']['id']; ?>">

      <div class="item_counter">
        <button tabindex="9" id="add_item" type="button" class="btn btn--orange">追加する</button>
        <button tabindex="10001" id="submit" class="btn btn--orange" type="submit">登録</button>
      </div>
      </form>
    </div>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>
</body>
</html>
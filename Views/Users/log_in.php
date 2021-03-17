<?php
  require_once(ROOT_PATH.'Controllers/UserController.php');
  function h($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    // 特殊文字を変換する
  }
  

  session_start();

  if(!empty($_SESSION['log_in'])){
    header('Location: /Items/index.php');
  }


  if(!empty($_POST)){

    //POSTのValidate。
    // email
    if(empty($_POST['email'])){
      $err['email'] = 'メールアドレスは必須項目です。';
    }

    if (empty($_POST['password'])) {
      $err['password'] = 'パスワードは必須項目です。';
    }

    if(empty($err)){

      $user = new UserController();
      $err['log_in'] = $user->log_in();
    
    }
  }

 ?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>Price checker ログイン</title>
   <link rel="stylesheet" type="text/css" href="/css/reset.css">
   <link rel="stylesheet" type="text/css" href="/css/base.css">
   <link rel="stylesheet" type="text/css" href="/css/User/log_in.css">
   <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js?ver=3.4.1"></script>
   <script type="text/javascript" src="/js/validation.js"></script>
 </head>
 <body>
  <header>
    <h1 class="app_logo"><a href="/Items/index.php"> Price Checker</a></h1>
  </header>
  <div class="log_in_container">
    <form id="log_in" action="log_in.php" method="post">

    <br><br>
    <div class="input_content">
      <p class="label_text">メールアドレス</p>
      <input id="email" class="text_box" type="email" name="email" value="<?php echo isset($_POST['email']) ? h($_POST['email']) : ''; ?>">
      <p class="err_message red"><?php if(isset($err['email'])){ echo $err['email']; } ?> </p>
      <p class="err_email red text_center"></p>
    </div>

    <div class="input_content">
      <p class="label_text">パスワード</p>
      <input id="password" class="text_box" type="password" name="password" value="<?php echo isset($_POST['password']) ? h($_POST['password']) : ''; ?>">
      <p class="err_message red"><?php if(isset($err['password'])){ echo $err['password']; } ?> </p>
      <p class="err_password red text_center"></p>
    </div>

      <button class="btn btn--orange" type="submit">ログイン</button>
      <p class="err_message red">
      <?php
      if(isset($err['log_in'])){
          echo $err['log_in'];
          }
        ?>
        </p>
    </form>
  </div>
  <div class="bottom_container">
    <p class="sign_in"><a href="sign_up.php">新規登録</a></p>
    <p class="reset_password"><a href="reset_password.php">パスワードをお忘れですか？</a></p>
  </div>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>
 </body>
</html>

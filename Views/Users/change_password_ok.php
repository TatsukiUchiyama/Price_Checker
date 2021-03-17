<?php
  require_once(ROOT_PATH.'Controllers/UserController.php');

$user = new UserController;
session_start();
if(empty($_SESSION['email'])){

  header('location: /Items/index.php');
}
  var_dump($_SESSION);




if(!empty($_POST)){

  //POSTのValidate。

    if (empty($_POST['password'])) {
      $err['password'] = 'パスワードは必須項目です。';
    }elseif(!preg_match("/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}$/i", $_POST['password'])){
      $err['password'] = 'パスワード8文字以上で英字・数字を1文字ずつ以上利用してください。';
    }

    if (empty($_POST['password_check'])) {
      $err['password_check'] = '確認用パスワードは必須項目です。';
    }elseif($_POST['password_check'] !== $_POST['password']) {
      $err['password_check'] = '同一のパスワードを入力してください';
    }



  if(empty($err)){


    var_dump($_SESSION);
    $password = $_POST['password'];
    $email = $_SESSION['email'];
    $user->change_password($email, $password);
    header('location: changed_password.php');
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
<link rel="stylesheet" type="text/css" href="/css/User/reset_password.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js?ver=3.4.1"></script>
<script type="text/javascript" src="/js/validation.js"></script>
<title>パスワードの変更</title>
</head>
<body>
<header>
  <h1 class="app_logo"><a href="/Items/index.php">Price Checker</a></h1>
</header>
<main>
  <div class="container">
    <h4 class="title">新しいパスワードの設定</h4>
    <form id="change_password" action="change_password_ok.php" method="post">

    <div class="input_content">
      <p class="label_text">新しいパスワード</p>
      <input id="new_password" class="text_box" type="password" name="password">
      <p class="err_message red"><?php if(isset($err['password'])){echo $err['password'];} ?></p>
      <p class="err_new_password red text_center"></p>
    </div>


    <div class="input_content">
      <p class="label_text">新しいパスワード(確認用)</p>
      <input id="check_password" class="text_box" type="password" name="password_check">
      <p class="err_message red"><?php if(isset($err['password_check'])){echo $err['password_check'];} ?></p>
      <p class="err_check_password red text_center"></p>
    </div>

      <br>
      <button class="btn btn--orange" type="submit">変更</button>
    </form>
    <br>
  </div>
</main>
<?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>
</body>
</html>

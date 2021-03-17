<?php
  require_once(ROOT_PATH.'Controllers/UserController.php');
  function specialchars($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    // 特殊文字を変換する
  }
  session_start();

  if(!empty($_SESSION['log_in'])){
    header('Location: /Items/index.php');
  }

  if(!empty($_POST)){

    //POSTのValidate。
    // name
    if(empty($_POST['name'])){
      $err['name'] = 'ニックネームは必須項目です。';
    }
    // email
    if(empty($_POST['email'])){
      $err['email'] = 'メールアドレスは必須項目です。';
    }

    if (!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $_POST['email'])) {
      $err['email'] = 'メールアドレスを入力してください。';
    }

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
      $user = new UserController();
      $err['email'] = $user->sign_up();
      if($err['email'] != 'そのメールアドレスは既に使用されています。'){
        $_SESSION['log_in'] = $_POST;
        header('Location: /Items/index.php');
        exit();
      }
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
  <link rel="stylesheet" type="text/css" href="/css/User/sign_up.css">
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
  <div class="container">


    <form id="sign_up" action="sign_up.php" method="post">

    <br><br>
    <div class="input_content">
      <p class="label_text">ニックネーム</p>
      <input id="name" class="text_box" type="name" name="name" value="<?php echo isset($_POST['name']) ? specialchars($_POST['name']) : ''; ?>">
      <p class="err_message red"><?php if(isset($err['name'])){ echo $err['name']; } ?> </p>
      <p class="err_name red text_center"></p>
    </div>


    <div class="input_content">
      <p class="label_text">email</p>
      <input id="email" class="text_box" type="email" name="email" value="<?php echo isset($_POST['email']) ? specialchars($_POST['email']) : ''; ?>">
      <p class="err_message red"><?php if(isset($err['email'])){ echo $err['email']; } ?> </p>
      <p class="err_email red text_center"></p>
    </div>


    <div class="input_content">
      <p class="label_text">パスワード</p>
      <input id="password" class="text_box" type="password" name="password" value="<?php echo isset($_POST['password']) ? specialchars($_POST['password']) : ''; ?>">
      <p class="err_message red"><?php if(isset($err['password'])){echo $err['password'];} ?></p>
      <p class="err_password red text_center"></p>
    </div>

    <div class="input_content">
      <p class="label_text">パスワード(確認用)</p>
      <input id="check_password" class="text_box" type="password" name="password_check" value="<?php echo isset($_POST['password_check']) ? specialchars($_POST['password_check']) : ''; ?>">
      <p class="err_message red"><?php if(isset($err['password_check'])){echo $err['password_check'];} ?></p>
      <p class="err_check_password red text_center"></p>
    </div>

      <br>
      <button class="btn btn--orange" type="submit" name="signup" value="新規登録">新規登録</button>
    </form>
  </div>

  <p class="log_in"><a href="log_in.php">ログインページに戻る</a></p>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>

</body>
</html>


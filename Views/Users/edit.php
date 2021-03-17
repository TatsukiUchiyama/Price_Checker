<?php
  require_once(ROOT_PATH.'Controllers/UserController.php');
  function specialchars($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    // 特殊文字を変換する
  }
  session_start();
  $user = new UserController;
  $id = $_SESSION['log_in']['id'];
  $name  = $_SESSION['log_in']['name'];
  $email = $_SESSION['log_in']['email'];

  if(empty($id)){
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

    if($_POST['password'] != null || $_POST['before_password'] != null){

      if (empty($_POST['password'])) {
        $err['password'] = 'パスワードは必須項目です。';
      }elseif(!preg_match("/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}$/i)", $_POST['password'])){
        $err['password'] = 'パスワード8文字以上で英字・数字を1文字ずつ以上利用してください。';
      }

      if (empty($_POST['password_check'])) {
        $err['password_check'] = '確認用パスワードは必須項目です。';
      }elseif($_POST['password_check'] !== $_POST['password']) {
        $err['password_check'] = '同一のパスワードを入力してください';
      }

      $result = $user->before_passcheck();
      if (empty($result)){
        $err['before_password'] = 'パスワードが一致しません。';
      }
    }

    if(empty($err)){
      $result = $user->edit_user();
      if($result != 'そのメールアドレスは既に使用されています。'){
        $_SESSION['log_in'] = $_POST;
        var_dump($result);
        header('location: show.php');
      }else{
        $err['email'] = 'そのメールアドレスは既に使用されています。';
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
  <link rel="stylesheet" type="text/css" href="/css/User/edit.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js?ver=3.4.1"></script>
  <script type="text/javascript" src="/js/validation.js"></script>
  <title>ユーザー情報編集 </title>
</head>
<body>
  <header>
    <h1 class="app_logo"><a href="/Items/index.php">Price Checker</a></h1>
  </header>
  <main>
    <div class="container">
      <form id="user_edit" action="edit.php" method="post">

      <input type="hidden" name="id" value="<?= $id ?>">
        
      <br><br>
      <div class="input_content">
        <p class="label_text">ニックネーム</p>
        <input id="name" class="text_box" type="name" name="name" value="<?= specialchars($name); ?>">
        <p class="err_message red"><?php if(isset($err['name'])){ echo $err['name']; } ?> </p>
        <p class="err_name red text_center"></p>
      </div>


      <div class="input_content">
        <p class="label_text">メールアドレス</p>
        <input id="email" class="text_box" type="email" name="email" value="<?= specialchars($email); ?>">
        <p class="err_message red"><?php if(isset($err['email'])){ echo $err['email']; } ?> </p>
        <p class="err_email red text_center"></p>
      </div>


      <div class="input_content">
        <p class="label_text">現在のパスワード</p>
        <input id="before_password" class="text_box" type="password" name="before_password">
        <p class="err_message red"><?php if(isset($err['before_password'])){echo $err['before_password'];} ?></p>
        <p class="err_before_password red text_center"></p>
      </div>


      <div class="input_content">
        <p class="label_text">新しいパスワード</p>
        <input id="new_password" class="text_box" type="password" name="password">
        <p class="err_message red"><?php if(isset($err['password'])){echo $err['password'];} ?></p>
        <p class="err_new_password red text_center"></p>
      </div>


      <div class="input_content">
        <p class="label_text">新しいパスワード（確認用）</p>
        <input id="check_password" class="text_box" type="password" name="password_check">
        <p class="err_message red"><?php if(isset($err['password_check'])){echo $err['password_check'];} ?></p>
        <p class="err_check_password red text_center"></p>
      </div>

        <br>
        <button class="btn btn--orange" type="submit">更新</button>
      </form>
      <br>
    </div>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>
</body>
</html>


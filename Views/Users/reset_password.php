
<?php
  require_once(ROOT_PATH.'Controllers/UserController.php');
  require_once(ROOT_PATH.'Controllers/ResetpassController.php');
  require_once(ROOT_PATH.'Controllers/MailController.php');
  function h($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    // 特殊文字を変換する
  }

  if(!empty($_SESSION['log_in'])){
    header('Location: /Items/index.php');
  }

  session_start();

  if(!empty($_POST)){

    // email
    if(empty($_POST['email'])){
      $err['email'] = 'メールアドレスは必須項目です。';
    }

    if (!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $_POST['email'])) {
      $err['email'] = 'メールアドレスを入力してください。';
    }

    if(empty($err)){
      // メール送信処理
      $USER = new UserController;
      $token = $USER->reset_password();
      if($token == "なし"){
      }else{
        $reset = new ResetpassController;
        $reset->insert_token($token, $_POST['email']);

        $post = array('token'=>$token, 'email'=> $_POST['email']);
        // PHPMailerを起動するメソッド
        $mail = new MailController;
        $mail->autoMail($post);
      }
      header('location: send_mail.php');
    }

  }

 ?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>Price checker パスワードを忘れですか？</title>
   <link rel="stylesheet" type="text/css" href="/css/reset.css">
   <link rel="stylesheet" type="text/css" href="/css/base.css">
   <link rel="stylesheet" type="text/css" href="/css/User/reset_password.css">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js?ver=3.4.1"></script>
   <script type="text/javascript" src="/js/validation.js"></script>
 </head>
 <body>
  <header>
    <h1 class="app_logo"><a href="/Items/index.php"> Price Checker</a></h1>
  </header>
  <main>
    <div class="container">
      <p class="Explanatory_text">パスワードをお忘れの際は再設定が必要です。<br><br>
                                  お手数ですが登録されたメールアドレスを<br>
                                  入力の上送信ボタンを押してください。<br><br>
                                  パスワード再設定用のメールをお送りいたします。
      </p>
    <form id="reset_password" action="reset_password.php" method="post">
      <div class="input_content">
        <p class="label_text">メールアドレス</p>
        <input id="reset_password_email" class="text_box" type="text" name="email">
        <p class="err_message red"><?php if(isset($err['email'])){ echo $err['email']; } ?> </p>
        <p class="err_email red text_center"></p>
      </div>
      <button class="btn btn--orange">送信</button>
    </form>
    </div>
  </main>
  <?php require_once(ROOT_PATH .'Views/template/footer.php'); ?>
 </body>
</html>

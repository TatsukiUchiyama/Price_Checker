<?php


  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;



class Mail{

  function AutoMail($post){

    $token = $post['token'];

    // HPMailer のクラスをグローバル名前空間（global namespace）にインポート
    // スクリプトの先頭で宣言する！


    // PHPMailer のソースファイルの読み込み（ファイルの位置によりパスを適宜変更）
    require '../public/PHPMailer/src/Exception.php';
    require '../public/PHPMailer/src/PHPMailer.php';
    require '../public/PHPMailer/src/SMTP.php';

    //mbstring の日本語設定
    mb_language("japanese");
    mb_internal_encoding("UTF-8");

    // インスタンスを生成（引数に true を指定して例外 Exception を有効に）
    $mail = new PHPMailer(true);

    //日本語用設定
    $mail->CharSet = "iso-2022-jp";
    $mail->Encoding = "7bit";

    try {
    //サーバの設定
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  // デバグの出力を有効に（テスト環境での検証用）
    $mail->isSMTP();   // SMTP を使用
    $mail->Host       = 'smtp.gmail.com';  // Gmail SMTP サーバーを指定
    $mail->SMTPAuth   = true;   // SMTP authentication を有効に
    $mail->Username   = 'fukunaga.kinoko4929@gmail.com';  // Gmail ユーザ名
    $mail->Password   = 'ぱすわーど';  // Gmail パスワード
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // 暗号化（TLS)を有効に
    $mail->Port = 587;  // ポートは 587



    //受信者設定
    //差出人アドレス, 差出人名
    $mail->setFrom('fukunaga.kinoko4929@gmail.com', mb_encode_mimeheader("Price Checker"));
    // 受信者アドレス, 受信者名
    $mail->addAddress($post['email'], mb_encode_mimeheader("ユーザー様"));
    //Cc 受信者の指定
    //$mail->addCC('@');

    //コンテンツ設定
    $mail->isHTML(true);   // HTML形式を指定


      //メール表題（タイトル）
      $mail->Subject = mb_encode_mimeheader("ログインパスワードの再設定");
      //本文（HTML用）
      $mail->Body  = mb_convert_encoding(
        "Price Checkerをいつもご利用いただきありがとうございます。<br>
        下記のURLからログインパスワードの再設定を行ってください。<br>
        <br>
        <a href='http://localhost/Users/change_password.php?token=".$token."'>こちらをクリック</a><br>
        <br>
        <br>
        引き続きのご利用よろしくお願いします。"
      ,"JIS","UTF-8");


    //テキスト表示の本文
    $mail->AltBody = mb_convert_encoding('プレインテキストメッセージ non-HTML mail clients',"JIS","UTF-8");

    $mail->send();  //送信


    echo '';

    
    } catch (SMTP $e) {
    echo "メールが送信できませんでした: {$mail->ErrorInfo}";
    }
  }
}
//   use PHPMailer\PHPMailer\PHPMailer;
//   use PHPMailer\PHPMailer\SMTP;
//   use PHPMailer\PHPMailer\Exception;

// class Mail{

//   function AutoMail($post){
//       var_dump($post);
  //   $token = $post['token'];
  //   $email = $post['email'];

  //   // HPMailer のクラスをグローバル名前空間（global namespace）にインポート
  //   // スクリプトの先頭で宣言する！

  //   // PHPMailer のソースファイルの読み込み（ファイルの位置によりパスを適宜変更）
  //   require '../public/PHPMailer/src/Exception.php';
  //   require '../public/PHPMailer/src/PHPMailer.php';
  //   require '../public/PHPMailer/src/SMTP.php';

  //   //mbstring の日本語設定
  //   mb_language("japanese");
  //   mb_internal_encoding("UTF-8");

  //   // インスタンスを生成（引数に true を指定して例外 Exception を有効に）
  //   $mail = new PHPMailer(true);

  //   //日本語用設定
  //   $mail->CharSet = "iso-2022-jp";
  //   $mail->Encoding = "7bit";

  //   try {
  //   //サーバの設定
  //   //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  // デバグの出力を有効に（テスト環境での検証用）
  //   $mail->isSMTP();   // SMTP を使用
  //   $mail->Host       = 'smtp.gmail.com';  // Gmail SMTP サーバーを指定
  //   $mail->SMTPAuth   = true;   // SMTP authentication を有効に
  //   $mail->Username   = 'uchiyama4929@gmail.com';  // Gmail ユーザ名
  //   $mail->Password   = 'gtgdevwumroorhrw';  // Gmail パスワード
  //   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // 暗号化（TLS)を有効に
  //   $mail->Port = 587;  // ポートは 587

  //   //受信者設定
  //   //差出人アドレス, 差出人名
  //   $mail->setFrom('uchiyama4929@gmail.com', mb_encode_mimeheader("パスワードの再設定"));
  //   // 受信者アドレス, 受信者名
  //   $mail->addAddress($email, mb_encode_mimeheader("ユーザー様"));
  //   //Cc 受信者の指定
  //   //$mail->addCC('@');

  //   //コンテンツ設定
  //   $mail->isHTML(true);   // HTML形式を指定


  //   //メール表題（タイトル）
  //   $mail->Subject = mb_encode_mimeheader("Price Checker ログインパスワードの再設定");
  //   //本文（HTML用）
  //   $mail->Body  = mb_convert_encoding(
  //       "※このメールはシステムからの自動送信です。<br>
  //       <br>
  //       <br>
  //       <br>
  //       Price Checkerをいつもご利用いただきありがとうございます。<br>
  //       下記のURLからログインパスワードの再設定を行ってください。<br>
  //       <br>
  //       <a href='http://localhost/Users/change_password.php?id=".$token."'><br>
  //       <br>
  //       <br>
  //       引き続きのご利用よろしくお願いします。"
  //   ,"JIS","UTF-8");


  //   //テキスト表示の本文
  //   $mail->AltBody = mb_convert_encoding('プレインテキストメッセージ non-HTML mail clients',"JIS","UTF-8");

  //   $mail->send();  //送信



  //   echo '';
  //   } catch (SMTP $e) {
  //   echo "メールが送信できませんでした: {$mail->ErrorInfo}";
  //   }
//   }
// }
?>
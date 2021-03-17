<?php
require_once(ROOT_PATH .'/Models/Mail.php');

class MailController {

  public function __construct() {
    $this->Mail = new Mail();
  }

  // メールの自動送信機能
  public function autoMail($post){
    $this->Mail->AutoMail($post);
  }

}

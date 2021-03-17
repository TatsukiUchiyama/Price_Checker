<?php
require_once(ROOT_PATH .'/Models/ResetPass.php');

class ResetpassController {
  private $Resetpass;

  public function __construct() {
    $this->Resetpass= new ResetPass();

  }

  public function insert_token($token, $email) {
    $this->Resetpass->InsertToken($token, $email);
  }

  public function check_token($token){
    $result = $this -> Resetpass -> CheckToken($token);
    return $result;
  }
  
  public function delete_token($token){
    $this->Resetpass->DeleteToken($token);
  }
}

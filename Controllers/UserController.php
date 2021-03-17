<?php
require_once(ROOT_PATH .'/Models/User.php');

class UserController {
  private $User;

  public function __construct() {
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    $this->User = new User();

  }

  public function log_in(){
    $result = $this->User->LogIn($this->request['post']);
    return $result;
  }

  public function sign_up(){
    $result = $this->User->SignUp($this->request['post']);
    return $result;
  }

  public function before_passcheck(){
    $result = $this->User->BeforePassCheck($this->request['post']);
    return $result;
  }

  public function edit_user(){
    $result = $this->User->EditUser($this->request['post']);
    return $result;
  }

  public function reset_password(){
    $result = $this->User->ReSetPassWord($this->request['post']);
    return $result;
  }

  public function change_password($email, $password){
    $this -> User -> ChangePassword($email, $password);
  }
}

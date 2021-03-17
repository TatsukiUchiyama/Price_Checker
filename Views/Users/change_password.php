<?php

require_once(ROOT_PATH.'Controllers/ResetpassController.php');
require_once(ROOT_PATH.'Controllers/UserController.php');

$token = $_GET['token'];
$reset = new ResetpassController;
$result = $reset->check_token($token);

session_start();
$_SESSION['email'] = $result['email'];


if(empty($result)){
  header('location: /Items/index.php');
}else{
  $limitTime = date("Y-m-d H:i:s", strtotime("-1 day"));
}

if(strtotime($result["created_at"]) >= strtotime($limitTime)){
  $reset->delete_token($token);
  header('location: change_password_ok.php');

}else{
  $reset->delete_token($token);
  header('location: change_password_ng.php');
}


?>
<?php
require_once(ROOT_PATH.'/Models/Db.php');

class ResetPass extends Db {
  public function __construct($dbh = null){
    parent::__construct($dbh);
  }

  public function InsertToken($token, $email){

    $this->dbh->beginTransaction();

    try{
      $sql = "INSERT INTO reset_password (token, email) VALUES ('$token',:email)";
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(':email', $email, PDO::PARAM_STR);
      $sth->execute();
      
      $this->dbh->commit();
    }catch(Exception $e){
      $this->dbh->rollBack();
      echo $e->getMessage();
    }
  }

  public function CheckToken($token){
    $sql = "SELECT * FROM reset_password WHERE token = '".$token."'";
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function DeleteToken($token){
    $sql = "DELETE FROM reset_password WHERE token = '".$token."'";
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
  }

  
}
<?php
require_once(ROOT_PATH.'/Models/Db.php');

class User extends Db {
  
  public function SignUp($post){
    $name = $post['name'];
    $email = $post['email'];
    $password = md5 ($post['password'] , $binary = false );

    $checkSQL = "SELECT COUNT(*) as count FROM users WHERE email = :email";
    $stmt = $this->dbh->prepare($checkSQL);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();

    if($result['count'] > 0){
      $result = 'そのメールアドレスは既に使用されています。';
      return $result;
    }else{

      $sql = "INSERT INTO users(name, email, password) VALUE(:name, :email, :password)";

      $this->dbh -> beginTransaction();
      try {
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':name', $name, PDO::PARAM_STR);
        $sth->bindParam(':email', $email, PDO::PARAM_STR);
        $sth->bindParam(':password', $password, PDO::PARAM_STR);
        $sth->execute();
        $this->dbh->commit();
      }catch (PDOException $e){
        echo $e->getMessage();
        $this->dbh->rollBack();
        exit;
      }
    }
  }

  public function LogIn($post){
    $email = $post['email'];
    $password = md5 ($post['password'] , $binary = false );

    $sql = 'SELECT id, name, email, count(*) as count FROM users where email = :email and password = :password GROUP BY id';
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':email', $email, PDO::PARAM_STR);
    $sth->bindParam(':password', $password, PDO::PARAM_STR);
    $sth->execute();
    $result = $sth->fetch(); //0か１


    if(empty($result)){
      $result = "条件にあうアカウントが見つかりません。";
      return $result;
    }elseif($result['count'] == "1"){
      $_SESSION['log_in']['id'] = $result['id'];
      $_SESSION['log_in']['name'] = $result['name'];
      $_SESSION['log_in']['email'] = $result['email'];
      header('location: /Items/index.php');
      }
 
  }

  public function BeforePassCheck($post){
    $email = $post['email'];
    $before_pass = md5($post['before_password'] , $binary = false );

    $sql = "SELECT COUNT(*) as count FROM users WHERE email = :email and password = :before_pass";
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':email', $email, PDO::PARAM_STR);
    $sth->bindParam(':before_pass', $before_pass, PDO::PARAM_STR);
    $sth->execute();
    $result = $sth->fetch(); //0か１
    return $result;
  }

  public function EditUser($post){

    $id = $post['id'];
    $name = $post['name'];
    $email = $post['email'];

    if(!empty($email)){
      $checkSQL = "SELECT COUNT(*) as count FROM users WHERE email = :email AND id <> ".$id;
      $stmt = $this->dbh->prepare($checkSQL);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch();
  
      if($result['count'] > 0){
        $result = 'そのメールアドレスは既に使用されています。';
        return $result;
      }else{

        if(!empty($post['password'])){

          $password = md5 ($post['password'] , $binary = false );

          try{
            $this->dbh->beginTransaction();
            $sql = "UPDATE users SET
                    name = :name, 
                    email = :email, 
                    password  = :password
                    WHERE id = '$id';";
            
            $sth = $this->dbh->prepare($sql);
            $sth->bindValue(':name',  $name,  PDO::PARAM_STR);
            $sth->bindValue(':email',  $email,  PDO::PARAM_STR);
            $sth->bindValue(':password',   $password,   PDO::PARAM_STR);
            $sth->execute();
            $this->dbh->commit();
          }catch(Exception $e){
            $this->dbh->rollBack();
            echo $e->getMessage();
          }
        }else{
          try{
            $this->dbh->beginTransaction();

            $sql = "UPDATE users SET
                    name = :name, 
                    email = :email
                    WHERE id = '$id';";
            
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':name',  $name,  PDO::PARAM_STR);
            $sth->bindParam(':email',  $email,  PDO::PARAM_STR);
            $sth->execute();
            $this->dbh->commit();
          }catch(Exception $e){
            $this->dbh->rollBack();
            echo $e->getMessage();
          }
        }
      }
    }
  }

  public function ReSetPassWord($post){
    $email = $post['email'];


    $sql = 'SELECT count(*) as count FROM users where email = :email';
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':email', $email, PDO::PARAM_STR);
    $sth->execute();
    $result = $sth->fetch(); //0か１

    if($result['count'] == "1"){
      $passResetToken = md5(uniqid(rand(),true));
    }else{
      $passResetToken = "なし";
    }

    return $passResetToken;
  }


  public function ChangePassword($email, $password){


      $password = md5 ($password, $binary = false );

      try{
        $this->dbh->beginTransaction();
        $sql = "UPDATE users SET
                password  = :password
                WHERE email = :email";
        
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':email',   $email,   PDO::PARAM_STR);
        $sth->bindValue(':password',$password,PDO::PARAM_STR);
        $sth->execute();
        $this->dbh->commit();
      }catch(Exception $e){
        $this->dbh->rollBack();
        echo $e->getMessage();
      }
    
  }


}
?>


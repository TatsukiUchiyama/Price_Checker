<?php
require_once(ROOT_PATH.'/Models/Db.php');

class Shop extends Db {
  public function __construct($dbh = null){
    parent::__construct($dbh);
  }

  public function ShopAll($user_id){
    $sql = "SELECT * FROM shops WHERE user_id = '$user_id'";
    $sth = $this->dbh->prepare($sql);
    $sth -> execute();
    $result = $sth-> fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function ShopSelect($id){
    $sql = "SELECT * FROM shops WHERE id = '$id'";
    $sth = $this->dbh->prepare($sql);
    $sth -> execute();
    $result = $sth-> fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function CreateShop($post){
    $name = $post['name'];
    $branch_name = $post['branch_name'];
    $prefecture_id = $post['prefecture_id'];
    $city = $post['city'];
    $block_number = $post['block_number'];
    $user_id = $post['user_id'];


      try{
        $this->dbh->beginTransaction();

       
        $sql = "INSERT INTO shops (name,branch_name,prefecture_id,city,block_number,user_id) 
                VALUES (:name,:branch_name,:prefecture_id,:city,:block_number,:user_id)";
        
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':name',  $name,  PDO::PARAM_STR);
        $sth->bindParam(':branch_name',  $branch_name,  PDO::PARAM_STR);
        $sth->bindParam(':prefecture_id',  $prefecture_id,  PDO::PARAM_INT);
        $sth->bindParam(':city',  $city,  PDO::PARAM_STR);
        $sth->bindParam(':block_number',  $block_number,  PDO::PARAM_STR);
        $sth->bindParam(':user_id',  $user_id,  PDO::PARAM_INT);

        $sth->execute();
        $this->dbh->commit();
      }catch(Exception $e){
        $this->dbh->rollBack();
        echo $e->getMessage();
      }
  }

  public function EditShop($post){
    $id = $post['id'];
    $name = $post['name'];
    $branch_name = $post['branch_name'];
    $prefecture_id = $post['prefecture_id'];
    $city = $post['city'];
    $block_number = $post['block_number'];
    $user_id = $post['user_id'];
    $collapse = $post['collapse'];

    try{
      $this->dbh->beginTransaction();

     
      $sql = "UPDATE shops SET
              name = :name,
              branch_name = :branch_name,
              prefecture_id = :prefecture_id,
              city = :city,
              block_number = :block_number,
              collapse = :collapse 
              WHERE id = '$id'";
      
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(':name',  $name,  PDO::PARAM_STR);
      $sth->bindParam(':branch_name',  $branch_name,  PDO::PARAM_STR);
      $sth->bindParam(':prefecture_id',  $prefecture_id,  PDO::PARAM_INT);
      $sth->bindParam(':city',  $city,  PDO::PARAM_STR);
      $sth->bindParam(':block_number',  $block_number,  PDO::PARAM_STR);
      $sth->bindParam(':collapse',  $collapse,  PDO::PARAM_INT);

      $sth->execute();
      $this->dbh->commit();
    }catch(Exception $e){
      $this->dbh->rollBack();
      echo $e->getMessage();
    }
  }

  public function Prefecture($id){
    switch ($id) {
      case 0:
        $result = "";
        break;
      case 1:
        $result = "?????????";
        break;
      case 2:
        $result = "?????????";
        break;
      case 3:
        $result = "?????????";
        break;
      case 4:
        $result = "?????????";
        break;
      case 5:
        $result = "?????????";
        break;
      case 6:
        $result = "?????????";
        break;
      case 7:
        $result = "?????????";
        break;
      case 8:
        $result = "?????????";
        break;
      case 9:
        $result = "?????????";
        break;
      case 10:
        $result = "?????????";
        break;
      case 11:
        $result = "?????????";
        break;
      case 12:
        $result = "?????????";
        break;
      case 13:
        $result = "?????????";
        break;
      case 14:
        $result = "????????????";
        break;
      case 15:
        $result = "?????????";
        break;
      case 16:
        $result = "?????????";
        break;
      case 17:
        $result = "?????????";
        break;
      case 18:
        $result = "?????????";
        break;
      case 19:
        $result = "?????????";
        break;
      case 20:
        $result = "?????????";
        break;
      case 21:
        $result = "?????????";
        break;
      case 22:
        $result = "?????????";
        break;
      case 23:
        $result = "?????????";
        break;
      case 24:
        $result = "?????????";
        break;
      case 25:
        $result = "?????????";
        break;
      case 26:
        $result = "?????????";
        break;
      case 27:
        $result = "?????????";
        break;
      case 28:
        $result = "?????????";
        break;
      case 29:
        $result = "?????????";
        break;
      case 30:
        $result = "????????????";
        break;
      case 31:
        $result = "?????????";
        break;
      case 32:
        $result = "?????????";
        break;
      case 33:
        $result = "?????????";
        break;
      case 34:
        $result = "?????????";
        break;
      case 35:
        $result = "?????????";
        break;
      case 36:
        $result = "?????????";
        break;
      case 37:
        $result = "?????????";
        break;
      case 38:
        $result = "?????????";
        break;
      case 39:
        $result = "?????????";
        break;
      case 40:
        $result = "?????????";
        break;
      case 41:
        $result = "?????????";
        break;
      case 42:
        $result = "?????????";
        break;
      case 43:
        $result = "?????????";
        break;
      case 44:
        $result = "?????????";
        break;
      case 45:
        $result = "?????????";
        break;
      case 46:
        $result = "????????????";
        break;
      case 47:
        $result = "?????????";
        break;
    }
    return $result;
  }

}

?>
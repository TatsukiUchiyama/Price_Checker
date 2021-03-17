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
        $result = "北海道";
        break;
      case 2:
        $result = "青森県";
        break;
      case 3:
        $result = "岩手県";
        break;
      case 4:
        $result = "宮城県";
        break;
      case 5:
        $result = "秋田県";
        break;
      case 6:
        $result = "山形県";
        break;
      case 7:
        $result = "福島県";
        break;
      case 8:
        $result = "茨城県";
        break;
      case 9:
        $result = "栃木県";
        break;
      case 10:
        $result = "群馬県";
        break;
      case 11:
        $result = "埼玉県";
        break;
      case 12:
        $result = "千葉県";
        break;
      case 13:
        $result = "東京都";
        break;
      case 14:
        $result = "神奈川県";
        break;
      case 15:
        $result = "新潟県";
        break;
      case 16:
        $result = "富山県";
        break;
      case 17:
        $result = "石川県";
        break;
      case 18:
        $result = "福井県";
        break;
      case 19:
        $result = "山梨県";
        break;
      case 20:
        $result = "長野県";
        break;
      case 21:
        $result = "岐阜県";
        break;
      case 22:
        $result = "静岡県";
        break;
      case 23:
        $result = "愛知県";
        break;
      case 24:
        $result = "三重県";
        break;
      case 25:
        $result = "滋賀県";
        break;
      case 26:
        $result = "京都府";
        break;
      case 27:
        $result = "大阪府";
        break;
      case 28:
        $result = "兵庫県";
        break;
      case 29:
        $result = "奈良県";
        break;
      case 30:
        $result = "和歌山県";
        break;
      case 31:
        $result = "鳥取県";
        break;
      case 32:
        $result = "島根県";
        break;
      case 33:
        $result = "岡山県";
        break;
      case 34:
        $result = "広島県";
        break;
      case 35:
        $result = "山口県";
        break;
      case 36:
        $result = "徳島県";
        break;
      case 37:
        $result = "香川県";
        break;
      case 38:
        $result = "愛媛県";
        break;
      case 39:
        $result = "高知県";
        break;
      case 40:
        $result = "福岡県";
        break;
      case 41:
        $result = "佐賀県";
        break;
      case 42:
        $result = "長崎県";
        break;
      case 43:
        $result = "熊本県";
        break;
      case 44:
        $result = "大分県";
        break;
      case 45:
        $result = "宮崎県";
        break;
      case 46:
        $result = "鹿児島県";
        break;
      case 47:
        $result = "沖縄県";
        break;
    }
    return $result;
  }

}

?>
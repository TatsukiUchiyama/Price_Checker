<?php
require_once(ROOT_PATH.'/Models/Db.php');

class Item extends Db {
  public function __construct($dbh = null){
    parent::__construct($dbh);
  }

  public function ItemAll(){
    $sql = "SELECT * FROM items";
    $sth = $this->dbh->prepare($sql);
    $sth -> execute();
    $result = $sth-> fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function SearchItem($input){
 
    function escape_LIKE($keyword) {
      return mb_ereg_replace('([_%#])', '#\1', $keyword);
    }

    if(!empty($input['user_id'])){
      $user_id = $input['user_id'];
    }
    
    if(!empty($input['name']) && !empty($input['address'])){
      $name = $input['name'];
      $escape_name = escape_LIKE($name);
      $Like_name = "'%".$escape_name."%'";
      $address = $input['address'];
      $escape_address = escape_LIKE($address);
      $Like_address = "'%".$escape_address."%'";
      $add_where = " WHERE (i.name LIKE ".$Like_name." OR i.kana LIKE ".$Like_name.") AND (s.city LIKE ".$Like_address." OR s.block_number LIKE ".$Like_address." )";
      
    }elseif(!empty($input['name'])){
      $name = $input['name'];
      $escape_name = escape_LIKE($name);
      $Like_name = "'%".$escape_name."%'";
      $add_where = " WHERE ( i.name LIKE ".$Like_name." OR i.kana LIKE ".$Like_name." )";

    }elseif(!empty($input['address'])){
      $address = $input['address'];
      $escape_address = escape_LIKE($address);
      $Like_address = "'%".$escape_address."%'";
      $add_where = " WHERE ( s.city LIKE ".$Like_address." OR s.block_number LIKE ".$Like_address." )";

    }else{
      $add_where = "";
    }
    if($input['MyItem'] == 1){
      if(!empty($add_where)){
        $add_where .= " AND i.user_id = ".$user_id;
      }else{
        $add_where .= " WHERE i.user_id = ".$user_id;
      }
    }
    if($input['close'] == 1){
      if(!empty($add_where)){
        $add_where .= " AND s.collapse = 1";
      }else{
        $add_where .= " WHERE s.collapse = 1";
      }
    }
    if($input['asc'] == 1){
      $add_where .= " ORDER BY i.price ASC";
    }
    

    $sql = "SELECT i.*, s.name as shop, s.branch_name as branch FROM items as i JOIN shops as s ON i.shop_id = s.id".$add_where;
    $sth = $this->dbh->prepare($sql);
    $sth -> execute();
    $result = $sth-> fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

  public function MonthlySum($input){
    $user_id = $input['user_id'];
    $input_date = $input['year']."-".$input['month'];
    $sql = "SELECT DATE_FORMAT(purchase_date, '%Y-%m') as month, SUM(price) as sum FROM items WHERE user_id = ".$user_id." GROUP BY DATE_FORMAT(purchase_date, '%Y-%m')";
    $sth = $this->dbh->prepare($sql);
    $sth -> execute();
    $result = $sth-> fetchAll(PDO::FETCH_ASSOC);
    
    foreach($result as $row){
      if ($row['month'] == $input_date){
        $input_monthly_sum = $row;
      }
    }
    if(empty($input_monthly_sum)){
      $input_monthly_sum = "なし";
    }
    
    return $input_monthly_sum;
  }


  public function CreateItem($post){

    $item = $post['item'];
    $purchase_date =  $post['date'];
    $shop_id =  $post['shop_id'];
    $user_id =  $post['user_id'];
    $this->dbh->beginTransaction();

    try{
        for($i=0;$i<count($item['name']);$i++){
      
            $sql = "INSERT INTO items (name,kana,item_name,price,purchase_date,comment,user_id,shop_id) 
                    VALUES (:name,:kana,:item_name,:price,:purchase_date,:comment,'$user_id','$shop_id')";
            
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':name',  $item['name'][$i],  PDO::PARAM_STR);
            $sth->bindParam(':kana',  $item['kana'][$i],  PDO::PARAM_STR);
            $sth->bindParam(':item_name',  $item['item_name'][$i],  PDO::PARAM_STR);
            $sth->bindParam(':price',  $item['price'][$i],  PDO::PARAM_INT);
            $sth->bindParam(':purchase_date',  $purchase_date,  PDO::PARAM_STR);
            $sth->bindParam(':comment',  $item['comment'][$i],  PDO::PARAM_STR);
            $sth->execute();
        }

    $this->dbh->commit();
    }catch(Exception $e){
      $this->dbh->rollBack();
      echo $e->getMessage();
    }


  }

  public function SelectItem($id){
    $sql = "SELECT * FROM items WHERE id = '$id'";
    $sth = $this->dbh->prepare($sql);
    $sth -> execute();
    $result = $sth-> fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function EditItem($post){

    $id = $post['id'];
    $name = $post['name'];
    $kana =  $post['kana'];
    $item_name = $post['item_name'];
    $price = $post['price'];
    $purchase_date =  $post['date'];
    $comment = $post['comment'];
    $shop_id =  $post['shop_id'];

    try{
      $this->dbh->beginTransaction();

      $sql = "UPDATE items SET
      name = :name,
      kana = :kana,
      item_name = :item_name,
      price = :price,
      purchase_date = :purchase_date,
      comment = :comment,
      shop_id = '$shop_id'
      WHERE id = '$id'";
      
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(':name',  $name,  PDO::PARAM_STR);
      $sth->bindParam(':kana',  $kana,  PDO::PARAM_STR);
      $sth->bindParam(':item_name',  $item_name,  PDO::PARAM_STR);
      $sth->bindParam(':price',  $price,  PDO::PARAM_INT);
      $sth->bindParam(':purchase_date',  $purchase_date,  PDO::PARAM_STR);
      $sth->bindParam(':comment',  $comment,  PDO::PARAM_STR);

      $sth->execute();
      $this->dbh->commit();
      return $post;
    }catch(Exception $e){
      $this->dbh->rollBack();
      echo $e->getMessage();
    }

  }
}

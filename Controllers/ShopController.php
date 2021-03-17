<?php
require_once(ROOT_PATH .'/Models/Shop.php');

class ShopController {
  private $shop;

  public function __construct() {
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    $this->shop = new Shop();
  }

  public function shop_all($user_id){
    $result = $this->shop->ShopAll($user_id);
    return $result;
  }

  public function shop_select(){
    $result = $this->shop->ShopSelect($this->request['get']['id']);
    return $result;
  }

  public function get_shop_name($id){
    $result = $this->shop->ShopSelect($id);
    return $result;
  }

  public function create_shop(){
    $result = $this->shop->CreateShop($this->request['post']);
    return $result;
  }

  public function edit_shop(){
    $result = $this->shop->EditShop($this->request['post']);
    return $result;
  }

  public function prefecture($id){
    $result = $this->shop->Prefecture($id);
    return $result;
  }


}
<?php
require_once(ROOT_PATH .'/Models/Item.php');

class ItemController {
  private $Item;
  private $Shop;

  public function __construct() {
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    $this->Item = new Item();
  }

  public function item_all(){
    $result = $this->Item->ItemAll();
    return $result;
  }

  public function search_result_items($input){
    $result = $this->Item->SearchItem($input);
    return $result; 
  }

  public function monthly_sum($input){
    $result = $this->Item->MonthlySum($input);
    return $result; 
  }
  
  public function create_item(){
    $result = $this->Item->CreateItem($this->request['post']);
    return $result;
  }

  public function select_item(){
    $result = $this->Item->SelectItem($this->request['get']['id']);
    return $result;
  }

  public function edit_item(){
    $result = $this->Item->EditItem($this->request['post']);
    return $result;
  }

}

<?php
  require_once(ROOT_PATH .'Controllers/ItemController.php');


  $ITEM = new ItemController;
  $input = $_GET['input'];
  $items = $ITEM->search_result_items($input);

  echo json_encode($items);

  ?>
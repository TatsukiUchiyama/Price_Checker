<?php
  require_once(ROOT_PATH .'Controllers/ItemController.php');

  $ITEM = new ItemController;
  $input = $_GET['data'];
  $items = $ITEM->monthly_sum($input);

  echo json_encode($items);

  ?>
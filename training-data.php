<?php 
$action = $_GET['action']; 

switch ($action) {
  case 'get': 
    get(); 
    break; 
  case 'add': 
    add(); 
    break; 
  default: 
    invalid(); 
}

function get() {
  header('Location: data/training-data.csv'); 
  exit; 
}

function add() {
  $c1 = $_POST['color-1']; 
  $c2 = $_POST['color-2']; 
  $m = $_POST['match']; 

  echo $_GET['color-1']; 

  if (!(isset($c1) && isset($c2) && isset($m))) {
    invalid(); 
  }

  $m === "true" ? $m = "1" : $m = "0"; 

  file_put_contents('data/training-data.csv', "{$c1},{$c2},{$m}\n", FILE_APPEND); 

  exit; 
}

function invalid() {
  echo "Request is invalid. "; 
  exit; 
}
?>

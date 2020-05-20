<?php 
$root = "../"; 

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
  header("Location: {$GLOBALS['root']}data/training-data.csv"); 
  exit; 
}

function add() {
  validate($_POST); 

  $c1 = $_POST['color-1']; 
  $c2 = $_POST['color-2']; 
  $m = $_POST['match']; 

  echo $_GET['color-1']; 

  $m === "true" ? $m = "1" : $m = "0"; 

  file_put_contents("{$GLOBALS['root']}data/training-data.csv", 
          "{$c1},{$c2},{$m}\r\n", 
          FILE_APPEND); 

  exit; 
}

function validate($arr) {
  if (count($arr) !== 3) {
    invalid(); 
  }

  foreach ($arr as $val) {
    if (!isset($val)) {
      invalid(); 
    }
  
    if ($val[0] === "#") {
      validateColor($val); 
    }
    else if (!($val === "true" || $val === "false")) {
      invalid(); 
    }
  }
}

function validateColor($val) {
  $pattern = "/^#[\da-fA-F]{6}$/"; 

  if (!preg_match($pattern, $val)) {
    invalid(); 
  }
}

function invalid() {
  echo "Request is invalid. "; 
  exit; 
}
?>

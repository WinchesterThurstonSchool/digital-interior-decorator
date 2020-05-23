<?php 
$root = "../"; 
$data_path = $root."data/training-data.csv"; 
$init_content = "Color1,Color2,Match\r\n"; 

$action = $_GET["action"]; 

if (!file_exists($data_path)) {
  file_put_contents($data_path, $init_content); 
}

switch ($action) {
  case "get": 
    get($data_path); 
    break; 
  case "add": 
    add($data_path); 
    break; 
  default: 
    invalid(); 
}

function get($path) {
  header("Location: ".$path); 
  exit; 
}

function add($path) {
  validate($_POST); 

  $c1 = $_POST["color-1"]; 
  $c2 = $_POST["color-2"]; 
  $m = $_POST["match"]; 

  echo $_GET["color-1"]; 

  $m === "true" ? $m = "1" : $m = "0"; 

  file_put_contents($path, 
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

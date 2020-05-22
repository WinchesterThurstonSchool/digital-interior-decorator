<?php 
$root = "../"; 

$error_code = $_FILES["image_input"]["error"]; 

// set error_code to 4 when no upload error value 
// (nothing is uploaded) 
// (occurs when user executes this script by using its URL)
if (!isset($error_code)) {
  $error_code = 4; 
}

// check if upload failed
if ($error_code !== 0) {
  // redirect to home page and pass error code
  header("Location: {$root}?error=".$error_code); 
  exit(); 
}

// handle the uploaded image
if (($_FILES["image_input"]["name"] != "")) {
  $target_dir = $root."uploaded/";
  $file = $_FILES["image_input"]["name"];
  $path = pathinfo($file);
  $ext = $path["extension"];

  // return error when file extension is invalid
  if ($ext !== "jpg" && $ext !== "jpeg" && $ext !== "png") {
    header("Location: {$root}?error=-1"); 
    exit; 
  }

  $temp_name = $_FILES["image_input"]["tmp_name"];
  
  do {
    $filename = generateRandomString();
    $path_filename_ext = $target_dir.$filename.".".$ext;
  } while (file_exists($path_filename_ext)); 
  
  // move the uploaded image out of the tempdir and rename the image
  move_uploaded_file($temp_name,$path_filename_ext);
  
  // redirect user to the result page
  header("Location: {$root}processing.html?id=".$filename."&ext=".$ext); 
  exit(); 
}

// fallback redirect
header("Location: {$root}"); 

// generate a random string
function generateRandomString($length = 16) {
  $characters = 
          "0123456789"
          ."abcdefghijklmnopqrstuvwxyz"
          ."ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $charactersLength = strlen($characters);
  $randomString = "";
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
?>

<html lang="en">
  <head>
    <!-- required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Redirecting...</title>
  </head>
  <body>
    Redirecting...
  </body>
</html> 
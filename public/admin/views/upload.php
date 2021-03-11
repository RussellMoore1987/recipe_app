<?php
$target_dir = "../images/original/";
console_log("POST");
console_log($_POST);
console_log("FILES");
console_log($_FILES);
$target_file = "";
$id = "";
$uploadOk = 1;
$imageFileType = "";
if($_POST){
  $target_file = $target_dir . basename($_FILES["recipeImage"]["name"]);
  $id = $_POST["recipeId"];
  
  console_log($imageFileType);
} else {
  console_log("No form posted");
}

if($_FILES){
  $target_file = $target_dir . basename($_FILES["recipeImage"]["name"]);
  console_log($target_file);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  console_log($imageFileType);

}

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["recipeImage"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["recipeImage"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["recipeImage"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
  if ($with_script_tags) {
      $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}
?>
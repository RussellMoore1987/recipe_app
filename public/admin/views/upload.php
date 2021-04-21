<?php
require_once('../../private/classes/SimpleImage.class.php');

$target_dir = "../images/original/";
$target_file = "";
$large_dir = "../images/large/";
$thumb_dir = "../images/thumb/";
$id = "";
$recipe_id = $_POST['recipe_id'];
$image_name = $_FILES["recipe_image"]["name"];
$is_featured = 0;
$sort = 0;
$alt_text = "''";
$image_id = null;
$uploadOk = 1;
$imageFileType = "";

if ($_FILES["recipe_image"]["size"] != 0) {
  $target_file = $target_dir . basename($_FILES["recipe_image"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
} else {
  echo "Hmmm, there doesn't seem to be a file attached<br/>";
  $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file) && $uploadOk != 0) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
  exit();
}

// Check file size
if ($_FILES["recipe_image"]["size"] > 5000000 && $uploadOk != 0) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"  && $uploadOk != 0
) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["recipe_image"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars(basename($_FILES["recipe_image"]["name"])) . " has been uploaded.";
    Image::upsert_recipe_image($recipe_id, $image_name, $sort, $is_featured, $alt_text, $image_id);
    createThumbnail($target_dir, $image_name, $thumb_dir, $large_dir);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

function createThumbnail($filepath, $filename, $thumb_dir, $large_dir)
{
  list($width, $height) = getimagesize($filepath . $filename);
  $new_width = 1280;
  $new_height = 720;
  if($width >= $height){
    $ratio = $new_width / $width;
    $new_height = $height * $ratio;
  } else {
    $ratio = $new_height / $height;
    $new_width = $width * $ratio;
  }
  
  $image = new SimpleImage();
  $image->load($filepath.$filename);
  $image->resize($new_width, $new_height);
  $image->save($thumb_dir.$filename);
  $image->save($large_dir.$filename);
}


function console_log($output, $with_script_tags = true)
{
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
    ');';
  if ($with_script_tags) {
    $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}

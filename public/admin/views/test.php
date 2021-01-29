<?php
  $Post_obj = Post::find_by_id(255);  
  var_dump($Post_obj);
  echo "<br>======================================================================================================<br>";
  
  // $Tag_obj = Tag::find_by_id(25);  
  // var_dump($Tag_obj);
  // echo "<br>======================================================================================================<br>";
  
  // $TagObj_array = Tag::find_where("useTag = 2");
  // var_dump($TagObj_array);
  // echo "<br>======================================================================================================<br>";

  // // get tag object
  // $Tag_obj = Tag::find_by_id(25);
  // // show title
  // echo " <b>Tag Title:</b> {$Tag_obj->title}"; 
  // echo "<br>"; 
  // // Change tag object
  // $Tag_obj->title = $Tag_obj->title == "Jimmy" ? "Sammy": "Jimmy";
  // // save tag object
  // $Tag_obj->save();
  // // show title again
  // echo "<b>Changed Title:</b> {$Tag_obj->title}";
  // echo "<br>======================================================================================================<br>";
  
  // $Post_obj = new Post();
  // $Post_obj->save();
  // // check for errors
  // if ($Post_obj->errors) {
  //   foreach ($Post_obj->errors as $error) {
  //     echo h($error) . "<br>";
  //   }
  // }   
  // // echo "<br>======================================================================================================<br>";

?>
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
  // echo "<br>======================================================================================================<br>";
?>





<?php
  // // # POST
  // if (is_post_request() && isset($_POST["tag"])) {
  //   $Tag_obj = new Tag($_POST["tag"]);
  //   $Tag_obj->save();
  //   if ($Tag_obj->errors) {
  //     foreach ($Tag_obj->errors as $error) {
  //       echo h($error) . "<br>";
  //     }
  //   } 
  //   var_dump($Tag_obj);  
  // }

  // $id = $Tag_obj->id ?? "22"; 

  // // # GET
  // // set defaults
  // $tagId = $_GET["tagId"] ?? "add";
  // // if not add make number
  // if (!($tagId == "add")) {
  //     // this forces the $tagId to be an integer
  //     $tagId = (int) $tagId;
  //     // get tag
  //     $Tag_obj = Tag::find_by_id($tagId);
  // } 
  // $title = $Tag_obj->title ?? "";
  // $note = $Tag_obj->note ?? "";
  // $useTag = $Tag_obj->useTag ?? "";

?>
<!-- <form action="test" method="post">
  <label for="">Title</label>
  <input type="text" name="tag[title]" value="<?php echo $title; ?>">
  <br>
  <br>
  <label for="">Note</label>
  <input type="text" name="tag[note]" value="<?php echo $note; ?>">
  <br>
  <br>
  <label for="">UseTag</label>
  <input type="text" name="tag[useTag]" value="<?php echo $useTag; ?>">
  <br>
  <br>
  <button type="submit">Submit</button>
</form>
Url link: <a href="test?tagId=<?php echo $id; ?>">Get tag with id of <?php echo $id; ?></a>
<br>======================================================================================================<br> -->

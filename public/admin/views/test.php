<?php


// $tables = DevTool::devTool_get_all_non_class_tables('');
// var_dump($tables);

// echo password_hash('test1', PASSWORD_BCRYPT);
// echo '<br><br>';
// echo password_hash('test2', PASSWORD_BCRYPT);
// echo '<br><br>';
// echo password_hash('test', PASSWORD_BCRYPT);

// $Chefs = Chef::find_all();
// var_dump($Chefs);

// $Chef = Chef::find_where("email = 'truthandgoodness87@gmail.com'");
// var_dump($Chef);


//   $Seeder = new Seeder();
//   // get 
//   $recipeId = rand(1, Recipe::count_all());
//   $Image = new Image([
//     'image_name' =>  'image' . $Seeder->id(1) . 'jpg',
//     'sort' => rand(1,10),
//     'is_featured' => rand(0,1),
//     'alt' =>  $Seeder->max_char($Seeder->words(rand(0,10)), 50),
//     'recipe_id' =>  $recipeId
// ]);
//   $Image->save();
//   var_dump($Image);

  // $Images = Image::find_all();
  // var_dump($Images);

  // $Post_obj = Post::find_by_id(255);  
  // var_dump($Post_obj);
  // echo "<br>======================================================================================================<br>";
  
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
<!-- <a href="test">Add New Tag</a>
<br>
<br>
<form method="post" action="test<?php if($tagId != 'add' && $tagId > 0) { echo "?tagId={$tagId}";} ?>">
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
  <input type="hidden" name="tag[id]" value="<?php echo $tagId == "add" ? NULL : $tagId; ?>">
</form>
<br>
Url link: <a href="test?tagId=<?php echo $id; ?>">Get tag with id of <?php echo $id; ?></a>
<br>======================================================================================================<br> -->


<!-- <div class="magic-container">
  <div class="app-container"> 
    <div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
    </div>
  </div>
</div> -->
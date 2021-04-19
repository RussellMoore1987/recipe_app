<?php
    // set page title
    $pageTitle = "Recipe Images";

    // get recipe images
    $id = $_GET['id'];
    $Images = Image::find_all_recipe_images($id);
?>
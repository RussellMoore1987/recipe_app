<?php
    // set page title
    $pageTitle = "Recipe Images";

    // get recipe images
    $Images = Image::find_all_recipe_images(0);
?>
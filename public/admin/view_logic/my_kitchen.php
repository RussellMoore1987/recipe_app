<?php
    // set page title 
    $pageTitle = "My Kitchen";

    // get recipes
        $sqlOptions['columnOptions'] = ['id', 'title', 'total_time', 'description', 'main_image', 'average_rating'];
        $sqlOptions['whereOptions'] = ["is_private = 0", "status = 1"];
        $sqlOptions['sortingOptions'] = "LIMIT 20";
        $Recipes = Recipe::find_where($sqlOptions)
?>

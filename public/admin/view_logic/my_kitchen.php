<?php
    // set page title 
        $pageTitle = "My Kitchen";

    // get recipes
        // TODO: adjust this to only get my (chef) recipes
        $sqlOptions['columnOptions'] = ['id', 'title', 'total_time', 'description', 'main_image', 'average_rating'];
        $sqlOptions['whereOptions'] = ["is_private = 0", "is_published = 1"];
        $sqlOptions['sortingOptions'] = "LIMIT 20";
        $Recipes = Recipe::find_where($sqlOptions);

    // get my favorites
        $Chef = Chef::find_by_id($_SESSION['id']);
        $sqlOptions['columnOptions'] = ['id', 'title', 'description', 'main_image', 'average_rating'];
        $sqlOptions['whereOptions'] = ["is_published = 1"];
        $sqlOptions['sortingOptions'] = "LIMIT 10";
        $MyFavoriteRecipes = $Chef->get_my_favorites($sqlOptions);

    // get top categories
        // reset sqlOptions to we don't get other stuff
        $sqlOptions = [];
        $sqlOptions['whereOptions'] = ["id <= 6"];
        $TopCategories = Category::find_where($sqlOptions);
?>

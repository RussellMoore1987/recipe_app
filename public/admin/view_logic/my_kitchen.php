<?php
    // set page title 
        $pageTitle = "My Kitchen";

    // set filter bar
        $filterBar = true;

    // get recipes
        $sqlOptions['columnOptions'] = ['id', 'title', 'total_time', 'description', 'main_image', 'average_rating'];
        // check to see if her passing in any other parameters via GET/URL
        if (!(isset($_GET['myFavorites']) || isset($_GET['tryLater']))) {
            $sqlOptions['whereOptions'] = ["r.chef_id = {$_SESSION['id']}"];
        } 
        $sqlOptions['sortingOptions'] = ["LIMIT 20"];
        $Recipes = Recipe::recipe_search($sqlOptions);
        
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

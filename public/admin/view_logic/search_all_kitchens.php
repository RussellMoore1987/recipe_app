<?php
    // set page title 
    $pageTitle = "Search";

    // get recipes
        $sqlOptions['columnOptions'] = ['id', 'title', 'total_time', 'description', 'main_image', 'average_rating'];
        // check to see if her passing in any other parameters via GET/URL
        $sqlOptions['sortingOptions'] = ["LIMIT 30"];
        $Recipes = Recipe::recipe_search($sqlOptions);

    // get top categories
        // reset sqlOptions to we don't get other stuff
        $sqlOptions = [];
        $sqlOptions['whereOptions'] = ["id <= 6"];
        $TopCategories = Category::find_where($sqlOptions);

?>
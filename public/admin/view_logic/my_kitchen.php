<?php
    // set page title 
        $pageTitle = "My Kitchen";

    // get recipes
        // TODO: adjust this to only get my (chef) recipes
        // $sqlOptions['columnOptions'] = ['id', 'title', 'total_time', 'description', 'main_image', 'average_rating'];
        // $sqlOptions['whereOptions'] = ["is_private = 0", "is_published = 1"];
        // $sqlOptions['sortingOptions'] = "LIMIT 20";
        // $Recipes = Recipe::find_where($sqlOptions);

        $chefId = 1; // where is this gotten from? Url parsing would be bad here
        $cookTime = [];
        $stars = [];
        $favorites = [];
        $categories = [];
        $tags = [];
        $allergies = [];
        $prepTime = [];
        foreach ($_GET as $param => $value){
            switch ($param):
                case "cookTime":
                    $cookTime = explode(',', $value);
                    break;
                case 'stars':
                    $stars = explode(',', $value);
                    if(count($stars) == 1){
                        $first = substr($stars[0], 0, 1) * 1;
                        $stars = [$first, $first + 1];
                    }
                    break;
                case 'favorites':
                    $favorites = explode(',', $value);
                    break;
                case 'categories':
                    $categories = explode(',', $value);
                    break;
                case 'tags':
                    $tags = explode(',', $value);
                    break;
                case 'allergies':
                    $allergies = explode(',', $value);
                    break;
                case 'prepTime':
                    $prepTime = explode(',', $value);
                    break;
                endswitch;
        } 

        $Recipes = Recipe::recipe_search($chefId, $cookTime, $stars, $favorites, $categories, $tags, $allergies, $prepTime);

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

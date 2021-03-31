<?php

    // todo: clean up echos, var_dumps, and var_dump, to remove it from the function/validation function page
    // @ logic for add_edit_POST.php start
        // set page title
        $pageTitle = "Add/Edit Recipes";

        // set defaults
        $recipeId = $_GET["recipeId"] ?? "add";
        // if not add make number
        if (!($recipeId == "add")) {
            // this forces the $recipeId to be an integer
            $recipeId = (int) $recipeId;
        }




        // # check to see if we have a real ID
            if (!($recipeId == "add")) {
                // this forces the $recipeId to be an integer
                $recipeId = (int) $recipeId;
                // get recipe for editing
                $recipe_obj = recipe::find_by_id($recipeId);
                // error handling, if not there, throw an error
                if (!$recipe_obj) {
                    $recipe_obj = new recipe();
                    $recipe_obj->errors[] = "No recipe with the ID of {$recipeId} exists";
                    $recipeId = "add";
                }
            } else {
                // create empty objects so page does not brake
                $recipe_obj = new recipe();
            }

            if (is_post_request() && isset($_POST["delete"]) && is_int($recipeId) && $recipeId > 0) {
                // delete record
                $recipe_obj->delete();
                // switch categoryId to add
                $recipe_obj = new recipe();
                
                $recipeId = "add";
                $message = $_POST["message"];
            }

            
        // # if post request
            if (is_post_request() && isset($_POST["recipe"]) && !isset($_POST["delete"])) { 
                // if we are in add mode
                if ($recipeId == "add") {
                    $_POST["recipe"]['createdDate'] = date("Y-m-d");
                    // todo: need to replace with session value
                    $_POST["recipe"]['chef_id'] = 1;

                } 

                if (!isset($_POST["recipe"]['is_private'] )) {
                    $_POST["recipe"]['is_private'] = 0;
                }

                $_POST["recipe"]['status'] = 1;
                $_POST["recipe"]['created_date'] = 'NOW';
                $message = $_POST["message"];

                // if imageName is passed through set it
               // if (!is_blank($_POST["recipe"]['main_image'])) {
                //    $_POST["recipe"]['main_image'] = $_POST["recipe"]['possibleImageName'];
                //}
                //echo "recipe info ****************";
                //echo var_dump($_POST["recipe"]['ingredients']);
                //echo var_dump($_POST["recipe"]);

                $_POST["recipe"]['ingredients'] = json_encode($_POST["recipe"]['ingredients']);
                // populate new object
                
                $recipe_obj = new recipe($_POST["recipe"]);
                // echo "recipe_obj info ***********";
                // var_dump($recipe_obj);
                // validate and save
                $recipe_obj->save();
                // set id
                $recipeId = $recipe_obj->id;

                // check to see if we have an ID
                if (!($recipeId === 0 || $recipeId === NULL) && !$recipe_obj->errors) {
                    // get full recipe object
                    $recipe_obj = recipe::find_by_id($recipeId);
                }
                
            }
            $ingredientsList = $recipe_obj->ingredients;
            $newIngredientsList = json_decode($ingredientsList, true);
            if (gettype($newIngredientsList) == "string"){
                $recipe_obj->ingredients = json_decode($newIngredientsList, true);
            }
            else{
                $recipe_obj->ingredients = $newIngredientsList;
            }
            // echo "recipe_obj info ***********";
            // var_dump($recipe_obj);


    // @ logic for add_edit_POST.php END
?>
<?php

    // todo: clean up echos, var_dumps, and var_dump, to remove it from the function/validation function page
    // @ logic for add_edit_POST.php start
        // set page title
        $pageTitle = "Add/Edit Recipes";

        // set defaults
        $recipe_id = $_GET["recipe_id"] ?? "add";
        // if not add make number
        if (!($recipe_id == "add")) {
            // this forces the $recipe_id to be an integer
            $recipe_id = (int) $recipe_id;
        }




        // # check to see if we have a real ID
            if (!($recipe_id == "add")) {
                // this forces the $recipe_id to be an integer
                $recipe_id = (int) $recipe_id;
                // get recipe for editing
                $recipe_obj = recipe::find_by_id($recipe_id);
                // error handling, if not there, throw an error
                if (!$recipe_obj) {
                    $recipe_obj = new recipe();
                    $recipe_obj->errors[] = "No recipe with the ID of {$recipe_id} exists";
                    $recipe_id = "add";
                }
            } else {
                // create empty objects so page does not brake
                $recipe_obj = new recipe();
            }

            if (is_post_request() && isset($_POST["delete"]) && is_int($recipe_id) && $recipe_id > 0) {
                // delete record
                $recipe_obj->delete();
                 // switch categoryId to add
                $recipe_obj = new recipe();
                
                $recipe_id = "add";
                $message = $_POST["message"];
                
            }

            
        // # if post request
            if (is_post_request() && isset($_POST["recipe"]) && !isset($_POST["delete"])) { 
                // if we are in add mode
                if ($recipe_id == "add") {
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
                // populate (new object
                $recipe_obj = new recipe($_POST["recipe"]);
                //echo "recipe_obj info ***********";
                //var_dump($recipe_obj);
                // validate and save
                $recipe_obj->save();
                // set id
                $recipe_id = $recipe_obj->id;
                
                $update_info = array(
                    "id" => $recipe_id,
                    "catIds" => $_POST["recipe"]["catIds"], 
                    "catIdsOld" => $_POST["recipe"]["catIdsOld"],
                    "allergyIds" => $_POST["recipe"]["allergyIds"],
                    "allergyIdsOld" => $_POST["recipe"]["allergyIdsOld"],
                    "tagIds" => $_POST["recipe"]["tagIds"],
                    "tagIdsOld" => $_POST["recipe"]["tagIdsOld"]
                );

                $recipe_obj->class_clean_up_update($update_info);
                $message = $_POST["message"];


                // check to see if we have an ID
                if (!($recipe_id === 0 || $recipe_id === NULL) && !$recipe_obj->errors) {
                    // get full recipe object
                    $recipe_obj = recipe::find_by_id($recipe_id);
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


                // # get all extended info
        $recipeExtendedInfo_array = $recipe_obj->get_extended_info();
        // get recipe categories
        $recipeCategories_array = get_key_value_array($recipeExtendedInfo_array['categories']);
        // echo "recipeCategories_array info ***********";
        // var_dump($recipeCategories_array);
        // get recipe allergies
        $recipeAllergies_array = get_key_value_array($recipeExtendedInfo_array['allergies']);
        // get recipe tags
        $recipeTags_array = get_key_value_array($recipeExtendedInfo_array['tags']);
        // create an array to use later

        // # get post possibilities
        // get all categories
        $possibleCategories_array = Category::get_all_categories();
            // echo "possibleCategories_array info ***********";
            //var_dump($possibleCategories_array);
        // get all allergies
        $possibleAllergies_array = Allergy::get_all_allergies();
        // get all tags
        $possibleTags_array = Tag::get_all_tags();



        // # set some data valus and possible data corrections
        // create logic to set correct list options below
        $catIds = implode(",",array_keys($recipeCategories_array));
        $catIdsOld = implode(",",array_keys($recipeCategories_array));

        $allergyIds = implode(",",array_keys($recipeAllergies_array));
        $allergyIdsOld = implode(",",array_keys($recipeAllergies_array));

        $tagIds = implode(",",array_keys($recipeTags_array));
        $tagIdsOld = implode(",",array_keys($recipeTags_array));


        // if $_POST and error, pass correct info, this is to make sure it their selection does not revert when form does not pass
        if (is_post_request() && isset($_POST["recipe"]) && $recipe_obj->errors) {
            // make array from ids
            $recipeCategories_array = list_to_array($recipe_obj->catIds);
            $recipeAllergies_array = list_to_array($recipe_obj->allergyIds);
            $receipeTags_array = list_to_array($recipe_obj->tagIds);
            // pass in form list data
            $catIds = $recipe_obj->catIds;
            $alleryIds = $recipe_obj->allergyIds;
            $tagIds = $recipe_obj->tagIds;
        };
            

    // @ logic for add_edit_POST.php END
?>
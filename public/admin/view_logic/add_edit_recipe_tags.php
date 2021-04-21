<?php
    // TODO-SHAWN: Do I need???
    // todo: clean up echos, var_dumps, and var_dump, to remove it from the function/validation function page
    // @ logic for add_edit_post.php start
        // set page title
        $pageTitle = "Add/Edit Recipe Tags";

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
            $recipe_obj  = recipe::find_by_id($recipe_id);
            // error handling, if not there, throw an error
            if (!$recipe_obj ) {
                $recipe_obj  = new recipe();
                $recipe_obj ->errors[] = "No recipe with the ID of {$recipe_id} exists";
                $recipe_id = "add";
            }
        } else {
            // create empty objects so page does not brake
            $recipe_obj = new recipe();
        }



            if (is_post_request() && isset($_POST["recipe"]) && !isset($_POST["delete"])) { 
                // set id
                $recipe_obj = new recipe($_POST["recipe"]);
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

            }


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
            }
    // @ logic for add_edit_post.php END
?> 
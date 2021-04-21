<div>
    <div class="error">
        <?php
            // check for errors
            if ($recipe_obj->errors) {
                foreach ($recipe_obj->errors as $error) {
                    echo h($error) . "<br>";
                }
            }   
        ?>
    </div>
    <div >
        <?php
            // check for messages
            if (isset($message)) {
                echo "<span class='message'>{$message}<span>";
            }   
        ?>
    </div>

    <form method="post" action='add_edit_recipe_tags<?php if($recipe_id != 'add' && $recipe_id > 0) { echo "?recipe_id={$recipe_id}";} ?>'>
        <!-- main form -->
        <div>
            <label for="recipe[title]">Recipe Name:</label>
            <!-- maxlength="50" minlength="2" required -->
            <p id="title" name="recipe[title]" ><?php echo $recipe_obj->title ?> </p>
        </div>
        <br>

        <div>
            <label for="recipe[catIds]">Recipe Categories</label>
            <div class="multiSelect">        
                <?php
                    // showing possible categories as well as selected categories
                    foreach ($possibleCategories_array as $key => $value) {
                        // set default selected value
                        $active = "";
                        // check to see if the post has any categories attached to it
                        if (isset($recipeCategories_array[$key])) {
                            $active = "active";
                        }
                        echo "<span id='{$key}' class='{$active}'>{$value}</span>";
                    }

                ?>
                <input type="hidden" name="recipe[catIds]" value="<?php echo $catIds;?>">
            </div>
            <!-- old list to compare -->
            <input type="hidden" name="recipe[catIdsOld]" value="<?php echo $catIdsOld; ?>">
        </div>
        <br>

        <div>
            <label for="recipe[tagIds]">Recipe Tags</label>
            <div class="multiSelect">        
                <?php
                    // showing possible tags as well as selected tags
                    foreach ($possibleTags_array as $key => $value) {
                        // set default selected value
                        $active = "";
                        // check to see if the post has any tags attached to it
                        if (isset($recipeTags_array[$key])) {
                            $active = "active";
                        }
                        echo "<span id='{$key}' class='{$active}'>{$value}</span>";
                    }
                ?>
                <input type="hidden" name="recipe[tagIds]" value="<?php echo $tagIds; ?>">
            </div>
            <!-- old list to compare -->
            <input type="hidden" name="recipe[tagIdsOld]" value="<?php echo $tagIdsOld; ?>">
        </div>
        <br>

        <div>
            <label for="recipe[allergyIds]">Recipe Allergy Tags</label>
            <div class="multiSelect">        
                <?php
                    // showing possible labels as well as selected labels
                    foreach ($possibleAllergies_array as $key => $value) {
                        // set default selected value
                        $active = "";
                        // check to see if the post has any labels attached to it
                        if (isset($recipeAllergies_array[$key])) {
                            $active = "active";
                        }
                        echo "<span id='{$key}' class='{$active}'>{$value}</span>";
                    }
                ?>
                <!-- get list -->
                <input type="hidden" name="recipe[allergyIds]" value="<?php echo $allergyIds;  ?>">
            </div>
            <!-- old list to compare -->
            <input type="hidden" name="recipe[allergyIdsOld]" value="<?php echo $allergyIdsOld; ?>">
        </div>
        <br>

        <!-- hidden form fields -->
        <input type="hidden" name="recipe[id]" value="<?php echo $recipe_id == "add" ? NULL : $recipe_id; ?>">
        <input type="hidden" name="message" value="The recipe tags have been updated.">


        <!-- submit button -->
        <div>
            <button type="submit">Update Recipe Tags</button>
            <a class="nav_button" href="view_recipe?recipe_id=<?php echo $recipe_id; ?>">Go Back</a>
        </div>
    </form>
</div> 
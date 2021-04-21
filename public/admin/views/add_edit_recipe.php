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
    <div>
        <a href='add_edit_recipe'>Add New Recipe</a>
    </div>
    <form id="main_form" method="post" action='add_edit_recipe<?php if($recipeId != 'add' && $recipeId > 0) { echo "?recipeId={$recipeId}";} ?>'>
        <!-- main form -->
        <div>
            <label for="recipe[title]">Recipe Title</label>
            <!-- maxlength="50" minlength="2" required -->
            <input id="title" type="text" name="recipe[title]" value="<?php echo $recipe_obj->title ?>" >
        </div>
        <br>
        <div>
            <label for="recipe[description]">Recipe Description</label>
            <!-- maxlength="250" minlength="0" -->
            <input id="description" type="text" name="recipe[description]" value="<?php echo $recipe_obj->description ?>" >
        </div>
        <br>
        <div>
            <label for="recipe[prep_time]">Recipe Prep Time</label>
            <!-- maxlength="250" minlength="0"  -->
            <input id="prep_time" type="number" name="recipe[prep_time]" value="<?php echo $recipe_obj->prep_time ?>" >
        </div>
        <br>
        <div>
            <label for="recipe[cook_time]">Recipe Cook Time</label>
            <!-- maxlength="250" minlength="0"  -->
            <input id="cook_time" type="number" name="recipe[cook_time]" value="<?php echo $recipe_obj->cook_time ?>" >
        </div>
        <br>
        <div>
            <label for="recipe[total_time]">Recipe Total Time</label>
            <!-- maxlength="250" minlength="0"  -->
            <input id="total_time" type="number" name="recipe[total_time]" value="<?php echo $recipe_obj->total_time ?>" >
        </div>
        <br>
        <div>
            <label for="recipe[num_serving]">Number of Servings</label>
            <!-- maxlength="3" minlength="0" -->
            <input id="recipe_num_serving" type="number" name="recipe[num_serving]" value="<?php echo $recipe_obj->num_serving ?>" >
        </div>
        <br>
        <div>
            <label for="recipe[is_private]">Private?</label>
            <!-- maxlength="3" minlength="0" -->
            <input id="recipe_is_private" type="checkbox" name="recipe[is_private]" <?php if($recipe_obj->is_private == '1'){ echo "checked";}  ?> >
        </div>
        <br>

        <div>
            <label for="recipe_ingredient_table">Ingredients (Amount, unit, ingredient)</label>
            <table id="recipe_ingredient_table" name="recipe_ingredient_table">
                <tr>
                    <th>Whole Amount</th>
                    <th>Partial Amount</th>
                    <th>Unit</th>
                    <th>Ingredient</th>
                </tr>
                <?php if(isset($recipe_obj->ingredients)):
                    foreach( $recipe_obj->ingredients as $ingredient):
                ?>
                <tr>
                    <td><input class="ingredient" name="ingredient_whole_amount" id="ingredient_whole_amount" type="number" value=<?php echo $ingredient['ingredient_whole_amount']?>></td>
                    <td><select class="ingredient" name="ingredient_partial_amount" id="ingredient_partial_amount" >
                        <option value=0.0 <?php if((float)$ingredient['ingredient_partial_amount'] == 0.0){echo "selected";}?>>(none)</option>
                        <option value=0.125 <?php if((float)$ingredient['ingredient_partial_amount'] == 0.125){echo "selected";}?>>1/8</option>
                        <option value=0.25 <?php if((float)$ingredient['ingredient_partial_amount'] == 0.25){echo "selected";}?>>1/4</option>
                        <option value=0.33 <?php if((float)$ingredient['ingredient_partial_amount'] == 0.33){echo "selected";}?>>1/3</option>                          
                        <option value=0.5 <?php if((float)$ingredient['ingredient_partial_amount'] == 0.5){echo "selected";}?>>1/2</option>
                        <option value=0.625 <?php if((float)$ingredient['ingredient_partial_amount'] == 0.625){echo "selected";}?>>5/8</option>
                        <option value=0.667 <?php if((float)$ingredient['ingredient_partial_amount'] == 0.667){echo "selected";}?>>2/3</option>
                        <option value=0.75 <?php if((float)$ingredient['ingredient_partial_amount'] == 0.75){echo "selected";}?>>3/4</option>
                        <option value=0.875 <?php if((float)$ingredient['ingredient_partial_amount'] == 0.875){echo "selected";}?>>7/8</option>
                    </select>
                    </td>
                    <td><select class="ingredient" name="ingredient_unit" id="ingredient_unit" value=<?php echo $ingredient['ingredient_unit']?>>
                        <option value="pinch" <?php if($ingredient['ingredient_unit'] == "pinch"){echo "selected";}?>>Pinch</option>
                        <option value="teaspoons" <?php if($ingredient['ingredient_unit'] == "teaspoons"){echo "selected";}?>>Teaspoon(s)</option>
                        <option value="tablespoons" <?php if($ingredient['ingredient_unit'] == "tablespoons"){echo "selected";}?>>Tablespoon(s)</option>                          
                        <option value="cups" <?php if($ingredient['ingredient_unit'] == "cups"){echo "selected";}?>>Cup(s)</option>
                        <option value="ounces" <?php if($ingredient['ingredient_unit'] == "ounces"){echo "selected";}?>>Ounce(s)</option>
                        <option value="quarts" <?php if($ingredient['ingredient_unit'] == "quarts"){echo "selected";}?>>Quart(s)</option>
                        <option value="pounds" <?php if($ingredient['ingredient_unit'] == "pounds"){echo "selected";}?>>Pound(s)</option>
                        <option value="count" <?php if($ingredient['ingredient_unit'] == "count"){echo "selected";}?>>Count</option>
                    </select>
                    </td>
                    <td><input class="ingredient" name="ingredient" id="ingredient" type="text" value=<?php echo $ingredient['ingredient']?>></td>
                    <td><button type="button" class="del_button">Remove</button></td>
                </tr>
                <?php 
                    endforeach;
                    endif; ?>
            </table>
            <button id="add_button" type="button">Add Ingredient</button>
        </div>
        <br>

        <br>
        <div>
            <label for="recipe[directions]">Directions</label>
            <!-- maxlength="3" minlength="0" -->
            <textarea id="recipe_directions" name="recipe[directions]" cols="30" rows="10" ><?php echo $recipe_obj->directions ?></textarea>
        </div>
        <br>


    <!-- <div>
            <label for="recipe[created_date]">Created Date</label>
            required 
            <input type="date" name="recipe[created_date]" value="" >
    </div> -->
    <br>


        <!-- hidden form fields -->
        <input type="hidden" id="recipe_ingredients" name="recipe[ingredients]">
        <input type="hidden" name="recipe[id]" value="<?php echo $recipeId == "add" ? NULL : $recipeId; ?>">
        <input type="hidden" name="recipe[chef_id]" value="<?php echo $recipe_obj->chef_id ?? $addUserDefault ?? "";?>">
        <input type="hidden" name="recipe[main_image]" value="<?php echo $recipe_obj->main_image;?>">
        <input type="hidden" name="recipe[average_rating]" value="<?php echo $recipe_obj->average_rating ?? 0;?>">
        <input type="hidden" name="recipe[is_published]" value="<?php echo $recipe_obj->is_published ?? 1;?>">
        <input type="hidden" name="message" value="The recipe has been updated.">

        <!-- submit button -->
        <div>
            <button type="submit" id="submit_button"><?php echo $recipeId == "add" ? "Add" : "Edit"; ?> Recipe</button>
            <?php 
                if($recipeId != "add"){ ?>
                    <button type="button" id="images_button" onClick="location.href='recipe_images?recipe_id=<?php echo $recipeId ?>'"> Manage Images</button>
            <?php
                }
            ?>
        </div>
        <!-- <div>
            <button type="button" id="update_button">Update</button>
        </div> -->
    </form>
    <form id="main_form" method="post" action='add_edit_recipe'>
    
    <div>
        <input type="hidden" name="delete">
        <input type="hidden" name="message" value="The recipe has been deleted.">
        <?php if($recipeId != 'add' && $recipeId > 0): ?>
        <button type="submit" id="delete_button" name=delete>Delete</button>
        <?php endif;?>
        <a class="nav_button" href="view_recipe?recipe_id=<?php echo $recipeId; ?>">Go Back</a>
    </div>

</div>

<!-- <div>
    <form id="test_form" method="get" action='add_edit_recipe'>
            <input type="text" name=recipeId>
            <button type="submit" id="test_submit_button">Test GET</button>
    </form>
</div> -->
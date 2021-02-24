<?php
    $recipeCount = Recipe::count_all();
    $Recipes = Recipe::find_where('is_private = 0 AND status = 1');
    var_dump($recipeCount);
    var_dump(count($Recipes));
    var_dump($Recipes);
?>
<?php
    // set page title 
    $pageTitle = "View Recipe";
    $noHeader = 'no-header';

    $Recipe = NULL;
    // get id
    if (isset($_GET['recipe_id'])) {
        $id = (int) $_GET['recipe_id'];
        // get recipe
        $Recipe = Recipe::find_by_id($id); 
    }
?>
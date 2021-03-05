<?php
    // check to see if page title was sent
    $pageTitle = $pageTitle ?? "Default Page";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- set page title -->
    <title><?php echo $pageTitle; ?></title>
    <!-- main styles -->
    <link rel="stylesheet" href="<?php echo PUBLIC_LINK_PATH . "/admin/css/style.css?{$assetVersion}"; ?>">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/58867e1c02.js" crossorigin="anonymous"></script>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,700&display=swap" rel="stylesheet">
    <!-- // TODO: set favicon -->
    <!-- <link rel="apple-touch-icon" href="logo192.png" /> -->
    <?php
        // todo list
            // set favicon
            // pull in custom CSS
    ?>
</head>

<body class="flex-center-horizontal">
    <!-- // # Outer Wrapper Start -->
    <div class="outer-wrapper">

        <!-- // # Nav Start, with the structure of the page it is best to have navigation here -->
            <!-- bottom bar, putting it here helps to load first -->
            <nav class="bottom-bar-menu flex-sb">
                <a href="my_kitchen">My Kitchen</a>
                <a href="search_all_kitchens">Search</a>
                <div class="chef-add">
                    <a class="">
                        Add
                        <div class="chef-add-menu">
                            <a href="add_edit_allergy">Add Allergy</a>
                            <a href="add_edit_chef">Add Chef</a>
                            <a href="add_edit_category">Add Category</a>
                            <a href="add_edit_tag">Add Tag</a>
                            <a href="add_edit_cookbook">Add Cookbook</a>
                            <a href="add_edit_recipe">Add Recipe</a>
                        </div>
                    </a>
                </div>
                <a href="my_Profile">My Profile</a>
            </nav>
            <!-- side bar -->
            <nav class="side-bar-menu">
                <a href="my_Profile">My Profile</a>
                <a href="my_kitchen">My Kitchen</a>
                <a href="my_kitchen?filter=favorites">My Favorites</a>
                <a href="my_kitchen?filter=tryLater">Try Later List</a>
                <a href="search_all_kitchens">Search All Kitchens</a>
                <a href="my_Profile">Manage My Recipes</a>
                <a href="my_Profile?filter=cookbooks">Manage My Cookbooks</a>
                <a href="manage_categories">Manage Categories</a>
                <a href="manage_tags">Manage Tags</a>
                <a href="manage_allergies">Manage Allergies</a>
                <a href="manage_chefs">Manage My Chefs</a>
                <a href="<?php echo PUBLIC_LINK_PATH . '/login.php?logout=yes' ?>">Logout</a>

                <a href="my_kitchen">Use As App</a>
                <a href="my_kitchen">About This App</a>
            </nav>
            <!-- side bar menu helpers -->
            <div class="side-bar-menu-icon">
                <i class="fal fa-bars"></i>
            </div>
            <div class="side-bar-modal"></div>
        <!-- // # Nav End -->
        
        <!-- // # Container Start -->
        <div class="container">

    

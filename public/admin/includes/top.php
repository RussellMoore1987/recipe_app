<?php
    // check to see if page title was sent
    $pageTitle = $pageTitle ?? "Default Page";

    $noHeader = $noHeader ?? '';

    // some variables to help theme pages
    $appIcon = IMAGE_LINK_PATH . "/original/{$_SESSION['appIcon']}";
    $headerLogo = IMAGE_LINK_PATH . "/original/{$_SESSION['headerLogo']}";
    $themeColor = $_SESSION['themeColor'];
    $imagePath = IMAGE_LINK_PATH . "/original/";
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
    <!-- // TODO-CI: set favicon -->
    <link rel="apple-touch-icon" href="<?php echo $appIcon; ?>" />
    <link rel="icon" href="<?php echo $appIcon; ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo $appIcon; ?>" type="image/x-icon"> 
    <style>
        :root {
            --theme-color: <?php echo $themeColor ?>;
        }
    </style>
    <?php
        // todo list
            // pull in custom CSS
    ?>
</head>

<body class="flex-center-horizontal">
    <!-- // # Outer Wrapper Start -->
    <div class="outer-wrapper">

        <!-- // # Nav Start, with the structure of the page it is best to have navigation here -->
            <!-- header -->
            <?php if (strlen($noHeader) == 0) {?>
                <header>
                    <div>
                        <a href="my_kitchen">
                            <img class="logo" src="<?php echo $headerLogo; ?>" alt="Main Logo ">
                        </a>
                    </div>
                </header>
            <?php } ?>

            <!-- bottom bar, putting it here helps to load first -->
            <nav class="bottom-bar-menu flex-sb">
                <?php Component::bottom_bar_icon_component('my-kitchen', $pageTitle) ?>
                <?php Component::bottom_bar_icon_component('search', $pageTitle) ?>
                <?php Component::bottom_bar_icon_component('add', $pageTitle) ?>
                <?php Component::bottom_bar_icon_component('my-profile', $pageTitle) ?>
            </nav>
            <!-- side bar -->
            <nav class="side-bar-menu">
               <div>
                    <?php Component::sidebar_icon_component('my-profile', $pageTitle) ?>  
                    <?php Component::sidebar_icon_component('my-kitchen', $pageTitle) ?>  
                    <?php Component::sidebar_icon_component('my-favorites', $pageTitle) ?>  
                    <?php Component::sidebar_icon_component('try-later', $pageTitle) ?>  
                    <?php Component::sidebar_icon_component('search', $pageTitle) ?>  
                    <?php Component::sidebar_icon_component('my-recipes', $pageTitle) ?>  
                    <?php Component::sidebar_icon_component('my-cookbooks', $pageTitle) ?>  
                    <?php Component::sidebar_icon_component('manage-categories', $pageTitle) ?>
                    <?php Component::sidebar_icon_component('manage-tags', $pageTitle) ?>
                    <?php Component::sidebar_icon_component('manage-allergies', $pageTitle) ?>
                    <?php Component::sidebar_icon_component('manage-chefs', $pageTitle) ?>
                    <?php Component::sidebar_icon_component('logout') ?>
               </div>
                <div>
                    <?php Component::sidebar_icon_component('use-app') ?>
                    <?php Component::sidebar_icon_component('about') ?>
                </div>
            </nav>
            <!-- side bar menu helpers -->
            <?php if (strlen($noHeader) == 0) {?>
                <div class="side-bar-menu-icon">
                    <div class="menu-icon-container">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.03 24.6" class="menu-icon">
                            <title>Menu Icon</title>
                            <g id="Layer_2" data-name="Layer 2">
                                <g id="Layer_1-2" data-name="Layer 1">
                                    <path class="cls-1 path" d="M1,5.2H25s6,.25,7-3.75-22,6-31,10"/>
                                    <path class="cls-1 path" d="M1,18.93H25s6-.25,7,3.75-22-6-31-10"/>
                                    <line class="cls-1 main" x1="1" y1="11.93" x2="25" y2="11.93"/>
                                </g>
                            </g>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="side-bar-modal"></div>
            <?php } ?>
        <!-- // # Nav End -->
        
        <!-- // # App Container Start -->
        <div class="app-container <?php echo $noHeader; ?>">

    

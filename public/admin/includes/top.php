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
                
        <!-- side bar filter -->
        <?php 
            $filterBar = $filterBar ?? false;
            if ($filterBar) { 
        ?>
            <!-- // TODO: Component::sidebar_filter_component(link) -->
            <!-- // TODO: re-factor the filtering process -->
            <!-- Component::sidebar_filter_component(link) -->
            <!-- query logic -->
            <?php 
                // do we have any parameters
                // TODO: add in later 'searchBy'
                $filterParametersPossible = ['sortBy', 'cookTime', 'stars', 'myFavorites', 'tryLater', 'categories', 'tags', 'allergies', 'prepTime', 'totalTime'];
                $filterParameterCount = 0;
                foreach ($filterParametersPossible as $filterParameter) {
                    if(isset($_GET[$filterParameter])) {
                        $filterActive = 'active';
                        $filterParameterCount++;
                        // form helper
                        $formHelper[$filterParameter] = $_GET[$filterParameter];
                    } else {
                        // form helper
                        $formHelper[$filterParameter] = '';
                    }
                }
            ?>
            <?php $Categories = Category::find_all(); ?>
            <?php $Tags = Tag::find_all(); ?>
            <?php $Allergies = Allergy::find_all(); ?>

            <div class="side-bar-filter" data-link="<?php echo PUBLIC_LINK_PATH . "/admin/{$filterBar}" ?>"> 
                <form id="filterForm" action="">
                    <div class="layout-container">
                        <div class="flex-sb filter-options">
                            <i class="fal fa-redo"></i>
                            <h2>Search Filter</h2>
                            <i class="fal fa-long-arrow-right"></i>
                        </div>
                        <!-- // # sort by -->
                        <div class="filter-set">
                            <h3>Sort By</h3>
                            <div>
                                <div class="sort-by-item">
                                    <div>
                                        <input type="checkbox" id="orderBy1" name="title" value="1" 
                                            <?php echo contains($formHelper['sortBy'], 'title') ? 'checked' : ''?>
                                        >
                                        <label for="orderBy1">Recipe Title</label>
                                    </div>
                                    <i class="fal sort-icon 
                                        <?php 
                                            if (contains($formHelper['sortBy'], 'title::highToLow')) {
                                                echo 'fa-sort-alpha-down-alt';
                                            } else {
                                                echo 'fa-sort-alpha-down';
                                            }
                                        ?>
                                        <?php echo contains($formHelper['sortBy'], 'title') ? '' : 'hide-o'?>
                                    ">
                                    </i>
                                </div>
                                <div class="sort-by-item">
                                    <div>
                                        <!-- // TODO: two form elements name stars, fix that -->
                                        <input type="checkbox" id="orderBy2" name="stars" value="1"
                                            <?php echo contains($formHelper['sortBy'], 'stars') ? 'checked' : ''?>
                                        >
                                        <label for="orderBy2">Stars</label>
                                    </div>
                                    <i class="fal sort-icon 
                                        <?php 
                                            if (contains($formHelper['sortBy'], 'stars') && !contains($formHelper['sortBy'], 'stars::highToLow')) {
                                                echo 'fa-sort-numeric-down';
                                            } else {
                                                echo 'fa-sort-numeric-down-alt';
                                            }
                                        ?>
                                        <?php echo contains($formHelper['sortBy'], 'stars') ? '' : 'hide-o'?>
                                    ">
                                    </i>
                                </div>
                                <div class="sort-by-item">
                                    <div>
                                        <input type="checkbox" id="orderBy3" name="prepTime" value="1"
                                            <?php echo contains($formHelper['sortBy'], 'prepTime') ? 'checked' : ''?>
                                        >
                                        <label for="orderBy3">Prep Time</label>
                                    </div>
                                    <i class="fal sort-icon 
                                        <?php 
                                            if (contains($formHelper['sortBy'], 'prepTime::highToLow')) {
                                                echo 'fa-sort-numeric-down-alt';
                                            } else {
                                                echo 'fa-sort-numeric-down';
                                            }
                                        ?>
                                        <?php echo contains($formHelper['sortBy'], 'prepTime') ? '' : 'hide-o'?>
                                    ">
                                    </i>
                                </div>
                                <div class="sort-by-item">
                                    <div>
                                        <input type="checkbox" id="orderBy4" name="cookTime" value="1"
                                            <?php echo contains($formHelper['sortBy'], 'cookTime') ? 'checked' : ''?>
                                        >
                                        <label for="orderBy4">Cook Time</label>
                                    </div>
                                    <i class="fal sort-icon 
                                        <?php 
                                            if (contains($formHelper['sortBy'], 'cookTime::highToLow')) {
                                                echo 'fa-sort-numeric-down-alt';
                                            } else {
                                                echo 'fa-sort-numeric-down';
                                            }
                                        ?>
                                        <?php echo contains($formHelper['sortBy'], 'cookTime') ? '' : 'hide-o'?>
                                    ">
                                    </i>
                                </div>
                                <div class="sort-by-item">
                                    <div>
                                        <input type="checkbox" id="orderBy5" name="totalTime" value="1"
                                            <?php echo contains($formHelper['sortBy'], 'totalTime') ? 'checked' : ''?>
                                        >
                                        <label for="orderBy5">Total Time</label>
                                    </div>
                                    <i class="fal sort-icon 
                                        <?php 
                                            if (contains($formHelper['sortBy'], 'totalTime::highToLow')) {
                                                echo 'fa-sort-numeric-down-alt';
                                            } else {
                                                echo 'fa-sort-numeric-down';
                                            }
                                        ?>
                                        <?php echo contains($formHelper['sortBy'], 'totalTime') ? '' : 'hide-o'?>
                                    ">
                                    </i>
                                </div>
                            </div>
                        </div>
                        <!-- // # filter by stars -->
                        <div class="filter-set">
                            <h3>Stars</h3>
                            <div class="filter-by-stars">
                                <?php
                                    if ($formHelper['stars'] == '') {
                                        $starCount = 0;
                                    } else {
                                        $starCount = (int) $formHelper['stars'];
                                    }
                                    for ($i=0; $i < 5; $i++) {
                                        $active = $i + 1 <= $starCount ? ' default-color' : '';
                                        $starNum = $i + 1;
                                        echo "
                                            <i class=\"fal fa-star{$active}\" data-stars=\"{$starNum}\"></i>
                                        ";
                                    }
                                ?>
                                <input type="hidden" name="stars" value="<?php echo $starCount ?>">
                            </div>
                        </div>
                    </div>
                    <!-- // # filter categories -->
                    <div class="filter-set">
                        <div class="layout-container">
                            <div class="flex-sb">
                                <h3>
                                    Categories 
                                    <sup class="id-collector-count">
                                        <?php 
                                            // get all IDs
                                            $categoryIds = explode(',', $formHelper['categories']);
                                            $categoryIdCount = $categoryIds[0] == '' ? '' : count($categoryIds);
                                            echo $categoryIdCount; 
                                        ?>
                                    </sup>
                                </h3>
                                <i class="fal fa-search search-icon-btn" data-target="filter-categories"></i>
                            </div>
                        </div>
                        <div>
                            <div class="slider-container" id="filter-categories">
                                <div class="filter-bubbles-container">
                                    <input type="text" class="filter-search hide-so" value="" placeholder="Filter Categories" maxlength="35">
                                </div>
                                <?php 
                                    // determining whether or not to show two rows
                                    if (count($Categories) > 10) { 
                                        $categoryCountHalfWay = floor(count($Categories) / 2);
                                ?>
                                    <div class="double-slider">
                                        <div class="slider">
                                            <?php 
                                                for ($i=0; $i < $categoryCountHalfWay; $i++) { 
                                                    $Category = $Categories[$i];
                                                    $id = $Category->id;
                                                    $name = $Category->name;
                                                    $active = in_array($id, $categoryIds) ? 'default-bg-color' : '';
                                                    echo "
                                                        <div class=\"bubble-container\" data-filtertext=\"{$name}\">
                                                            <span class=\"bubble\" >
                                                                <span class=\"inner-bubble {$active}\" data-id=\"{$id}\">{$name}</span>
                                                            </span>
                                                        </div>
                                                    ";
                                                }
                                                // to help with spacing when just a few bubbles are there
                                                for ($i=0; $i < 8; $i++) {echo "<div class=\"bubble-spacer\"></div>";}
                                            ?>
                                        </div>
                                        <div class="slider">
                                            <?php 
                                                for ($i=$categoryCountHalfWay; $i < count($Categories); $i++) { 
                                                    $Category = $Categories[$i];
                                                    $id = $Category->id;
                                                    $name = $Category->name;
                                                    $active = in_array($id, $categoryIds) ? 'default-bg-color' : '';
                                                    echo "
                                                        <div class=\"bubble-container\" data-filtertext=\"{$name}\">
                                                            <span class=\"bubble\" >
                                                                <span class=\"inner-bubble {$active}\" data-id=\"{$id}\">{$name}</span>
                                                            </span>
                                                        </div>
                                                    ";
                                                }
                                                // to help with spacing when just a few bubbles are there
                                                for ($i=0; $i < 8; $i++) {echo "<div class=\"bubble-spacer\"></div>";}
                                            ?>
                                        </div>
                                    </div>
                                <?php } else { /* TODO: test with less then 10 */ ?>
                                    <div class="slider">
                                        <?php 
                                            foreach ($Categories as $Category) {
                                                $id = $Category->id;
                                                $name = $Category->name;
                                                $active = in_array($id, $categoryIds) ? 'default-bg-color' : '';
                                                echo "
                                                    <div class=\"bubble-container\" data-filtertext=\"{$name}\">
                                                        <span class=\"bubble\" >
                                                            <span class=\"inner-bubble {$active}\" data-id=\"{$id}\">{$name}</span>
                                                        </span>
                                                    </div>
                                                ";
                                            }
                                            // to help with spacing when just a few bubbles are there
                                            for ($i=0; $i < 8; $i++) {echo "<div class=\"bubble-spacer\"></div>";}
                                        ?>
                                    </div>
                                <?php } ?>
                                <input type="hidden" class="id-collector" name="categories" value="<?php echo $formHelper['categories'] ; ?>">
                            </div>
                        </div>
                    </div>
                    <!-- // # filter tags -->
                    <div class="filter-set">
                        <div class="layout-container">
                            <div class="flex-sb">
                                <h3>
                                    Tags 
                                    <sup class="id-collector-count">
                                        <?php 
                                            // get all IDs
                                            $tagIds = explode(',', $formHelper['tags']);
                                            $tagIdCount = $tagIds[0] == '' ? '' : count($tagIds);
                                            echo $tagIdCount; 
                                        ?>
                                    </sup>
                                </h3>
                                <i class="fal fa-search search-icon-btn" data-target="filter-tags"></i>
                            </div>
                        </div>
                        <div>
                            <div class="slider-container" id="filter-tags">
                                <div class="filter-bubbles-container">
                                    <input type="text" class="filter-search hide-so" value="" placeholder="Filter Tags" maxlength="35">
                                </div>
                                <?php 
                                    // determining whether or not to show two rows
                                    if (count($Tags) > 10) { 
                                        $tagCountHalfWay = floor(count($Tags) / 2);
                                ?>
                                    <div class="double-slider">
                                        <div class="slider">
                                            <?php 
                                                for ($i=0; $i < $tagCountHalfWay; $i++) { 
                                                    $Tag = $Tags[$i];
                                                    $id = $Tag->id;
                                                    $name = $Tag->name;
                                                    $active = in_array($id, $tagIds) ? 'default-bg-color' : '';
                                                    echo "
                                                        <div class=\"bubble-container\" data-filtertext=\"{$name}\">
                                                            <span class=\"bubble\" >
                                                                <span class=\"inner-bubble {$active}\" data-id=\"{$id}\">{$name}</span>
                                                            </span>
                                                        </div>
                                                    ";
                                                }
                                                // to help with spacing when just a few bubbles are there
                                                for ($i=0; $i < 8; $i++) {echo "<div class=\"bubble-spacer\"></div>";}
                                            ?>
                                        </div>
                                        <div class="slider">
                                            <?php 
                                                for ($i=$tagCountHalfWay; $i < count($Tags); $i++) { 
                                                    $Tag = $Tags[$i];
                                                    $id = $Tag->id;
                                                    $name = $Tag->name;
                                                    $active = in_array($id, $tagIds) ? 'default-bg-color' : '';
                                                    echo "
                                                        <div class=\"bubble-container\" data-filtertext=\"{$name}\">
                                                            <span class=\"bubble\" >
                                                                <span class=\"inner-bubble {$active}\" data-id=\"{$id}\">{$name}</span>
                                                            </span>
                                                        </div>
                                                    ";
                                                }
                                                // to help with spacing when just a few bubbles are there
                                                for ($i=0; $i < 8; $i++) {echo "<div class=\"bubble-spacer\"></div>";}
                                            ?>
                                        </div>
                                    </div>
                                <?php } else { /* TODO: test with less then 10 */ ?>
                                    <div class="slider">
                                        <?php 
                                            foreach ($Tags as $Tag) {
                                                $id = $Tag->id;
                                                $name = $Tag->name;
                                                $active = in_array($id, $tagIds) ? 'default-bg-color' : '';
                                                echo "
                                                    <div class=\"bubble-container\" data-filtertext=\"{$name}\">
                                                        <span class=\"bubble\" >
                                                            <span class=\"inner-bubble {$active}\" data-id=\"{$id}\">{$name}</span>
                                                        </span>
                                                    </div>
                                                ";
                                            }
                                            // to help with spacing when just a few bubbles are there
                                            for ($i=0; $i < 8; $i++) {echo "<div class=\"bubble-spacer\"></div>";}
                                        ?>
                                    </div>
                                <?php } ?>
                                <input type="hidden" class="id-collector" name="tags" value="<?php echo $formHelper['tags'] ; ?>">
                            </div>
                        </div>
                    </div>
                    <!-- // # filter Allergies -->
                    <div class="filter-set">
                        <div class="layout-container">
                            <div class="flex-sb">
                                <h3>
                                    Allergies 
                                    <sup class="id-collector-count">
                                        <?php 
                                            // get all IDs
                                            $allergyIds = explode(',', $formHelper['allergies']);
                                            $allergyIdCount = $allergyIds[0] == '' ? '' : count($allergyIds);
                                            echo $allergyIdCount; 
                                        ?>
                                    </sup>
                                </h3>
                                <i class="fal fa-search search-icon-btn" data-target="filter-allergies"></i>
                            </div>
                        </div>
                        <div>
                            <div class="slider-container" id="filter-allergies">
                                <div class="filter-bubbles-container">
                                    <input type="text" class="filter-search hide-so" value="" placeholder="Filter Allergies" maxlength="35">
                                </div>
                                <?php 
                                    // determining whether or not to show two rows
                                    if (count($Allergies) > 10) { 
                                        $allergyCountHalfWay = floor(count($Allergies) / 2);
                                ?>
                                    <div class="double-slider">
                                        <div class="slider">
                                            <?php 
                                                for ($i=0; $i < $allergyCountHalfWay; $i++) { 
                                                    $Allergy = $Allergies[$i];
                                                    $id = $Allergy->id;
                                                    $name = $Allergy->name;
                                                    $active = in_array($id, $allergyIds) ? 'default-bg-color' : '';
                                                    echo "
                                                        <div class=\"bubble-container\" data-filtertext=\"{$name}\">
                                                            <span class=\"bubble\" >
                                                                <span class=\"inner-bubble {$active}\" data-id=\"{$id}\">{$name}</span>
                                                            </span>
                                                        </div>
                                                    ";
                                                }
                                                // to help with spacing when just a few bubbles are there
                                                for ($i=0; $i < 8; $i++) {echo "<div class=\"bubble-spacer\"></div>";}
                                            ?>
                                        </div>
                                        <div class="slider">
                                            <?php 
                                                for ($i=$allergyCountHalfWay; $i < count($Allergies); $i++) { 
                                                    $Allergy = $Allergies[$i];
                                                    $id = $Allergy->id;
                                                    $name = $Allergy->name;
                                                    $active = in_array($id, $allergyIds) ? 'default-bg-color' : '';
                                                    echo "
                                                        <div class=\"bubble-container\" data-filtertext=\"{$name}\">
                                                            <span class=\"bubble\" >
                                                                <span class=\"inner-bubble {$active}\" data-id=\"{$id}\">{$name}</span>
                                                            </span>
                                                        </div>
                                                    ";
                                                }
                                                // to help with spacing when just a few bubbles are there
                                                for ($i=0; $i < 8; $i++) {echo "<div class=\"bubble-spacer\"></div>";}
                                            ?>
                                        </div>
                                    </div>
                                <?php } else { /* TODO: test with less then 10 */ ?>
                                    <div class="slider">
                                        <?php 
                                            foreach ($Allergies as $Allergy) {
                                                $id = $Allergy->id;
                                                $name = $Allergy->name;
                                                $active = in_array($id, $allergyIds) ? 'default-bg-color' : '';
                                                echo "
                                                    <div class=\"bubble-container\" data-filtertext=\"{$name}\">
                                                        <span class=\"bubble\" >
                                                            <span class=\"inner-bubble {$active}\" data-id=\"{$id}\">{$name}</span>
                                                        </span>
                                                    </div>
                                                ";
                                            }
                                            // to help with spacing when just a few bubbles are there
                                            for ($i=0; $i < 8; $i++) {echo "<div class=\"bubble-spacer\"></div>";}
                                        ?>
                                    </div>
                                <?php } ?>
                                <input type="hidden" class="id-collector" name="allergies" value="<?php echo $formHelper['allergies'] ; ?>">
                            </div>
                        </div>
                    </div>
                    <!-- // # filter by prep time -->
                    <div class="filter-set layout-container">
                        <h3>Prep Time</h3>
                        <div class="filter-times flex-sb">
                            <?php
                                $prepTimes = explode(',', $formHelper['prepTime']);
                                if (count($prepTimes) == 2) {
                                    $prepTimes[0] = (int) $prepTimes[0];
                                    $prepTimes[1] = (int) $prepTimes[1];
                                } else {
                                    $prepTimes[0] = '';
                                    $prepTimes[1] = '';
                                }
                            ?>
                            <input type="text" placeholder="Min 0" name="prepMin" value="<?php echo $prepTimes[0]; ?>" maxlength="3">
                            <span>to</span>
                            <input  type="text" placeholder="Max 480" name="prepMax" value="<?php echo $prepTimes[1]; ?>" maxlength="3">
                        </div>
                    </div>
                    <!-- // # filter by cook time -->
                    <div class="filter-set layout-container">
                        <h3>Cook Time</h3>
                        <div class="filter-times flex-sb">
                            <?php
                                $cookTimes = explode(',', $formHelper['cookTime']);
                                if (count($cookTimes) == 2) {
                                    $cookTimes[0] = (int) $cookTimes[0];
                                    $cookTimes[1] = (int) $cookTimes[1];
                                } else {
                                    $cookTimes[0] = '';
                                    $cookTimes[1] = '';
                                }
                            ?>
                            <input type="text" placeholder="Min 0" name="cookMin" value="<?php echo $cookTimes[0]; ?>" maxlength="3">
                            <span>to</span>
                            <input type="text" placeholder="Max 480" name="cookMax" value="<?php echo $cookTimes[1]; ?>" maxlength="3">
                        </div>
                    </div>
                    <!-- // # filter by total time -->
                    <div class="filter-set layout-container">
                        <h3>Total Time</h3>
                        <div class="filter-times flex-sb">
                            <?php
                                $totalTimes = explode(',', $formHelper['totalTime']);
                                if (count($totalTimes) == 2) {
                                    $totalTimes[0] = (int) $totalTimes[0];
                                    $totalTimes[1] = (int) $totalTimes[1];
                                } else {
                                    $totalTimes[0] = '';
                                    $totalTimes[1] = '';
                                }
                            ?>
                            <input type="text" placeholder="Min 0" name="totalMin" value="<?php echo $totalTimes[0]; ?>" maxlength="3">
                            <span>to</span>
                            <input type="text" placeholder="Max 960" name="totalMax" value="<?php echo $totalTimes[1]; ?>" maxlength="3">
                        </div>
                    </div>
                    <div class="spacer-height-25"></div>
                    <div class="apply-filter-container">
                        <button class="full-width" type="submit" id="applyFilter">Apply Filter</button>
                    </div>
                </form>
            </div>
            <div class="side-bar-filter-modal"></div>
        <?php } ?>
        
        <!-- // # App Container Start -->
        <div class="app-container <?php echo $noHeader; ?>">

    

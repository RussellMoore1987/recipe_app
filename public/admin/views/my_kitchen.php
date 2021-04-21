<!-- <h1>My Kitchen</h1> -->




<div class="layout-container">
    <div class="main-search flex-center-vertical"  action="">
        <div>
            <input type="text" placeholder="Search My Kitchen..." value="<?php echo $_GET['searchBy'] ?? ''; ?>"> 
        </div>
        <div class="filter-icon-container <?php echo $filterActive ?? '' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.03 24.6" class="filter-icon">
                <title>Filter Icon</title>
                <g id="Layer_2" data-name="Layer 2">
                    <g id="Layer_1-2" data-name="Layer 1">
                        <line class="fl-1 main-line" x1="1" y1="5" x2="25" y2="5"/>
                        <line class="fl-2 main-line" x1="1" y1="12" x2="25" y2="12"/>
                        <line class="fl-3 main-line" x1="1" y1="20" x2="25" y2="20"/>
                    </g>
                </g>
            </svg>
            <span class="filter-count"><?php echo $filterParameterCount > 0 ? $filterParameterCount : ''; ?></span>
        </div>
    </div>
</div>

<!-- // TODO: make component -->
<div class="side-scroll-wrapper size-my-favorites">
    <div class="side-scroll-container">
        <div class="my-favorite-size flex-sa">
            <?php 
                foreach ($MyFavoriteRecipes as $Recipe) {
                // $Recipe->my_favorite_component();
                if (strlen($Recipe->description) > 25) {
                    $description = substr($Recipe->description,0,25) . "...";
                } else {
                    $description = $Recipe->description; 
                }
            ?>
               <a href="view_recipe?recipe_id=<?php echo $Recipe->id; ?>">
                    <div class="my-favorite" style="background-image: url(<?php echo $Recipe->get_image_path('large'); ?>);">
                       <div>
                            <h3><?php echo $Recipe->title; ?></h3>
                            <span class="recipe-description"><?php echo $description; ?></span>
                            <span class="small-rating"><?php echo $Recipe->get_stars(); ?></span>
                       </div>
                    </div>
               </a>
            <?php }?>
        </div>
    </div>
</div>

<!-- // TODO: make component -->
<div class="side-scroll-wrapper size-category-links">
    <div class="side-scroll-container">
        <div class="category-links-size flex-sa">
            <?php 
                foreach ($TopCategories as $Category) {
            ?>
                <a href="my_kitchen?categories=<?php echo $Category->id; ?>" class="top-cat flex-center-vertical">
                    <img src="<?php echo IMAGE_LINK_PATH . "/original/top-cat{$Category->id}.jpg"; ?>" alt="">   
                    <h3><?php echo $Category->name; ?></h3>
                </a>
            <?php }?>
        </div>
    </div>
</div>

<div class="layout-container">
    <?php
        foreach ($Recipes as $Recipe) {
            $Recipe->list_component();
        }
    ?>
</div>






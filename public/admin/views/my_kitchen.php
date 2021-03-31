<!-- <h1>My Kitchen</h1> -->




<div class="layout-container">
    <div class="main-search flex-sb">
        <div>
            <input type="text" placeholder="Search My Kitchen...">
        </div>
        <div>
            <i class="fal fa-sort-amount-down"></i>
        </div>
    </div>
</div>

<div class="side-scroll-wrapper size-my-favorites">
    <div class="side-scroll-container">
        <div class="my-favorite-size flex-sb">
            <?php 
                foreach ($MyFavoriteRecipes as $Recipe) {
                // $Recipe->my_favorite_component();
            ?>
               <a href="view_recipe?recipe_id=<?php echo $Recipe->id; ?>">
                    <div class="my-favorite" style="background-image: url(<?php echo $Recipe->get_image_path('large'); ?>);">
                       <div>
                            <h3><?php echo $Recipe->title; ?></h3>
                            <span class="recipe-description"><?php echo $Recipe->title; ?></span>
                            <span class="small-rating"><?php echo $Recipe->get_stars(); ?></span>
                       </div>
                    </div>
               </a>
            <?php }?>
        </div>
    </div>
</div>

<div class="side-scroll-wrapper size-category-links">
    <div class="side-scroll-container">
        <div class="category-links-size flex-sb">
            <?php 
                foreach ($TopCategories as $Category) {
            ?>
                <a href="my_kitchen?category_ids=<?php echo $Category->id; ?>" class="top-cat">
                    <img src="<?php echo IMAGE_LINK_PATH . "/original/topcat{$Category->id}.jpg"; ?>" alt="">   
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






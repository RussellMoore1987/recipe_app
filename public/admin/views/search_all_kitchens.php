<div class="layout-container">
    <div class="main-search flex-sb">
        <div>
            <input type="text" placeholder="Search All Kitchens...">
        </div>
        <div>
            <i class="fal fa-sort-amount-down"></i>
        </div>
    </div>
</div>

<div class="side-scroll-wrapper size-category-links">
    <div class="side-scroll-container">
        <div class="category-links-size flex-sa">
            <?php 
                foreach ($TopCategories as $Category) {
            ?>
                <a href="search_all_kitchens?categories=<?php echo $Category->id; ?>" class="top-cat flex-center-vertical">
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
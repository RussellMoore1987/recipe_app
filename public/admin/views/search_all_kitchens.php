<div class="layout-container">
    <div class="main-search flex-center-vertical">
        <div>
            <input type="text" placeholder="Search All Kitchens..." value="<?php echo $_GET['searchBy'] ?? ''; ?>">
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
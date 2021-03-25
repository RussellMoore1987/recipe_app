<?php
    // var_dump($Recipe);
?>

<div class="recipe-container">
    <div class="recipe-img-container">
        <button class="recipe-back-btn flex-center"><i class="fal fa-long-arrow-left"></i></button>
        <img src="<?php echo $Recipe->get_image_path('large'); ?>" class="recipe-img" alt="Main Image">
    </div>
    <div class="recipe-heading-info layout-container">
        <div class="flex-sb">
            <h2><?php echo $Recipe->title; ?></h2>
            <div>
                <i class="fal fa-ellipsis-v"></i>
            </div>
        </div>
        <div class="flex-sb">
            <span class="rating">
                <i class="fal fa-star"></i>
                <i class="fal fa-star"></i>
                <i class="fal fa-star"></i>
                <i class="fal fa-star"></i>
                <i class="fal fa-star-half"></i>
                (<?php echo $Recipe->average_rating; ?>)
            </span>
            <button>Add A Review</button>
        </div>
    </div>
    <div class="recipe-time-container flex-sa">
        <div class="recipe-time">
            <span>Servings</span>
            <span><?php echo $Recipe->num_serving; ?></span>
        </div>
        <div class="recipe-time">
            <span>Total Time</span>
            <span><?php echo $Recipe->total_time; ?></span>
        </div>
        <div class="recipe-time">
            <span>Prep Time</span>
            <span><?php echo $Recipe->prep_time; ?></span>
        </div>
        <div class="recipe-time">
            <span>Cook Time</span>
            <span><?php echo $Recipe->cook_time; ?></span>
        </div>
    </div>
    <div class="layout-container">
        <h3>Description</h3>
        <p><?php echo $Recipe->description; ?></p>
    </div>
    <div class="recipe-tabs">
        <ul>
            <li data-tab="ingredients">Ingredients</li>
            <li data-tab="directions">Directions</li>
            <li data-tab="attributes">Attributes</li>
        </ul>
        <div id="ingredients">
            <?php echo $Recipe->num_serving; ?>
        </div>
        <div id="directions">
            <?php echo $Recipe->directions; ?>
        </div>
        <div id="attributes">

        </div>
    </div>
</div>
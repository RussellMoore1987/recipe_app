<!-- <h1>My Kitchen</h1> -->
<div class="search flex-sb">
    <div>
        <input type="text">
    </div>
    <div>
        <i class="fal fa-sort-amount-down"></i>
    </div>
</div>
<?php
    foreach ($Recipes as $Recipe) {
        $Recipe->list_component();
    }
?>
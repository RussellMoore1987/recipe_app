<!-- <h1>My Kitchen</h1> -->
<div class="main-search flex-sb">
    <div>
        <input type="text" placeholder="Search My Kitchen...">
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
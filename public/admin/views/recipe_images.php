<style>
.flex-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: flex-start;
}

.preview-image {
    width: 150px;
    height: 150px;
    background-color: red;
    margin: 10px;
}

.preview-image>.add-image {
    font-weight: bolder;
    font-size: 72px;
    background: white;
    border-radius: 100%;
    width: 75px;
    height: 75px;
    text-align: center;
    line-height: 75px;
    margin: auto;
    margin-top: 35px;
}

.add-image>a {
    text-decoration: none;
    color: black;
}
</style>

<div class="flex-container">
<?php 
    foreach ($Images as $Image) {
        $Image->list_component();
    }
?>
    <div class="preview-image">
        <div class="add-image"><a href="./image-upload?id=1">+</a></div>
    </div>
</div>
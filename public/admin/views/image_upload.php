<!-- <form action="upload" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form> -->
<style>
    .flex-container {
        display: flex;
        flex-wrap: wrap;
    }

    .flex-container>div {
        background-color: #f1f1f1;
        width: 100%;
        margin: 10px;
        text-align: center;
        line-height: 40px;
        font-size: 30px;
        padding: 10px;
    }

    .row>label {}

    input[type="file"] {
        font-size: 17px;
        color: #b8b8b8;
    }

    .row>output {
        width: 100%;
        font-size: 16px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* 
    .container {
        height: 350px;
        width: 350px;
        position: relative;
    } */

    .wrapper {
        position: relative;
        width: 100%;
        border-radius: 10px;
        background: #fff;
        border: 2px dashed #c2cdda;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .wrapper.active {
        border: none;
    }

    .wrapper .image {
        position: absolute;
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wrapper img {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }

    .wrapper .icon {
        font-size: 100px;
        color: #9658fe;
    }

    .wrapper .text {
        font-size: 20px;
        font-weight: 500;
        color: #5B5B7B;
    }

    .wrapper #cancel-btn i {
        position: absolute;
        font-size: 20px;
        right: 15px;
        top: 15px;
        color: #9658fe;
        cursor: pointer;
        display: none;
    }

    .wrapper.active:hover #cancel-btn i {
        display: block;
    }

    .wrapper #cancel-btn i:hover {
        color: #e74c3c;
    }

    .wrapper .file-name {
        position: absolute;
        bottom: 0px;
        width: 100%;
        padding: 8px 0;
        font-size: 18px;
        color: #fff;
        display: none;
        background: linear-gradient(135deg, #3a8ffe 0%, #9658fe 100%);
    }

    .wrapper.active:hover .file-name {
        display: block;
    }

    .container #custom-btn,
    #submit-btn {
        margin-top: 30px;
        display: block;
        width: 100%;
        height: 50px;
        border: none;
        outline: none;
        border-radius: 25px;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        background: linear-gradient(135deg, #3a8ffe 0%, #9658fe 100%);
    }
</style>

<form action="upload" method="post" enctype="multipart/form-data" id="uploadForm">
    <div class="wrapper">
        <input type="text" id="recipeId" value="<?php echo $id ?>" hidden="hidden">
        <input type="file" name="recipeImage" onChange="displayImage(this)" id="recipeImage" hidden=hidden>
        <div class="recipe-id" name="<?php echo $id ?>"></div>
        <div class="image">
            <img id="preview-img" src="" alt="" hidden="hidden">
        </div>
        <div class="content">
            <div class="icon">
                <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <div class="text">
                No file chosen, yet!
            </div>
        </div>
        <div id="cancel-btn">
            <i class="fas fa-times"></i>
        </div>
        <div class="file-name">
            File name here
        </div>
    </div>
    <button type="button" onclick="defaultBtnActive()" id="custom-btn">Choose Image</button>
    <button type="submit" id="submit-btn">Upload Image</button>
</form>

<script>
    const wrapper = document.querySelector(".wrapper");
    const fileName = document.querySelector(".file-name");
    const defaultBtn = document.querySelector("#recipeImage");
    const customBtn = document.querySelector("#custom-btn");
    const cancelBtn = document.querySelector("#cancel-btn i");
    const img = document.querySelector("#preview-img");
    const rid = document.querySelector(".recipe-id");
    let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
    let file;


    function triggerClick(e) {
        document.querySelector('#recipeImage').click();
    }

    function displayImage(e) {
        console.log(e.files[0])
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                img.setAttribute('src', e.target.result);
                img.setAttribute('hidden', null);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }

    function defaultBtnActive() {
        defaultBtn.click();
    }

    defaultBtn.addEventListener("change", function() {
        file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                const result = reader.result;
                img.src = result;
                img.hidden = null;
                wrapper.classList.add("active");
            }
            cancelBtn.addEventListener("click", function() {
                img.src = "";
                img.hidden = "hidden";
                wrapper.classList.remove("active");
            })
            reader.readAsDataURL(file);
        }
        if (this.value) {
            let valueStore = this.value.match(regExp);
            fileName.textContent = valueStore;
        }
    });
</script>



<?php
// include ImageManipulator class
require_once('../../private/classes/ImageManipulator.php');

foreach ($_FILES as $file) {
    // array of valid extensions
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
    // get extension of the uploaded file
    $fileExtension = strrchr($file['name'], ".");
    // check if file Extension is on the list of allowed ones
    if (in_array($fileExtension, $validExtensions)) {
        $newNamePrefix = time() . '_';
        $manipulator = new ImageManipulator($file['tmp_name']);
        $width  = $manipulator->getWidth();
        $height = $manipulator->getHeight();
        $centreX = round($width / 2);
        $centreY = round($height / 2);
        // our dimensions will be 200x130
        $x1 = $centreX - 100; // 200 / 2
        $y1 = $centreY - 65; // 130 / 2

        $x2 = $centreX + 100; // 200 / 2
        $y2 = $centreY + 65; // 130 / 2

        // center cropping to 200x130
        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
        // saving file to uploads folder
        $manipulator->save('uploads/' . $newNamePrefix . $file['name']);
        echo 'Done ...';
    } else {
        echo 'You must upload an image...';
    }
}

?>
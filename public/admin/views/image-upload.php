<!-- <form action="upload" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form> -->


<form enctype="multipart/form-data" method="post" action="upload">
    <div class="row">
        <label for="fileToUpload">Select File to Upload</label><br />
        <input type="file" name="filesToUpload" id="fileToUpload" />
        <output id="fileInfo"></output>
    </div>
    <div class="row">
        <input type="submit" value="Upload" />
    </div>
</form>

<div id="dropTarget" style="width: 90%; height: 100px; border: 1px #ccc solid; padding: 10px;">Drop some files here
</div>
<output id="fileInfo"></output>

<script>
function fileSelect(evt) {
    var files = evt.target.files;

    var result = '';
    var file;
    for (var i = 0; file = files[i]; i++) {
        // if the file is not an image, continue
        if (!file.type.match('image.*')) {
            continue;
        }

        reader = new FileReader();
        reader.onload = (function(tFile) {
            return function(evt) {
                var div = document.createElement('div');
                div.innerHTML = '<img style="width: 90px;" src="' + evt.target.result +
                    '" />';
                document.getElementById('filesInfo').appendChild(div);
            };
        }(file));
        reader.readAsDataURL(file);
    }
}

document.getElementById('filesToUpload').addEventListener('change', fileSelect, false);


function dragOver(evt) {
    evt.stopPropagation();
    evt.preventDefault();
    evt.dataTransfer.dropEffect = 'copy';
}

var dropTarget = document.getElementById('dropTarget');
dropTarget.addEventListener('dragover', dragOver, false);
dropTarget.addEventListener('drop', fileSelect, false);

document.getElementById('filesToUpload').onchange = function() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(ev) {
        document.getElementById('filesInfo').innerHTML = 'Done!';
    };
    xhr.open('POST', 'upload.php', true);
    var files = document.getElementById('filesToUpload').files;
    var data = new FormData();
    for (var i = 0; i < files.length; i++) data.append('file' + i, files[i]);
    xhr.send(data);
}
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
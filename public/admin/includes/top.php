<?php
    // check to see if page title was sent
    $pageTitle = $pageTitle ?? "Default Page";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- set page title -->
    <title><?php echo $pageTitle; ?></title>
    <!-- main styles -->
    <link rel="stylesheet" href="<?php echo PUBLIC_LINK_PATH . "/admin/css/style.css?{$assetVersion}"; ?>">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/58867e1c02.js" crossorigin="anonymous"></script>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,700&display=swap" rel="stylesheet">
    <!-- // TODO: set favicon -->
    <!-- <link rel="apple-touch-icon" href="logo192.png" /> -->
    <?php
        // todo list
            // set favicon
            // pull in custom CSS
    ?>
</head>
<body class="flex-center-horizontal">
    <div class="container">
    

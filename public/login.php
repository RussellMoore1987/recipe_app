<?php
    // TODO-CI: add to main CI
    // @ standard log in/out start
        // include main logic for all pages
        require_once('../private/initialize.php');

        // get to see if we are logging in
        if (is_post_request() && isset($_POST["login"])) {
            $typeOfMessage = 'error';
            $message = Session::login($_POST["login"]);
        }

        // check to see if were logging someone out
        if (is_get_request() && isset($_GET["logout"])) {
            // Need to do a little magic trick to keep the theme going
            $themeId = $_SESSION['themeId'] ?? 0;
            // logout
            $message = Session::logout($redirect = 'no');
            // set theme variable
            Session::override_var('themeId', $themeId);
        }
        
        // set message
        $typeOfMessage = $typeOfMessage ?? 'info';
        $message = $message ?? "";
    // @ standard log in/out start

    // check fo theme
    $themeId = isset($_GET["themeId"]) ? (int)$_GET["themeId"] : 0;
    $themeInfo = Chef::get_theme_info($themeId);
    $appIcon = IMAGE_LINK_PATH . "/original/{$themeInfo['app_icon']}";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="<?php echo $appIcon; ?>" />
    <link rel="icon" href="<?php echo $appIcon; ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo $appIcon; ?>" type="image/x-icon"> 
    <title>Login</title>
    <!-- main styles -->
    <link rel="stylesheet" href="<?php echo PUBLIC_LINK_PATH . "/admin/css/style.css?{$assetVersion}"; ?>">
    <style>
        :root {
            --theme-color: <?php echo $themeInfo['theme_color']; ?>;
        }
    </style>
</head>
<body class="flex-center">
    <div class="login">
        <div>
            <?php echo $message; ?>
        </div>
        <img class="login-logo" src="<?php echo IMAGE_LINK_PATH . "/original/{$themeInfo['login_logo']}"; ?>" alt="Login Logo">
        <form method="post">
            <input type="email" id='email' name="login[field1]" placeholder="Email" maxlength='50' minlength='2' required >
            <input type="password" id='password' name="login[password]" placeholder="Password" maxlength='50' minlength='2' required >
            <button class="full-width" type="submit">Login</button>
        </form>
    </div>
</body>
</html>
<?php
    // this will help us redirect accurately 
    $linkAttachment = isset($_SESSION['themeId']) ? "?themeId={$_SESSION['themeId']}" : '';
    Session::check_login($linkAttachment);
?>
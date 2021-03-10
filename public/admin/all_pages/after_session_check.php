<?php
    // check to see  if we have session variables if not set them up
    if (Session::check_var_exists('userIdentifier') && !Session::check_var_exists('id')) {
        // check to see who it is and check to see who their head chef is
        $chefId = Session::get_var('userIdentifier');
        $Chef = Chef::find_by_id((int) $chefId);
        if ($Chef->chef_type == 1) {
            $themeId = $chefId;
        } else {
            $themeId = $Chef->created_by_chef_id;
        }
        $themeInfo = Chef::get_theme_info($themeId);
        Session::override_var('id', $chefId);
        Session::override_var('loginLogo', $themeInfo['login_logo']);
        Session::override_var('headerLogo', $themeInfo['header_logo']);
        Session::override_var('appIcon', $themeInfo['app_icon']);
        Session::override_var('themeColor', $themeInfo['theme_color']);
        Session::override_var('themeId', $themeId);
    }
?>
<?php
    // include traits
    require_once("sideBarComponent.trait.php");
    require_once("bottomMenuComponent.trait.php");

    class Component {
        // @ traits start
        use SideBarComponent;
        use BottomMenuComponent;
        // @ traits end
    } 
?>
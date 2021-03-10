    </div> 
    <!-- // # Container End -->

</div>
<!-- // # Outer Wrapper End -->

<!-- // # JS Files -->
<script src="<?php echo PUBLIC_LINK_PATH . "/admin/js/general.js" ?>"></script>

<?php
    // set page specific js if there 
    if (file_exists(PUBLIC_PATH . "/admin/js/{$Router->pathJs}")) {
        // got it, set path
        echo "<script src='" . PUBLIC_LINK_PATH . "/admin/js/{$Router->pathJs}?{$assetVersion}'></script>";
    }
    
?>
<!-- general form JS -->
<script src="<?php echo PUBLIC_LINK_PATH . "/admin/js/forms.js?{$assetVersion}"; ?>"></script>
</body>
</html>
<?php
    trait ImageComponents {
        public function list_component() {
            $imagePath = $this->main_image ? IMAGE_LINK_PATH . "/large/" . $this->main_image : '';
            $altText = $this->alt;
        // outputting component
        echo "
        <div class=\"image\">
            <div>
                <div style=\"background-image: url({$imagePath});\" alt=\"{{$altText}}\"></div>
            </div>
        </div>
        ";
        }
    }
?>
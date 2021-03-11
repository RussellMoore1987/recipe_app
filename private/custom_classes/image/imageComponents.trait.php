<?php
    trait ImageComponents {
        public function list_component() {
            $imagePath = $this->image_name ? IMAGE_LINK_PATH . "/large/" . $this->image_name : '';
            $altText = $this->alt;
            // outputting component
            echo "
                <div class=\"preview-image\" 
                    style=\"
                        background-image: url({$imagePath});
                        background-size: 150px 150px;                    
                    \" 
                    role=\"img\" aria-label=\"{$altText}\">
                </div>
            ";
        }
    }
?>
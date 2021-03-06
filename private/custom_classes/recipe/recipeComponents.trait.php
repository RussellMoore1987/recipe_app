<?php
    trait RecipeComponents {
        public function list_component() {
            // TODO: fix up, what about nulls
            // setting variables
                $imagePath = IMAGE_LINK_PATH . "/large/" . $this->main_image;
                $title = $this->title;
                if (strlen($this->description) > 25) {
                    $description = substr($this->description,0,25) . "...";
                } else {
                    $description = $this->description; 
                }
                $totalTime = $this->total_time;
                $stars = [];
                for ($i=0; $i < round($this->average_rating); $i++) { 
                    $stars[] = '<i class="fal fa-star"></i>';
                }
                if (is_float($this->average_rating)) {
                    $stars[] = '<i class="fal fa-star-half"></i>';
                }
                $stars = implode('',$stars);
                $averageRating = $this->average_rating;
            // outputting component
            echo "
            <div class=\"recipe\">
                <div>
                    <div class=\"recipe-img\" style=\"background-image: url({$imagePath});\"></div>
                </div>
                <div class=\"recipe-content\" >
                    <h3>{$title}</h3>
                    <span>{$description}</span>
                    <span>Total Cook Time {$totalTime}<small>min</small></span>
                    <span>{$stars} ({$averageRating})</span>
            
                </div>
            </div>
            ";
        }    
    }
?>
<?php
    trait RecipeComponents {
        public function list_component() {
            // TODO: fix up, what about nulls
            // setting variables
                $id = $this->id; 
                $imagePath = $this->main_image ? $this->get_image_path('large') : '';
                $title = $this->title;
                if (strlen($this->title) > 20) {
                    $title = substr($this->title,0,20) . "...";
                } else {
                    $title = $this->title; 
                }
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
                if ($this->average_rating > 0 && is_float(floatval($this->average_rating))) {
                    $stars[] = '<i class="fal fa-star-half"></i>';
                }
                $stars = implode('',$stars);
                $averageRating = $this->average_rating;
            // outputting component
            echo "
                <div class=\"recipe-list\">
                    <div>
                        <a href=\"view_recipe?recipe_id={$id}\" class=\"recipe-list-link\">
                            <div class=\"recipe-list-img\" style=\"background-image: url({$imagePath});\"></div>
                        </a>
                    </div>
                    <div class=\"recipe-list-content\" >
                        <a href=\"view_recipe?recipe_id={$id}\" class=\"recipe-list-link\">
                            <h3>{$title}</h3>
                        </a>
                        <span>{$description}</span>
                        <span>Total Cook Time {$totalTime}<small>min</small></span>
                        <span class=\"rating\">{$stars} ({$averageRating})</span>
                
                    </div>
                </div>
            ";
        }
        
        public function recipe_layout() {
            // TODO: fix up, what about nulls
            // setting variables
                $id = $this->id; 
                $imagePath = $this->main_image ? $this->get_image_path('large') : '';
                $title = $this->title;
                $description = $this->description; 
                $cookTime = $this->cook_time;
                $prepTime = $this->prep_time;
                $totalTime = $this->total_time;
                $stars = [];
                for ($i=0; $i < round($this->average_rating); $i++) { 
                    $stars[] = '<i class="fal fa-star"></i>';
                }
                if ($this->average_rating > 0 && is_float(floatval($this->average_rating))) {
                    $stars[] = '<i class="fal fa-star-half"></i>';
                }
                $stars = implode('',$stars);
                $averageRating = $this->average_rating;
            // outputting component
            echo "
                <div class=\"recipe-list\">
                    <div>
                        <a href=\"view_recipe?recipe_id={$id}\" class=\"recipe-list-link\">
                            <div class=\"recipe-list-img\" style=\"background-image: url({$imagePath});\"></div>
                        </a>
                    </div>
                    <div class=\"recipe-list-content\" >
                        <a href=\"view_recipe?recipe_id={$id}\" class=\"recipe-list-link\">
                            <h3>{$title}</h3>
                        </a>
                        <span>{$description}</span>
                        <span>Total Cook Time {$totalTime}<small>min</small></span>
                        <span class=\"rating\">{$stars} ({$averageRating})</span>
                
                    </div>
                </div>
            ";
        }   
    }
?>
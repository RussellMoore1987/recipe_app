<?php
    trait ImageSeeder {

        // get seeder default record count
        static public $seederDefaultRecordCount = 33;

        // sql feeder
        static public function seeder_setter(object $Seeder) {
            // get recipes
            $recipeId = rand(1, Recipe::count_all());

            // build array
            $seederInfo = [
                'image_name' =>  'image' . $Seeder->id(1) . 'jpg',
                'sort' => rand(1,10),
                'is_featured' => rand(0,1),
                'alt' =>  $Seeder->max_char($Seeder->words(rand(0,10)), 50),
                'recipe_id' =>  $recipeId
            ];
             
            // return data
            return $seederInfo;
        }
    }
?>
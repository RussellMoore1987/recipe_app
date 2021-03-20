<?php
    trait ReviewSeeder {

        // get seeder default record count
        static public $seederDefaultRecordCount = 400;

        // sql feeder
        static public function seeder_setter(object $Seeder) {
            // get counts
            $recipe_id = rand(1, Recipe::count_all());
            $chef_id = rand(1, Chef::count_all());
            // build array
            $seederInfo = [
                'title' =>  rand(1,100) > 20 ? ucfirst($Seeder->max_char($Seeder->min_char($Seeder->words(rand(1,3)), 2), 25)) : '',
                'review' => rand(1,100) > 20 ? $Seeder->max_char($Seeder->sentences(rand(0,3)), 255, ".") : '',
                'rating' => rand(1,5),
                'recipe_id' => $recipe_id,
                'chef_id' => $chef_id
            ];
             
            // return data
            return $seederInfo;
        }
    }
?>
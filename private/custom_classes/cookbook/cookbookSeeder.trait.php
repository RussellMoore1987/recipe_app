<?php
    trait CookbookSeeder {

        // get seeder default record count
        static public $seederDefaultRecordCount = 100;

        // sql feeder
        static public function seeder_setter(object $Seeder) {
            // get counts
            $chef_id = rand(1, Chef::count_all());
            $cookbook_image = 'cookbook_' . rand(1,10) . '.png';
            // build array
            $seederInfo = [
                'title' =>  ucfirst($Seeder->max_char($Seeder->min_char($Seeder->words(rand(1,3)), 2), 50)),
                'chef_id' => $chef_id,
                'is_private' => rand(1,100) > 80 ? 1 : 0,
                'cookbook_image' => $cookbook_image
            ];
             
            // return data
            return $seederInfo;
        }
    }
?>
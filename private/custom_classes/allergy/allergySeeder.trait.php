<?php
    trait AllergySeeder {

        // get seeder default record count
        static public $seederDefaultRecordCount = 15;

        // sql feeder
        static public function seeder_setter(object $Seeder) {
            // build array
            $seederInfo = [
                'name' =>  ucfirst($Seeder->max_char($Seeder->min_char($Seeder->words(rand(1,3)), 2), 35)) . $Seeder->id()
            ];
             
            // return data
            return $seederInfo;
        }
    }
?>
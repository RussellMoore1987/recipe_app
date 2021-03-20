<?php
    trait TagSeeder {

        // get seeder default record count
        static public $seederDefaultRecordCount = 55;

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
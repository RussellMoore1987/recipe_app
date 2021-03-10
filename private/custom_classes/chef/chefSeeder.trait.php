<?php
    trait ChefSeeder {

        // get seeder default record count
        static public $seederDefaultRecordCount = 55;

        // sql feeder
        static public function seeder_setter(object $Seeder) {
            $first_name = $Seeder->first_name();
            $last_name = $Seeder->last_name();
            $name = $first_name . " " . $last_name;
            $password = password_hash(
                $Seeder->max_char(
                    $Seeder->min_char(
                        $Seeder->words(rand(1,3)) 
                    , 8)
                , 25)
            , PASSWORD_BCRYPT);
            $randNum = rand(0,100);
            if ($randNum > 90) {
                $chefType = 1;
            }else if ($randNum > 80) {
                $chefType = 2;
            } else {
                $chefType = 3;
            }
            // get chef
            $createdByChefId = rand(1, Chef::count_all());
            // build array
            $seederInfo = [
                'name' =>  ucfirst($Seeder->max_char($Seeder->min_char($name, 2), 50)),
                'email' =>  $Seeder->email("{$first_name}{$last_name}"),
                'hashed_password' => $password,
                'chef_type' => $chefType,
                'created_by_chef_id' => $createdByChefId,
                'is_active' => rand(0,100) > 90 ? 0 : 1
            ];
             
            // return data
            return $seederInfo;
        }
    }
?>
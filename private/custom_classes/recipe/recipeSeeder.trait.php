<?php
    // TODO: possibly set trait with interface to force the use of specific elements
    trait RecipeSeeder {

        // * seeder, located at: root/private/rules_docs/devTool_docs.php
        // get seeder default record count
        static public $seederDefaultRecordCount = 300;

        // sql feeder
        static public function seeder_setter(object $Seeder) {
            // setting some variables
                // get chef
                $chef = rand(1, Chef::count_all());
                $cook_time = rand(10,60);
                $prep_time = rand(10,60);
                $counter = rand(3,12);
                $ingredients = [];
                for ($i=0; $i < $counter; $i++) { 
                    $ingredient = [];
                    $ingredient['uom'] = $Seeder->options(['Each', 'Cups', 'Teaspoons', 'Tablespoons',]);
                    $ingredient['num'] = rand(1,6);
                    $ingredient['ingredient'] = $Seeder->sentences();
                    $ingredients[] = $ingredient;
                }
                $main_image = $Seeder->options(['Each', 'Cups', 'Teaspoons', 'Tablespoons',]);
                // for images
                $randNum = rand(1,33);
                $main_image = "image{$randNum}.jpg";
            // build array
            $seederInfo = [
                'title' => ucfirst($Seeder->max_char($Seeder->min_char($Seeder->words(rand(1,3)), 2), 50)),
                'description' => $Seeder->max_char($Seeder->sentences(rand(1,3)), 255, "."),
                'cook_time' => $cook_time,
                'prep_time' => $prep_time,
                'total_time' => $cook_time + $prep_time,
                'num_serving' => rand(1,10),
                'is_private' => rand(1,100) > 80 ? 1 : 0,
                'status' => rand(1,100) > 90 ? 0 : 1,
                'chef_id' => $chef, 
                'directions' => $Seeder->max_char($Seeder->paragraphs(rand(1,3)), 65000, "."),
                'ingredients' => json_encode($ingredients),
                'main_image' => $main_image,
                'average_rating' => rand(0,5) . '.' . rand(0,99),
                'created_date' => $Seeder->date()
            ];

            // return data
            return $seederInfo;
        }
    }
?>
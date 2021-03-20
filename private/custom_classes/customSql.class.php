<?php
    // for custom SQL
    class CustomSql {
        // @ creation methods start
            // on create all tables this function will run 
            static public function creation() {
                // this is custom functionality for this app
                // get inserts
                $creationInserts = CustomSql::$creationInserts;

                // run through and produce commands
                foreach ($creationInserts as $key => $sql) {
                    $result = DatabaseObject::run_sql($sql);
                }

                // set message
                $replyInfo['message'][] = "The creation inserts were done successfully.";

                // return information
                return  $replyInfo;
            }
        // @ creation methods end

        // @ insert methods start
            // on insert all tables this function will run 
            static public function insert() {
                // set default variables
                $replyInfo = [];
                // this is a custom class built specifically for the system 
                // add Cartesian product insert for normal tables, this means the connection can be anything there is no specificity between tables
                // class name for account and tablename of the first object
                // $className = '';
                // # TryLater
                $className = 'Chef';
                // name of second class and connecting table
                // $tableNames = ['MediaContent' => 'posts_to_media_content'];
                $tableNames = ['Recipe' => 'TryLater'];
                $foreignKeyNames = ['chef_id','recipe_id'];
                $commandResults = CustomSql::cartesian_insert($className, $tableNames, $foreignKeyNames);
                // check for errors/messages
                $replyInfo = merge_data_arrays($replyInfo, $commandResults);

                // # MyFavorites
                $className = 'Chef';
                // name of second table and connecting table
                // $tableNames = ['MediaContent' => 'posts_to_media_content'];
                $tableNames = ['Recipe' => 'MyFavorites'];
                $foreignKeyNames = ['chef_id','recipe_id'];
                $commandResults = CustomSql::cartesian_insert($className, $tableNames, $foreignKeyNames);
                // check for errors/messages
                $replyInfo = merge_data_arrays($replyInfo, $commandResults);

                // # RecipesToCategories
                $className = 'Category';
                // name of second table and connecting table
                // $tableNames = ['MediaContent' => 'posts_to_media_content'];
                $tableNames = ['Recipe' => 'RecipesToCategories'];
                $foreignKeyNames = ['cat_id','recipe_id'];
                $commandResults = CustomSql::cartesian_insert($className, $tableNames, $foreignKeyNames);
                // check for errors/messages
                $replyInfo = merge_data_arrays($replyInfo, $commandResults);

                // # RecipesToTags
                $className = 'Tag';
                // name of second table and connecting table
                // $tableNames = ['MediaContent' => 'posts_to_media_content'];
                $tableNames = ['Recipe' => 'RecipesToTags'];
                $foreignKeyNames = ['tag_id','recipe_id'];
                $commandResults = CustomSql::cartesian_insert($className, $tableNames, $foreignKeyNames);
                // check for errors/messages
                $replyInfo = merge_data_arrays($replyInfo, $commandResults);

                // # CookbooksToRecipes
                $className = 'Cookbook';
                // name of second table and connecting table
                // $tableNames = ['MediaContent' => 'posts_to_media_content'];
                $tableNames = ['Recipe' => 'CookbooksToRecipes'];
                $foreignKeyNames = ['cookbook_id','recipe_id'];
                $commandResults = CustomSql::cartesian_insert($className, $tableNames, $foreignKeyNames);
                // check for errors/messages
                $replyInfo = merge_data_arrays($replyInfo, $commandResults);

                // # RecipesToAllergies
                $className = 'Allergy';
                // name of second table and connecting table
                // $tableNames = ['MediaContent' => 'posts_to_media_content'];
                $tableNames = ['Recipe' => 'RecipesToAllergies'];
                $foreignKeyNames = ['allergy_id','recipe_id'];
                $commandResults = CustomSql::cartesian_insert($className, $tableNames, $foreignKeyNames);
                // check for errors/messages
                $replyInfo = merge_data_arrays($replyInfo, $commandResults);

                // return information
                return  $replyInfo;
            }
        // @ insert methods end

        // @ creation helper methods start
            // creation inserts
            static protected $creationInserts = [
                "insertUserMainChef1" => '
                    INSERT INTO Chefs (name, email, hashed_password, chef_type, created_by_chef_id, is_active)
                    VALUES (\'Russell Moore\', \'truthandgoodness87@gmail.com\', \'$2y$10$YXhJaRzpd48K9ynspshTEOg.E9aVd/0.Gb5m3B8B4Iaus2zlGV7/.\', 1, 0, 1)
                ',
                "insertUserMainChef2" => '
                    INSERT INTO Chefs (name, email, hashed_password, chef_type, created_by_chef_id, is_active)
                    VALUES (\'Charles Swann\', \'charles@swanhaven.co\', \'$2y$10$MNH6ic1ZiyKrtIyP4kQn6e3NgkeJvoBAY.33E.yCIuRdNg1.nLlcO\', 1, 1, 1)
                ',
                "insertUserMainChef3" => '
                    INSERT INTO Chefs (name, email, hashed_password, chef_type, created_by_chef_id, is_active)
                    VALUES (\'Test Dev\', \'testdev@gmail.com\', \'$2y$10$SX2WWO8yPR0V7/l29U5QzuLD/RYV.7LGesA6KpgWwkLL0z..s9/HK\', 1, 1, 1)
                ',
                "insertConnectingTableInfo1" => "
                    INSERT INTO HeadChefData (head_chef_id, login_logo, header_logo, app_icon, theme_color)
                    VALUES (1, 'login_logo_1.png', 'header_logo_1.png', 'app_icon_1.ico', '#EA453D')
                ",
                "insertConnectingTableInfo2" => "
                    INSERT INTO HeadChefData (head_chef_id, login_logo, header_logo, app_icon, theme_color)
                    VALUES (2, 'login_logo_2.png', 'header_logo_2.png', 'app_icon_2.ico', '#608171')
                "
            ];
        // @ creation helper methods end

        // @ insert helper methods start
            // # generic Cartesian product for connecting tables
            static protected function cartesian_insert(string $className, array $connectionTables = [], array $foreignKeyNames = []) {
                // default variables
                $replyInfo = [];

                // make sure were getting what we really think you're getting
                if (class_exists($className) && in_array(ucfirst($className), DatabaseObject::get_class_list())) {
                    // get count all
                    $classCount = $className::count_all();
                    // check to see if any foreign keys were passed in
                    // get class ID
                    $foreignKeyNames[0] = $foreignKeyNames[0] ?? $className::get_id_name();
                    // check to make sure Is over 1
                    if ($classCount > 1) {
                        // split it based off of size
                        $data = self::offset_count($classCount);
                        // get offset the for main table
                        $times = (int) $data['times'];
                        $offset = (int) $data['offset'];
                        // counter for foreign keys
                        $foreignKeyCounter = 1;
                        // look over each table to make connections
                        foreach ($connectionTables as $otherClassName => $connectionTableName) {
                            // check to see if any foreign keys were passed in
                            // get class ID
                            $foreignKeyNames[1] = $foreignKeyNames[$foreignKeyCounter] ?? $otherClassName::get_id_name();
                            // get count all from other table
                            $otherTableCount = $otherClassName::count_all();
                            $otherTableCount = (int) $otherTableCount;
                            // get other table offset
                            $otherTableOffset = (int) floor($otherTableCount / $times);
                            // set all main arrays to zero
                            $mainIds = [];
                            $otherIds = [];
                            $idMix = [];
                            // because this is done in the create statement we know that all IDs start at one, mimic the Cartesian process
                            for ($i=0; $i < $times; $i++) { 
                                // main ids
                                for ($j=$offset * $i; $j < $offset * ($i + 1); $j++) { 
                                    $mainIds[$i][] = $j + 1;
                                }
                                // other ids
                                for ($j=$otherTableOffset * $i; $j < $otherTableOffset * ($i + 1); $j++) { 
                                    $otherIds[$i][] = $j + 1;
                                }
                                // create the Cartesian product
                                for ($j=0; $j < count($mainIds[$i]); $j++) { 
                                    // loop over other IDs
                                    for ($k=0; $k < count($otherIds[$i]); $k++) { 
                                        # code...
                                        $idMix[] = [$mainIds[$i][$j], $otherIds[$i][$k]];
                                    }
                                }
                            }
                            // insert all records
                            $sql = "INSERT INTO {$connectionTableName} ({$foreignKeyNames[0]}, {$foreignKeyNames[1]}) VALUES ";
                            for ($i=0; $i < count($idMix); $i++) { 
                                $sql .= " ({$idMix[$i][0]}, {$idMix[$i][1]})";
                                $sql .= $i + 1 < count($idMix) ? ',' : '';
                            }
                            // run sql
                            $result = DatabaseObject::run_sql($sql);
                            // increment four key counter
                            $foreignKeyCounter++;
                        }
                        // set message
                        $replyInfo['message'][] = "The generic cartesian insert was successfully completed.";
                    } else {
                        // set errors
                        $replyInfo['errors'][] = "The class with the name of \"{$className}\" must have a record count higher than one to perform this action.";
                    }
                } else {
                    // set errors
                    $replyInfo['errors'][] = "There is no class with the name of \"{$className}\" that has cartesian insert functionality. No action was performed.";
                }
        
                // return information
                return $replyInfo;
            }
        // @ insert helper methods end
    
        // @ helper functionality starts
            // # get me offset and number of times
            static protected function offset_count(int $count) {
                // Split account based off of size
                if ($count > 1) {
                    if ($count < 200) {
                        $times = 2;
                        $offset = floor($count / $times);
                    } elseif ($count < 500) {
                        $times = 3;
                        $offset = floor($count / $times);
                    } elseif ($count < 1000) {
                        $times = 5;
                        $offset = floor($count / $times);
                    } elseif ($count < 2000) {
                        $times = 10;
                        $offset = floor($count / $times);
                    }
                    $replyInfo['times'] = $times;
                    $replyInfo['offset'] = $offset;
                }
        
                // return information
                return $replyInfo ?? false;
            }
        // @ helper functionality ends
    }
?>
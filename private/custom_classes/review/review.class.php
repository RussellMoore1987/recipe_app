<?php
    // include api trait
    require_once("reviewSql.trait.php");
    require_once("reviewSeeder.trait.php");

    class Review extends DatabaseObject {
        // @ class database information start
            // Class specific properties. Overwritten from DatabaseObject Class
            // Name of the table
            static protected $tableName = "Reviews";
            // db columns
            static protected $columns = ['id', 'title', 'review', 'rating', 'recipe_id', 'chef_id'];
            // values to exclude on normal updates, should always include id
            static protected $columnExclusions = ['id'];
            // name specific properties you wish to included in the API
            static protected $apiProperties = [];             
            // db validation, // * validation_options located at: root/private/rules_docs/reference_information.php
            static protected $validation_columns = [
                'id' => [
                    'name' => 'Review id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min' => 1, // number min value
                    'max' => 10 // string length
                ],
                'title' => [
                    'name' => 'Review Title',
                    'type' => 'str', // type of string
                    'min' => 2, // string length
                    'max' => 25, // string length
                    'html' => 'no' // mostly just to allow special characters like () []
                ],
                'review' => [
                    'name' => 'Review Content',
                    'type' => 'str', // type of string
                    'max' => 255, // string length
                    'html' => 'no'
                ],
                'rating' => [
                    'name'=>'Review Rating',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min'=> 1, // number min value
                    'num_max'=> 5, // number max value
                ],
                'recipe_id' => [
                    'name' => 'Recipe id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min' => 1, // number min value
                    'max' => 10 // string length
                ],
                'chef_id' => [
                    'name' => 'Chef id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min' => 1, // number min value
                    'max' => 10 // string length
                ]
            ];

        // @ class database information end

        // @ class traits start
            use ReviewSql;
            use ReviewSeeder;
        // @ class traits end
    }
    
?>
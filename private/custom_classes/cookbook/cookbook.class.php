<?php
    // include api trait
    require_once("cookbookSql.trait.php");
    require_once("cookbookSeeder.trait.php");

    class Cookbook extends DatabaseObject {
        // @ class database information start
            // Class specific properties. Overwritten from DatabaseObject Class
            // Name of the table
            static protected $tableName = "Cookbooks";
            // db columns
            static protected $columns = ['id', 'title', 'chef_id', 'is_private', 'cookbook_image'];
            // values to exclude on normal updates, should always include id
            static protected $columnExclusions = ['id'];
            // name specific properties you wish to included in the API
            static protected $apiProperties = [];
            // db validation, // * validation_options located at: root/private/rules_docs/reference_information.php
            static protected $validation_columns = [
                'id' => [
                    'name' => 'Cookbook id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min' => 1, // number min value
                    'max' => 10 // string length
                ],
                'title' => [
                    'name' => 'Cookbook Title',
                    'required' => true,
                    'type' => 'str', // type of string
                    'min' => 2, // string length
                    'max' => 50, // string length
                    'html' => 'no' // mostly just to allow special characters like () []
                ],
                'chef_id' => [
                    'name' => 'Chef id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min' => 1, // number min value
                    'max' => 10 // string length
                ],
                'is_private' => [
                    'name'=>'Cookbook is Private',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min'=> 0, // number min value
                    'num_max'=> 1, // number max value
                ],
                'cookbook_image' => [
                    'name' => 'Cookbook Image',
                    'type' => 'str', // type of string
                    'min' => 5, // string length
                    'max' => 25, // string length
                    'html' => 'no' // mostly just to allow special characters like () []
                ]
            ];

        // @ class database information end

        // @ class traits start
            use CookbookSql;
            use CookbookSeeder;
        // @ class traits end
    }
    
?>
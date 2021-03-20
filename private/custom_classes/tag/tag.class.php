<?php
    // include api trait
    require_once("tagSql.trait.php");
    require_once("tagSeeder.trait.php");

    class Tag extends DatabaseObject {
        // @ class database information start
            // Class specific properties. Overwritten from DatabaseObject Class
            // Name of the table
            static protected $tableName = "tags";
            // db columns
            static protected $columns = ['id', 'name'];
            // values to exclude on normal updates, should always include id
            static protected $columnExclusions = ['id'];
            // name specific properties you wish to included in the API
            static protected $apiProperties = [];
            // db validation, // * validation_options located at: root/private/rules_docs/reference_information.php
            static protected $validation_columns = [
                'id' => [
                    'name' => 'Category id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min' => 1, // number min value
                    'max' => 10 // string length
                ],
                'name' => [
                    'name' => 'Category Name',
                    'required' => true,
                    'type' => 'str', // type of string
                    'min' => 2, // string length
                    'max' => 35, // string length
                    'html' => 'no' // mostly just to allow special characters like () []
                ]
            ];

        // @ class database information end

        // @ class traits start
            use TagSql;
            use TagSeeder;
        // @ class traits end
    }
    
?>
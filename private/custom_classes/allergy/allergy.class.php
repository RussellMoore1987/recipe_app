<?php
    // include api trait
    require_once("allergySql.trait.php");
    require_once("allergySeeder.trait.php");

    class Allergy extends DatabaseObject {
        // @ class database information start
            // Class specific properties. Overwritten from DatabaseObject Class
            // Name of the table
            static protected $tableName = "Allergies";
            // db columns
            static protected $columns = ['id', 'name'];
            // values to exclude on normal updates, should always include id
            static protected $columnExclusions = ['id'];
            // name specific properties you wish to included in the API
            static protected $apiProperties = [];
            // db validation, // * validation_options located at: root/private/rules_docs/reference_information.php
            static protected $validation_columns = [
                'id' => [
                    'name' => 'Allergy id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min' => 1, // number min value
                    'max' => 10 // string length
                ],
                'name' => [
                    'name' => 'Allergy Name',
                    'required' => true,
                    'type' => 'str', // type of string
                    'min' => 2, // string length
                    'max' => 35, // string length
                    'html' => 'no' // mostly just to allow special characters like () []
                ]
            ];

        // @ class database information end

        // @ class traits start
            use AllergySql;
            use AllergySeeder;
        // @ class traits end

        // @ class specific queries start
            // TODO-SHAWN: adjust
            static public function get_all_allergies() {
                $sql = "SELECT id, name FROM allergies ";
                return get_key_value_array(self::find_by_sql($sql));    
            }
        // @ class specific queries end
    }
    
?>
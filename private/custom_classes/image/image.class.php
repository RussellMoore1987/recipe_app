<?php
    // include api trait
    require_once("imageSql.trait.php");
//    require_once("tagSeeder.trait.php");

    class Image extends DatabaseObject {
        // @ class database information start
            // Class specific properties. Overwritten from DatabaseObject Class
            // Name of the table
            static protected $tableName = "Images";
            // db columns
            static protected $columns = ['id', 'image_name', 'sort', 'is_featured', 'alt', 'recipe_id'];
            // values to exclude on normal updates, should always include id
            static protected $columnExclusions = ['id'];
            // name specific properties you wish to included in the API
            static protected $apiProperties = [];
            // * collection_type_reference, located at: root/private/rules_docs/reference_information.php
            static protected $collectionTypeReference = 0;
            // db validation, // * validation_options located at: root/private/rules_docs/reference_information.php
            static protected $validation_columns = [
                'id' => [
                    'name' => 'Image id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min' => 1, // number min value
                    'max' => 10 // string length
                ],
                'image_name' => [
                    'name' => 'Image Name',
                    'type' => 'str', // type of string
                    'max' => 25, // string length
                    'html' => 'no'
                ],
                'sort' => [
                    'name' => 'Image Sort Order',
                    'required' => true,
                    'type' => 'int', // type of string
                ],
                'is_featured' => [
                    'name'=>'Tag useTag',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min'=> 0, // number min value
                    'num_max'=> 1, // number max value
                ],
                'alt' => [
                    'name' => 'Image Alt Text',
                    'type' => 'str', // type of string
                    'max' => 50, // string length
                    'html' => 'yes'
                ],
                'recipe_id' => [
                    'name' => 'Image Recipe',
                    'type' => 'int', // type of string                    
                    'max' => 10, // string length
                ],


            ];

        // @ class database information end

        // @ class traits start
            use ImageSql;
        //    use ImageSeeder;
        // @ class traits end

        // @ class specific queries start
            // Find all the  associated with the recipe_id
            static public function find_all_recipe_images(int $recipe = 0) {
                return [];
                $sql = "SELECT id, image_name, sort, is_featured, alt, recipe_id FROM Images ";
                $sql .= "WHERE recipe_id = '{$recipe}'";
                return self::find_by_sql($sql);
            }
        // @ class specific queries end
    }
    
?>
<?php
    // include api trait
    require_once("imageSql.trait.php");
    require_once("imageSeeder.trait.php");
    require_once("imageComponents.trait.php");

    class Image extends DatabaseObject {
        // @ class database information start
            // Class specific properties. Overwritten from DatabaseObject Class
            // Name of the table
            static protected $tableName = "Images";
            // db columns
            static protected $columns = ['id', 'image_name', 'sort', 'is_featured', 'alt', 'recipe_id' ];
            // values to exclude on normal updates, should always include id
            static protected $columnExclusions = ['id'];
            // name specific properties you wish to included in the API
            static protected $apiProperties = [];
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
                    'required' => true,
                    'type' => 'str', // type of string
                    'max' => 25, // string length
                    'min' => 4, // string length
                    'html' => 'no'
                ],
                'sort' => [
                    'name'=>'Image Sort',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min'=> 1, // number min value
                    'num_max'=> 10, // number max value
                    'max' => 25 // string length
                ],
                'is_featured' => [
                    'name'=>'Featured Image',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min'=> 0, // number min value
                    'num_max'=> 1 // number max value
                ],
                'alt' => [
                    'name' => 'Image Alt Tag',
                    'type' => 'str', // type of string
                    'max' => 50, // string length
                    'min' => 2, // string length
                    'html' => 'no'
                ],
                'recipe_id' => [
                    'name' => 'Recipe id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min' => 1, // number min value
                    'max' => 10 // string length
                ]
            ];

        // @ class database information end

        // @ class traits start
            use ImageSql;
            use ImageSeeder;
            use ImageComponents;
        // @ class traits end

        // Find all the  associated with the recipe_id
        static public function find_all_recipe_images(int $recipe = 0) {
            $sql = "SELECT id, image_name, sort, is_featured, alt, recipe_id FROM Images ";
            $sql .= "WHERE recipe_id = $recipe";
            return self::find_by_sql($sql);
        }
    }
    
?>


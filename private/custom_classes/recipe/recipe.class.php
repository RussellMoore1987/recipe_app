<?php
    // include api trait
    // require_once("recipeApi.trait.php");
    require_once("recipeSql.trait.php");
    require_once("recipeSeeder.trait.php");
    require_once("recipeComponents.trait.php");

    class Recipe extends DatabaseObject {
        // @ class database information start
            // table name
            static protected $tableName = "Recipes";
            // db columns
            static protected $columns = ['id', 'title', 'description', 'cook_time', 'prep_time', 'total_time', 'num_serving', 'is_private', 'is_published', 'chef_id', 'directions', 'ingredients', 'main_image', 'average_rating', 'created_date'];
            // values to exclude on normal updates, should always include id
            static protected $columnExclusions = ['id'];
            // name specific class properties you wish to included in the API
            static protected $apiProperties = ['fullDate', 'shortDate'];
            // db validation, // * validation_options located at: root/private/rules_docs/reference_information.php
            static protected $validation_columns = [
                'id'=>[
                    'name'=>'Recipe id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min'=> 1, // number min value
                    'max' => 10 // string length
                ], 
                'title' => [
                    'name'=>'Recipe Title',
                    'required' => true,
                    'type' => 'str', // type of string
                    'min'=> 2, // string length
                    'max' => 50, // string length
                    'html' => 'no'
                ], 
                'description' => [
                    'name'=>'Recipe Description',
                    'type' => 'str', // type of string
                    'min'=> 10, // string length
                    'max' => 255, // string length
                    'html' => 'no'
                ], 
                'cook_time' => [
                    'name'=>'Recipe Cook Time',
                    'type' => 'int', // type of int
                    'num_min'=> 1, // number min value
                    'num_max'=> 65535, // number max value
                    'max' => 5 // string length
                ], 
                'prep_time' => [
                    'name'=>'Recipe Prep Time',
                    'type' => 'int', // type of int
                    'num_min'=> 1, // number min value
                    'num_max'=> 65535, // number max value
                    'max' => 5 // string length
                ], 
                'total_time' => [
                    'name'=>'Recipe Total Time',
                    'type' => 'int', // type of int
                    'num_min'=> 1, // number min value
                    'num_max'=> 65535, // number max value
                    'max' => 5 // string length
                ], 
                'num_serving' => [
                    'name'=>'Recipe Number of Servings',
                    'type' => 'int', // type of int
                    'num_min'=> 1, // number min value
                    'num_max'=> 255, // number max value
                    'max' => 3 // string length
                ], 
                'is_private' => [
                    'name'=>'Recipe Is Private',
                    'type' => 'int', // type of int
                    'num_min'=> 0, // number min value
                    'num_max'=> 1, // number max value
                    'max' => 1 // string length
                ], 
                'is_published' => [
                    'name'=>'Recipe Is Published',
                    'type' => 'int', // type of int
                    'num_min'=> 0, // number min value
                    'num_max'=> 1, // number max value
                    'max' => 1 // string length
                ], 
                'chef_id' => [
                    'name'=>'Recipe Chef id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min'=> 1, // number min value
                    'max' => 10 // string length
                ], 
                'directions' => [
                    'name'=>'Recipe Directions',
                    'required' => true,
                    'type' => 'str', // type of string
                    'min'=> 10, // string length
                    'max' => 65000, // string length
                    'html' => 'full'
                ], 
                'ingredients' => [
                    'name'=>'Recipe Ingredients',
                    'required' => true,
                    'type' => 'str', // type of string
                    'min'=> 2, // string length
                    'max' => 65000, // string length
                    'html' => 'full'
                ], 
                'main_image' => [
                    'name'=>'Recipe Main Image',
                    'type' => 'str', // type of string
                    'min'=> 2, // string length
                    'max' => 25, // string length
                    'html' => 'no'
                ], 
                'average_rating' => [
                    'name'=>'Recipe Average Rating',
                    'type' => 'num', // type of number
                    'num_min'=> 0, // number min value
                    'num_max'=> 5, // number max value
                    'max' => 3 // string length
                ], 
                'created_date' => [
                    'name'=>'Recipe Created Date',
                    'required' => true,
                    'type' => 'str', // type of string
                    'exact' => 10, // string length
                    'date' => true
                ]
            ];
        // @ class database information end
        
        // @ class traits start
            // use RecipeApi;
            use RecipeSql;
            use RecipeSeeder;
            use RecipeComponents;
        // @ class traits end
        
        // @ class specific queries start
            
        // @ class specific queries end
        
        // @ methods start
            // extra constructor information
            public function extended_constructor(array $args=[]) {
                // Format dates 
                if (isset($args['created_date']) && strlen(trim($args['created_date'])) > 0) {
                    // Turn date to time string
                    $recipeDateStr = strtotime($args['created_date']);
                    // set date types
                    $shortDate = date("m/d/Y", $recipeDateStr);
                    $recipeFullDate = date("F d, Y", $recipeDateStr);
                    // set dates
                    // database date
                    $this->created_date = date("Y-m-d", $recipeDateStr);
                    // abbreviated date
                    $this->shortDate = $shortDate;
                    // nicely formatted date
                    $this->fullDate = $recipeFullDate;
                } else {
                    // No date was found set defaults
                    $this->created_date = NULL;
                    $this->shortDate = NULL;
                    $this->fullDate = NULL;
                } 
            }

            // get image path with recorded reference image name
            public function get_image_path($type = 'small') {
                // get path // * image_paths located at: root/private/rules_docs/reference_information.php
                $path = get_image_path($type);
                // return image path with name
                return "{$path}/{$this->main_image}";
            }

            // TODO-SHAWN: Do I need???
            public function class_clean_up_update(array $array = []){
                // check properties, only update necessary ones 
                // echo "class_clean_up_update info ***********";
                // var_dump($array); 
                // check to see if catIds were passed in
                if (isset($array['catIds'])) {
                    // check to see if the new list and the old list are the same
                    if (!($array['catIds'] == $array['catIdsOld'])) {
                        // delete all old connections
                        $this->delete_connection_records("recipestocategories", "recipe_id", $array['id']);
                        // if string is blank don't update
                        if (!(is_blank($array['catIds']))) {
                            // make the id list into an array
                            $id_array = explode(",", $array['catIds']);
                            // loop through and make a record for each id
                            foreach ($id_array as $value) {
                                $this->insert_connection_record("recipestocategories", ["recipe_id", "cat_id"], [$array['id'], $value]);
                            }
                            // echo "updated!!! posts_to_categories *********** <br>";
                        }
                    } 
                }
                // check to see if allergyIds were passed in
                if (isset($array['allergyIds'])) {
                    // check to see if the new list and the old list are the same
                    if (!($array['allergyIds'] == $array['allergyIdsOld'])) {
                        // delete all old connections 
                        $this->delete_connection_records("recipestoallergies", "recipe_id", $array['id']);
                        // if string is blank don't update
                        if (!(is_blank($array['allergyIds']))) {
                            // make the id list into an array
                            $id_array = explode(",", $array['allergyIds']);
                            // loop through and make a record for each id
                            foreach ($id_array as $value) {
                                $this->insert_connection_record("recipestoallergies", ["recipe_id", "allergy_id"], [$array['id'], $value]);
                            }
                             //echo "updated!!! posts_to_labels *********** <br>";
                        }
                    } 
                }

                // check to see if tagIds were passed in
                if (isset($array['tagIds'])) {
                    // check to see if the new list and the old list are the same
                    if (!($array['tagIds'] == $array['tagIdsOld'])) {
                        // delete all old connections 
                        $this->delete_connection_records("recipestotags", "recipe_id", $array['id']);
                        // if string is blank don't update
                        if (!(is_blank($array['tagIds']))) {
                            // make the id list into an array
                            $id_array = explode(",", $array['tagIds']);
                            // loop through and make a record for each id
                            foreach ($id_array as $value) {
                                $this->insert_connection_record("recipestotags", ["recipe_id", "tag_id"], [$array['id'], $value]);
                            }
                            // echo "updated!!! posts_to_tags *********** <br>";
                        }
                    } 
                }
            }

            // get all extended info
            public function get_extended_info() {
                // empty array to hold potential extended information
                $extendedInfo_array = [];
                // get tags
                $extendedInfo_array['tags'] = $this->get_recipe_tags();
                // get categories
                $extendedInfo_array['categories'] = $this->get_recipe_categories();
                // get allergies
                $extendedInfo_array['allergies'] = $this->get_recipe_allergies();
                // return data
                return $extendedInfo_array;    
            }

            // get tags, main queries for editing
            public function get_recipe_tags() {
                $sql = "SELECT t.id, t.name ";
                $sql .= "FROM tags AS t ";
                $sql .= "INNER JOIN recipestotags AS rtt ";
                $sql .= "ON rtt.tag_id = t.id ";
                $sql .= "WHERE rtt.recipe_id = '" . self::db_escape($this->id) . "' ";
                // return data
                return Tag::find_by_sql($sql);     
            }      
            public function get_recipe_categories() {
                $sql = "SELECT c.id, c.name ";
                $sql .= "FROM categories AS c ";
                $sql .= "INNER JOIN recipestocategories AS rtc ";
                $sql .= "ON rtc.cat_id = c.id ";
                $sql .= "WHERE rtc.recipe_id = '" . self::db_escape($this->id) . "' ";
                // return data
                return Category::find_by_sql($sql);     
            }  
            public function get_recipe_allergies() {
                $sql = "SELECT a.id, a.name ";
                $sql .= "FROM allergies AS a ";
                $sql .= "INNER JOIN recipestoallergies AS rta ";
                $sql .= "ON rta.allergy_id = a.id ";
                $sql .= "WHERE rta.recipe_id = '" . self::db_escape($this->id) . "' ";
                // return data
                return Allergy::find_by_sql($sql);     
            }        
        // @ methods end
    }
?>
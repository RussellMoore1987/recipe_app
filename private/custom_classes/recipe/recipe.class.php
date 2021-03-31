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
            // Dynamic recipe searching
            public static function recipe_search(int $chefId, array $cookTime = [], array $stars = [], array $favorites = [], array $categories = [], array $tags = [], array $allergies = [], array $prepTime = [])
            {
                $sql = "SELECT DISTINCT r.id, r.title, r.description, r.main_image, r.average_rating \n";
                $sql .= "FROM recipes r \n";
                if(count($categories) > 0){
                    $sql .= "JOIN recipestocategories rc ON r.id = rc.recipe_id \n";
                    $sql .= "JOIN categories c ON c.id = rc.cat_id \n";
                }
                if(count($tags) > 0){
                    $sql .= "JOIN recipestotags rt ON r.id = rt.recipe_id \n";
                    $sql .= "JOIN tags t ON t.id = rt.tag_id \n";
                }
                if(count($allergies) > 0){
                    $sql .= "JOIN recipestoallergies ra ON r.id = ra.recipe_id \n";
                    $sql .= "JOIN allergies a ON a.id = ra.allergy_id \n";
                }
                if(count($favorites) > 0) {
                    $sql .= "JOIN myFavorites f ON r.id = f.recipe_id \n";
                }
                $sql .= "WHERE r.is_private = 0 OR r.chef_id = $chefId \n";
                if (count($cookTime) > 0) {
                    $sql .= "AND r.cook_time BETWEEN $cookTime[0] AND $cookTime[1] \n";
                }
                if (count($stars) > 0) {
                    $sql .= "AND r.average_rating BETWEEN $stars[0] AND $stars[1]\n";            
                }
                if (count($favorites) > 0) {
                    $sql .= "AND f.chef_id = $chefId \n";
                }
                if (count($categories) > 0) {
                    $inVals = "";
                    foreach($categories as $val){
                        $inVals .= "$val,";
                    }
                // @ methods end
                    $inVals = rtrim($inVals, ',');
                    $sql .= "AND c.id IN ($inVals) \n";
                }
                if (count($tags) > 0) {
                    $inVals = "";
                    foreach($tags as $val){
                        $inVals .= "$val,";
                    }
                    $inVals = rtrim($inVals, ',');
                    $sql .= "AND t.id IN ($inVals) \n";
                }
                if (count($allergies) > 0) {
                    $inVals = "";
                    foreach($allergies as $val){
                        $inVals .= "$val,";
                    }
                    $inVals = rtrim($inVals, ',');
                    $sql .= "AND a.id IN ($inVals) \n";
                }
                if (count($prepTime) > 0) {
                    $sql .= "AND r.prep_time BETWEEN $prepTime[0] AND $prepTime[1] \n";
                }

                // printf('<pre>' . $sql . '</pre>');
                return self::find_by_sql($sql);
            }
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
        // @ methods end
    }
?>
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
            public static function recipe_search(array $sqlOptions = []) {
                // TODO: remove all echoes and var dumps
                // setting up default parameters 
                $chefId = $_SESSION['id'];
                // TODO: add searchBy, text search
                $searchBy = $_GET['searchBy'] ?? '';
                $sortBy = isset($_GET['sortBy']) ? explode(',', $_GET['sortBy']) : [];
                $cookTime = isset($_GET['cookTime']) ? explode(',', $_GET['cookTime']) : [];
                $stars = $_GET['stars'] ?? [];
                $myFavorites = $_GET['myFavorites'] ?? '';
                $tryLater = $_GET['tryLater'] ?? '';
                $categories = isset($_GET['categories']) ? explode(',', $_GET['categories']) : [];
                $tags = isset($_GET['tags']) ? explode(',', $_GET['tags']) : [];
                $allergies = isset($_GET['allergies']) ? explode(',', $_GET['allergies']) : [];
                $prepTime = isset($_GET['prepTime']) ? explode(',', $_GET['prepTime']) : [];
                $totalTime = isset($_GET['totalTime']) ? explode(',', $_GET['totalTime']) : [];
                // TODO: validate, need to increase testing later on but for right now just do some simple testing for basic things that we need
                if ($prepTime) {$prepTime = self::range_of_numbers($prepTime);}
                if ($cookTime) {$cookTime = self::range_of_numbers($cookTime);}
                if ($totalTime) {$totalTime = self::range_of_numbers($totalTime);}
                if ($stars) {$stars = (int) $stars;}
                if ($categories) {$categories = self::array_of_numbers($categories);}
                if ($tags) {$tags = self::array_of_numbers($tags);}
                if ($allergies) {$allergies = self::array_of_numbers($allergies);}
                // validate sort by options
                if ($sortBy) {
                    $sortBy = self::validate_sort_by_options($sortBy);
                    if ($sortBy) {
                        // add to $sqlOptions['sortingOptions']
                        $sqlOptions['sortingOptions'] = $sqlOptions['sortingOptions'] ?? [];
                        $sqlOptions['sortingOptions'] = array_merge($sortBy,$sqlOptions['sortingOptions']);
                        // add ORDER BY
                        array_unshift($sqlOptions['sortingOptions'], 'ORDER BY ');
                    }
                }

                // prepare the SQL, borrowed code from find where
                // get options
                    // check to see if the array is empty
                    $columnOptions_array = $sqlOptions['columnOptions'] ?? ["*"];
                    $whereOptions_array = $sqlOptions['whereOptions'] ?? [];
                    $sortingOptions_array = $sqlOptions['sortingOptions'] ?? [];

                    // check for regular string coming in, set to whereOptions_array
                    if (!(is_array($sqlOptions) && (isset($sqlOptions['columnOptions']) || isset($sqlOptions['whereOptions']) || isset($sqlOptions['sortingOptions'])))) {
                        // set whereOptions_array
                        $whereOptions_array = $sqlOptions;
                    }

                    // make sure we're getting what we think were getting, need arrays, if strings passed and switched into arrays
                    if (!is_array($columnOptions_array)) { $columnOptions_array = explode(",", $columnOptions_array); }
                    if (!is_array($whereOptions_array)) { $whereOptions_array = explode(",", $whereOptions_array); }
                    if (!is_array($sortingOptions_array)) { $sortingOptions_array = explode(",", $sortingOptions_array); }

                    // make sure that all column options are abbreviated with r.
                    if (!in_array("*", $columnOptions_array)) {
                        foreach ($columnOptions_array as $column) {
                            $temp_array[] = "r.{$column}";
                        }
                        $columnOptions_array = $temp_array;
                    }
                // Begin building the SQL
                    // build SELECT
                    $sql = "SELECT DISTINCT r.id, " . implode(", ", $columnOptions_array) . " ";

                    // build FROM
                    $sql .= "FROM " . static::$tableName . " AS r ";

                    // see if we need to do joins, and adding possible where clauses
                        if($categories){
                            $sql .= "INNER JOIN RecipesToCategories AS rc ON r.id = rc.recipe_id ";
                            $sql .= "INNER JOIN Categories AS c ON c.id = rc.cat_id ";
                            $categoryIds = implode(',',$categories);
                            $whereOptions_array[] = "c.id IN ({$categoryIds})"; 
                        }
                        if($tags){
                            $sql .= "INNER JOIN RecipesToTags AS rt ON r.id = rt.recipe_id ";
                            $sql .= "INNER JOIN Tags AS t ON t.id = rt.tag_id ";
                            $tagIds = implode(',', $tags);
                            $whereOptions_array[] = "t.id IN ({$tagIds})"; 
                        }
                        if($allergies){
                            $sql .= "INNER JOIN RecipesToAllergies AS ra ON r.id = ra.recipe_id ";
                            $sql .= "INNER JOIN Allergies AS a ON a.id = ra.allergy_id ";
                            $allergyIds = implode(',', $allergies);
                            $whereOptions_array[] = "a.id IN ({$allergyIds})";
                        }
                        if($myFavorites) {
                            $sql .= "INNER JOIN MyFavorites AS f ON r.id = f.recipe_id ";
                            $whereOptions_array[] = "f.chef_id = {$chefId}";
                        }
                        if($tryLater) {
                            $sql .= "INNER JOIN TryLater AS tl ON r.id = tl.recipe_id ";
                            $whereOptions_array[] = "tl.chef_id = {$chefId}";
                        }
                    // add some wheres
                        // where is not privet except mine
                        $whereOptions_array[] = "(r.is_private = 0 OR r.chef_id = {$chefId})";
                        // get recipes that are published
                        $whereOptions_array[] = "r.is_published = 1";
                        if ($cookTime) {
                            $whereOptions_array[] = "(r.cook_time BETWEEN {$cookTime[0]} AND {$cookTime[1]})";
                        }
                        if ($stars) {
                            $whereOptions_array[] = "r.average_rating >= {$stars}";            
                        }
                        if ($prepTime) {
                            $whereOptions_array[] = "(r.prep_time BETWEEN {$prepTime[0]} AND {$prepTime[1]})";
                        }
                        if ($totalTime) {
                            $whereOptions_array[] = "(r.total_time BETWEEN {$totalTime[0]} AND {$totalTime[1]})";
                        }
                        if ($searchBy) {
                            $searchBy = DatabaseObject::db_escape($searchBy);
                            $searchBySql = "(r.title LIKE '%{$searchBy}%' OR ";
                            $searchBySql .= "r.description LIKE '%{$searchBy}%' OR ";
                            $searchBySql .= "r.directions LIKE '%{$searchBy}%')";
                            $whereOptions_array[] = $searchBySql;
                        }

                    // build WHERE, make sure to check whether it is an AND or an OR statement, AND by default OR has to be specified
                    for ($i=0; $i < count($whereOptions_array); $i++) { 
                        // add WHERE
                        if ($i == 0) { $sql .= "WHERE "; }
                        // set option
                        $whereConnector = "AND";
                        $whereOption = $whereOptions_array[$i];
                        // check to see if it is an OR or AND
                        if (strpos($whereOption, "::OR")) {
                            $whereConnector = "OR";
                            // remove the ::OR
                            $whereOption = str_replace("::OR", "", $whereOption);
                        }
                        // add WHERE option
                        $sql .= $whereOption;
                        // add AND or OR or end
                        if (!($i >= count($whereOptions_array) - 1)) { $sql .= " {$whereConnector} "; } else { $sql .= " "; }
                    }

                    // Add the sorting options if defined
                    foreach($sortingOptions_array as $option) {
                        $sql .= "{$option} ";
                    }

                // make the query
                // var_dump($sql);
                // echo $sql;
                $result = static::find_by_sql($sql);
                // var_dump($result);
                // return the data
                return $result;
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

        // @ class helper functions start
            // this is a helper function for the main search, makes sure that Pacific input is a range otherwise sets defaults 
            static public function range_of_numbers(array $rangeOfNumbers=[0,120]) {
                // make sure you have a range otherwise set defaults
                if (!(count($rangeOfNumbers) == 2)) {
                    // Run as default
                    $rangeOfNumbers = [0,120];
                }
                if (!is_numeric($rangeOfNumbers[0])) {
                    $rangeOfNumbers[0] = 0;
                }
                if (!is_numeric($rangeOfNumbers[1])) {
                    $rangeOfNumbers[1] = 120;
                }

                return $rangeOfNumbers;
            }

            // checks to make sure all the items are a number
            static public function array_of_numbers(array $arrayOfNumbers=[]) {
                // make sure each item in the array is numeric otherwise take it out
                $temp_array = [];
                foreach ($arrayOfNumbers as $num) {
                    if (is_numeric($num)) {
                        $temp_array[] = (int) $num;
                    }
                }

                // return data
                return $temp_array;
            }

             // checks, validates, and builds sort by options
             static public function validate_sort_by_options(array $sortByOptions=[]) {
                // available sort by options
                $sortOptions = ['title', 'stars', 'prepTime', 'cookTime', 'totalTime'];
                $temp_array = [];
                foreach ($sortByOptions as $sortOption) {
                    $ascendingOrder = '';
                    if (contains($sortOption, '::')) {
                        $parts = explode("::", $sortOption);
                        $sortOption = $parts[0];
                        if ($parts[1] == 'highToLow') {
                            $ascendingOrder = ' DESC';
                        }
                    }
                    if (in_array($sortOption, $sortOptions)) {
                        switch ($sortOption) {
                            case 'title': $temp_array[] = 'r.title' . $ascendingOrder; break;
                            case 'stars': $temp_array[] = 'r.average_rating' . $ascendingOrder; break;
                            case 'prepTime': $temp_array[] = 'r.prep_time' . $ascendingOrder; break;
                            case 'cookTime': $temp_array[] = 'r.cook_time' . $ascendingOrder; break;
                            case 'totalTime': $temp_array[] = 'r.total_time' . $ascendingOrder; break;
                        }
                    }
                }

                // add on comas
                $sortByOptions = [];
                foreach ($temp_array as $sortOption) {
                    if (end($temp_array) == $sortOption) {
                        $sortByOptions[] = $sortOption;
                    } else {
                        $sortByOptions[] = $sortOption . ',';
                    }
                }

                // return data
                return $sortByOptions;
            }
        // @ class helper functions end
    }
?>
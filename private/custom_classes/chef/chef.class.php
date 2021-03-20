<?php
    // include api trait
    require_once("chefSql.trait.php");
    require_once("chefSeeder.trait.php");

    class Chef extends DatabaseObject {
        // @ class database information start
            // Class specific properties. Overwritten from DatabaseObject Class
            // Name of the table
            static protected $tableName = "chefs";
            // db columns
            static protected $columns = ['id', 'name', 'email', 'hashed_password', 'chef_type', 'created_by_chef_id', 'is_active'];
            // values to exclude on normal updates, should always include id
            static protected $columnExclusions = ['id'];
            // name specific properties you wish to included in the API
            static protected $apiProperties = [];
            // db validation, // * validation_options located at: root/private/rules_docs/reference_information.php
            static protected $validation_columns = [
                'id' => [
                    'name' => 'Chef id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min' => 1, // number min value
                    'max' => 10 // string length
                ],
                'name' => [
                    'name' => 'Chef Name',
                    'required' => true,
                    'type' => 'str', // type of string
                    'min' => 2, // string length
                    'max' => 50, // string length
                    'html' => 'no' // mostly just to allow special characters like () []
                ],
                'email' => [
                    'name' => 'Chef Email',
                    'type' => 'str', // type of string
                    'min' => 8, // string length
                    'max' => 150, // string length
                    'html' => 'no'
                ],
                // TODO: test to see if we can cause problems
                'hashed_password' => [
                    'name' => 'Chef Password',
                    'required' => true,
                    'type' => 'str', // type of string
                    'min' => 2, // string length
                    'max' => 80, // string length
                    // TODO: add in ability to validate
                    'password' => 'yes',
                    'html' => 'full' // mostly just to allow special characters like () []
                ],
                'chef_type' => [
                    'name'=>'Chef Type',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min'=> 1, // number min value
                    'num_max'=> 3, // number max value
                ],
                'created_by_chef_id' => [
                    'name' => 'Created By Chef id',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min' => 0, // number min value
                    'max' => 10 // string length
                ],
                'is_active' => [
                    'name'=>'Chef is Active',
                    'required' => true,
                    'type' => 'int', // type of int
                    'num_min'=> 0, // number min value
                    'num_max'=> 1, // number max value
                ]               
            ];

        // @ class database information end

        // @ class traits start
            use ChefSql;
            use ChefSeeder;
        // @ class traits end
        
        // @ class specific queries start
        static public function get_theme_info(int $id = 0) {
            // check to see if this item exists
            $sql = "
                SELECT login_logo, header_logo, app_icon, theme_color
                FROM HeadChefData
                WHERE head_chef_id = {$id}
            ";
            $result = self::run_sql($sql);

            // get info from result, loop through query
            $themeInfo = [];
            while ($record = $result->fetch_assoc()) {
                $themeInfo['login_logo'] = $record['login_logo'];    
                $themeInfo['header_logo'] = $record['header_logo'];    
                $themeInfo['app_icon'] = $record['app_icon'];    
                $themeInfo['theme_color'] = $record['theme_color'];    
            }

            // check to see if we need to set any default theme items
            $themeInfo['login_logo'] = $themeInfo['login_logo'] ?? 'login_logo.png';    
            $themeInfo['header_logo'] = $themeInfo['header_logo'] ?? 'header_logo.png';    
            $themeInfo['app_icon'] = $themeInfo['app_icon'] ?? 'app_icon.ico';    
            $themeInfo['theme_color'] = $themeInfo['theme_color'] ?? '#B2A57C';

            // return data
            return $themeInfo;
        }

        // @ class specific queries end

    }
    
?>


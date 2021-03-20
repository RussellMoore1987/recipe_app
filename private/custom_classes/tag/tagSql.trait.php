<?php
    trait TagSql {
        // Main SQL Structure
        static protected $sqlStructure = "
            CREATE TABLE IF NOT EXISTS `Tags` (
                id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name varchar(35) UNIQUE NOT NULL
            ) ENGINE=InnoDB;
        ";

         // connecting tables
         static protected $otherTables = [
            "RecipesToTags" => "
                CREATE TABLE IF NOT EXISTS `RecipesToTags` ( 
                    tag_id int UNSIGNED NOT NULL,
                    recipe_id int UNSIGNED NOT NULL,
                    PRIMARY KEY (tag_id, recipe_id),
                    FOREIGN KEY (tag_id) REFERENCES Tags(id) ON DELETE CASCADE,
                    FOREIGN KEY(recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE
                ) ENGINE=InnoDB
            "
        ];
    }
?>



    

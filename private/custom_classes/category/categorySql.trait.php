<?php
    trait CategorySql {
        // Main SQL Structure
        static protected $sqlStructure = "
            CREATE TABLE IF NOT EXISTS `Categories` (
                id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name varchar(35) UNIQUE NOT NULL
            ) ENGINE=InnoDB;
        ";

        // connecting tables
        static protected $otherTables = [
            "RecipesToCategories" => "
                CREATE TABLE IF NOT EXISTS `RecipesToCategories` ( 
                    cat_id int UNSIGNED NOT NULL,
                    recipe_id int UNSIGNED NOT NULL,
                    PRIMARY KEY (cat_id, recipe_id),
                    FOREIGN KEY (cat_id) REFERENCES Categories(id) ON DELETE CASCADE,
                    FOREIGN KEY(recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE
                ) ENGINE=InnoDB
            "
        ];
    }
?>   
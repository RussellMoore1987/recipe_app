<?php
    trait CookbookSql {
        // Main SQL Structure
        static protected $sqlStructure = "
            CREATE TABLE IF NOT EXISTS `Cookbooks` (
                id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                title varchar(50) NOT NULL,
                chef_id int UNSIGNED NOT NULL,
                is_private tinyint(1) DEFAULT 0,
                cookbook_image varchar(25),
                FOREIGN KEY(chef_id) REFERENCES Chefs(id) ON DELETE CASCADE
            ) ENGINE=InnoDB;
        ";

        // connecting tables
        static protected $otherTables = [
            "CookbooksToRecipes" => "
                CREATE TABLE IF NOT EXISTS `CookbooksToRecipes` ( 
                    cookbook_id int UNSIGNED NOT NULL,
                    recipe_id int UNSIGNED NOT NULL,
                    PRIMARY KEY (cookbook_id, recipe_id),
                    FOREIGN KEY (cookbook_id) REFERENCES Cookbooks(id) ON DELETE CASCADE,
                    FOREIGN KEY(recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE
                ) ENGINE=InnoDB
            "
        ];
    }
?>
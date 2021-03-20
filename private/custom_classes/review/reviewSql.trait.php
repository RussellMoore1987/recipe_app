<?php
    trait ReviewSql {
        // Main SQL Structure
        static protected $sqlStructure = "
            CREATE TABLE IF NOT EXISTS `Reviews` (
                id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                title varchar(25),	
                review varchar(255),
                rating tinyint(1) NOT NULL,
                recipe_id int UNSIGNED NOT NULL,	
                chef_id int UNSIGNED NOT NULL,
                FOREIGN KEY (recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE,
                FOREIGN KEY(chef_id) REFERENCES Chefs(id) ON DELETE CASCADE	
            ) ENGINE=InnoDB;
        ";
    }
?>

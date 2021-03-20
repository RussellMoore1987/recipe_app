<?php
    trait ImageSql {
        // Main SQL Structure
        static protected $sqlStructure = "
            CREATE TABLE IF NOT EXISTS `Images` (
                id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                image_name varchar(25) NOT NULL,
                sort tinyint(1) DEFAULT 10,
                is_featured tinyint(1) DEFAULT 0,
                alt varchar(50),
                recipe_id int UNSIGNED NOT NULL,
                FOREIGN KEY(recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE
            ) ENGINE=InnoDB;
        ";
    }
?>

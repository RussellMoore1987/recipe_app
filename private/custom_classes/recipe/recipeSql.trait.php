<?php
    trait RecipeSql {
        // Main SQL Structure
        static protected $sqlStructure = "
            CREATE TABLE IF NOT EXISTS Recipes (
                id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                title varchar(50) NOT NULL, 
                description varchar(255),
                cook_time tinyint(1),
                prep_time tinyint(1),
                total_time tinyint(1),
                num_serving tinyint(1),
                is_private tinyint(1) DEFAULT 0,
                status tinyint(1) DEFAULT 1,
                chef_id int unsigned NOT NULL,
                directions TEXT NOT NULL,
                ingredients JSON NOT NULL,
                main_image varchar(25),
                average_rating decimal(2,1)	DEFAULT 0,
                created_date DATE NOT NULL
            ) ENGINE=InnoDB
        ";
    }
?>
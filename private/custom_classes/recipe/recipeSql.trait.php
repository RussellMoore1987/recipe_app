<?php
    trait RecipeSql {
        // Main SQL Structure
        static protected $sqlStructure = "
            CREATE TABLE IF NOT EXISTS Recipes (
                id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                title varchar(50) NOT NULL, 
                description varchar(255),
                cook_time smallint,
                prep_time smallint,
                total_time smallint,
                num_serving tinyint(1),
                is_private tinyint(1) DEFAULT 0,
                is_published tinyint(1) DEFAULT 1,
                chef_id int unsigned NOT NULL,
                directions TEXT NOT NULL,
                ingredients JSON NOT NULL,
                main_image varchar(25),
                average_rating decimal(2,1)	DEFAULT 0,
                created_date DATE NOT NULL,
                KEY chef_id (chef_id),
                KEY cook_time (cook_time),
                KEY prep_time (prep_time),
                KEY average_rating (average_rating),
                KEY total_time (total_time),
                KEY is_published (is_published),
                KEY is_private (is_private),
                FOREIGN KEY(chef_id) REFERENCES Chefs(id) ON DELETE CASCADE
            ) ENGINE=InnoDB
        ";

        // connecting tables
        static protected $otherTables = [
            "TryLater" => "
                CREATE TABLE IF NOT EXISTS TryLater ( 
                    chef_id int UNSIGNED NOT NULL,
                    recipe_id int UNSIGNED NOT NULL,
                    PRIMARY KEY (chef_id, recipe_id),
                    FOREIGN KEY(chef_id) REFERENCES Chefs(id) ON DELETE CASCADE,
                    FOREIGN KEY (recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE 
                ) ENGINE=InnoDB
            ",
            "MyFavorites" => "
                CREATE TABLE IF NOT EXISTS MyFavorites ( 
                    chef_id int UNSIGNED NOT NULL,
                    recipe_id int UNSIGNED NOT NULL,
                    PRIMARY KEY (chef_id, recipe_id),
                    FOREIGN KEY(chef_id) REFERENCES Chefs(id) ON DELETE CASCADE,
                    FOREIGN KEY (recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE 
                ) ENGINE=InnoDB
            "
        ];
    }
?>
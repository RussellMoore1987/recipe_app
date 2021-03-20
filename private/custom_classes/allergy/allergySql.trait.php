<?php
    trait AllergySql {
        // Main SQL Structure
        static protected $sqlStructure = "
            CREATE TABLE IF NOT EXISTS `Allergies` (
                id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name varchar(35) UNIQUE NOT NULL
            ) ENGINE=InnoDB;
        ";

        // connecting tables
        static protected $otherTables = [
            "RecipesToAllergies" => "
                CREATE TABLE IF NOT EXISTS `RecipesToAllergies` ( 
                    allergy_id int UNSIGNED NOT NULL,
                    recipe_id int UNSIGNED NOT NULL,
                    PRIMARY KEY (allergy_id, recipe_id),
                    FOREIGN KEY (allergy_id) REFERENCES Allergies(id) ON DELETE CASCADE,
                    FOREIGN KEY(recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE
                ) ENGINE=InnoDB
            "
        ];
    }
?>

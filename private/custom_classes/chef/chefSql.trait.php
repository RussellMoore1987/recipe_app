<?php
    trait ChefSql {
        // Main SQL Structure
        static protected $sqlStructure = "
            CREATE TABLE IF NOT EXISTS Chefs (
                id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name varchar(50) NOT NULL,
                email varchar(150) UNIQUE NOT NULL,
                hashed_password varchar(80) NOT NULL,
                chef_type tinyint(1) NOT NULL DEFAULT 3,
                created_by_chef_id int UNSIGNED DEFAULT 0,
                is_active tinyint(1) DEFAULT 1,
                KEY name (name)
            ) ENGINE=InnoDB;
        ";

        // connecting tables
        static protected $otherTables = [
            "HeadChefData" => "
                CREATE TABLE IF NOT EXISTS HeadChefData ( 
                    head_chef_id int UNSIGNED NOT NULL PRIMARY KEY,
                    login_logo varchar(30),
                    header_logo varchar(30),
                    app_icon varchar(30),
                    theme_color varchar(7),
                    FOREIGN KEY (head_chef_id) REFERENCES Chefs(id) ON DELETE CASCADE 
                ) ENGINE=InnoDB
            "
        ];
    }
?>

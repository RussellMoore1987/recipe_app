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
            ",
            "insertUserMainChef1" => '
                INSERT INTO Chefs (name, email, hashed_password, chef_type, created_by_chef_id, is_active)
                VALUES (\'Russell Moore\', \'truthandgoodness87@gmail.com\', \'$2y$10$YXhJaRzpd48K9ynspshTEOg.E9aVd/0.Gb5m3B8B4Iaus2zlGV7/.\', 1, 0, 1)
            ',
            "insertUserMainChef2" => '
                INSERT INTO Chefs (name, email, hashed_password, chef_type, created_by_chef_id, is_active)
                VALUES (\'Charles Swann\', \'charles@swanhaven.co\', \'$2y$10$MNH6ic1ZiyKrtIyP4kQn6e3NgkeJvoBAY.33E.yCIuRdNg1.nLlcO\', 1, 1, 1)
            ',
            "insertUserMainChef3" => '
                INSERT INTO Chefs (name, email, hashed_password, chef_type, created_by_chef_id, is_active)
                VALUES (\'Test Dev\', \'testdev@gmail.com\', \'$2y$10$SX2WWO8yPR0V7/l29U5QzuLD/RYV.7LGesA6KpgWwkLL0z..s9/HK\', 1, 1, 1)
            ',
            "insertConnectingTableInfo1" => "
                INSERT INTO HeadChefData (head_chef_id, login_logo, header_logo, app_icon, theme_color)
                VALUES (1, 'login_logo_1.png', 'header_logo_1.png', 'app_icon_1.ico', '#EA453D')
            ",
            "insertConnectingTableInfo2" => "
                INSERT INTO HeadChefData (head_chef_id, login_logo, header_logo, app_icon, theme_color)
                VALUES (2, 'login_logo_2.png', 'header_logo_2.png', 'app_icon_2.ico', '#608171')
            "
        ];
    }
?>

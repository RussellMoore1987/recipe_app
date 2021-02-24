CREATE TABLE Chefs (
    id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    email varchar(150) NOT NULL,
    hashed_password varchar(150) NOT NULL,
    chef_type tinyint(1) NOT NULL DEFAULT 3,
    created_by_chef_id int unsigned DEFAULT 0,
    KEY name (name),
    KEY email (email),
    -- ! Start Here ****************************************************
    FOREIGN KEY(column_name) REFERENCES table_name(column_name) ON DELETE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS Recipes;
CREATE TABLE Recipes (
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
) ENGINE=InnoDB;

SHOW TABLES;
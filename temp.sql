










-- Список Дел:
    -- testing to make sure all Cascade deletes work
    -- x chef 
    --     class
    --     sql
    --     seeder
    -- x recipe
    --     class
    --     sql
    --     seeder
    -- x image
    --     class
    --     sql
    --     seeder
    -- x review
    --     class
    --     sql
    --     seeder
    -- x cookbook
    --     class
    --     sql
    --     seeder
    -- x tag
    --     class
    --     sql
    --     seeder
    -- x category
    --     class
    --     sql
    --     seeder
    -- x allergy
    --     x class
    --     x sql
    --     x seeder

-- @ Chefs
CREATE TABLE IF NOT EXISTS Chefs (
    id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    email varchar(150) UNIQUE  NOT NULL,
    hashed_password varchar(150) NOT NULL,
    chef_type tinyint(1) NOT NULL DEFAULT 3,
    created_by_chef_id int UNSIGNED DEFAULT 0,
    is_active tinyint(1) DEFAULT 1,
    KEY name (name),
    KEY email (email)
) ENGINE=InnoDB;

    CREATE TABLE IF NOT EXISTS HeadChefData ( 
        head_chef_id int UNSIGNED NOT NULL PRIMARY KEY,
        login_logo varchar(30),
        header_logo varchar(30),
        app_icon varchar(30),
        theme_color varchar(7),
        FOREIGN KEY (head_chef_id) REFERENCES Chefs(id) ON DELETE CASCADE 
    ) ENGINE=InnoDB

    -- Note: make default theme so that if we delete a head chef the chefs underneath him/her have somewhere else to go according to a theme

-- @ Recipes
CREATE TABLE IF NOT EXISTS Recipes (
    id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(50) NOT NULL, 
    description varchar(255),
    cook_time tinyint(1),
    prep_time tinyint(1),
    total_time tinyint(1),
    num_serving tinyint(1),
    is_private tinyint(1) DEFAULT 0,
    is_published tinyint(1) DEFAULT 1,
    chef_id int UNSIGNED NOT NULL,
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
) ENGINE=InnoDB;

    -- Note: the ability to look at draft recipes is not in the layout yet
        -- help tooltips to explain what each field is and does

-- @ Images
CREATE TABLE IF NOT EXISTS Images (
    id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    image_name varchar(25) NOT NULL,
    sort tinyint(1) DEFAULT 10,
    is_featured tinyint(1) DEFAULT 0,
    alt varchar(50),
    recipe_id int UNSIGNED NOT NULL,
    FOREIGN KEY(recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE
) ENGINE=InnoDB;

    -- Note: when copping a recipe make sure that images are also duplicated and renamed for the new recipe that way on deleting a chef you don't delete the new images on the new recipe

-- @ Reviews
CREATE TABLE IF NOT EXISTS Reviews (
    id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(25),	
    review varchar(255),
    rating tinyint(1) NOT NULL,
    recipe_id int UNSIGNED NOT NULL,	
    chef_id int UNSIGNED NOT NULL,
    FOREIGN KEY (recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE,
    FOREIGN KEY(chef_id) REFERENCES Chefs(id) ON DELETE CASCADE	
) ENGINE=InnoDB;

-- @ TryLater
CREATE TABLE IF NOT EXISTS TryLater ( 
    chef_id int UNSIGNED NOT NULL,
    recipe_id int UNSIGNED NOT NULL,
    PRIMARY KEY (chef_id, recipe_id),
    FOREIGN KEY(chef_id) REFERENCES Chefs(id) ON DELETE CASCADE,
    FOREIGN KEY (recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE 
) ENGINE=InnoDB

-- @ MyFavorites
CREATE TABLE IF NOT EXISTS MyFavorites ( 
    chef_id int UNSIGNED NOT NULL,
    recipe_id int UNSIGNED NOT NULL,
    PRIMARY KEY (chef_id, recipe_id),
    FOREIGN KEY(chef_id) REFERENCES Chefs(id) ON DELETE CASCADE,
    FOREIGN KEY (recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE 
) ENGINE=InnoDB

-- @ Cookbooks
CREATE TABLE IF NOT EXISTS Cookbooks (
    id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(50) NOT NULL,
    chef_id int UNSIGNED NOT NULL,
    is_private tinyint(1) DEFAULT 0,
    cookbook_image varchar(25),
    FOREIGN KEY(chef_id) REFERENCES Chefs(id) ON DELETE CASCADE
) ENGINE=InnoDB;

    CREATE TABLE IF NOT EXISTS CookbooksToRecipes ( 
        cookbook_id int UNSIGNED NOT NULL,
        recipe_id int UNSIGNED NOT NULL,
        PRIMARY KEY (cookbook_id, recipe_id),
        FOREIGN KEY (cookbook_id) REFERENCES Cookbooks(id) ON DELETE CASCADE,
        FOREIGN KEY(recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE
    ) ENGINE=InnoDB

-- @ Tags
CREATE TABLE IF NOT EXISTS Tags (
    id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(35) UNIQUE NOT NULL
) ENGINE=InnoDB;

    CREATE TABLE IF NOT EXISTS RecipesToTags ( 
        tag_id int UNSIGNED NOT NULL,
        recipe_id int UNSIGNED NOT NULL,
        PRIMARY KEY (tag_id, recipe_id),
        FOREIGN KEY (tag_id) REFERENCES Tags(id) ON DELETE CASCADE,
        FOREIGN KEY(recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE
    ) ENGINE=InnoDB

-- @ Categories
CREATE TABLE IF NOT EXISTS Categories (
    id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(35) UNIQUE NOT NULL
) ENGINE=InnoDB;

    CREATE TABLE IF NOT EXISTS RecipesToCategories ( 
        cat_id int UNSIGNED NOT NULL,
        recipe_id int UNSIGNED NOT NULL,
        PRIMARY KEY (cat_id, recipe_id),
        FOREIGN KEY (cat_id) REFERENCES Categories(id) ON DELETE CASCADE,
        FOREIGN KEY(recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE
    ) ENGINE=InnoDB

-- @ Allergies
CREATE TABLE IF NOT EXISTS Allergies (
    id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(35) UNIQUE NOT NULL
) ENGINE=InnoDB;

    CREATE TABLE IF NOT EXISTS RecipesToAllergies ( 
        allergy_id int UNSIGNED NOT NULL,
        recipe_id int UNSIGNED NOT NULL,
        PRIMARY KEY (allergy_id, recipe_id),
        FOREIGN KEY (allergy_id) REFERENCES Allergies(id) ON DELETE CASCADE,
        FOREIGN KEY(recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE
    ) ENGINE=InnoDB





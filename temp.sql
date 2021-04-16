










-- Список Дел:
    -- testing to make sure all Cascade deletes work
   

-- @ Chefs
CREATE TABLE IF NOT EXISTS Chefs (
    id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    email varchar(150) UNIQUE NOT NULL,
    hashed_password varchar(80) NOT NULL,
    chef_type tinyint(1) NOT NULL DEFAULT 3,
    created_by_chef_id int UNSIGNED DEFAULT 0,
    is_active tinyint(1) DEFAULT 1,
    KEY name (name)
) ENGINE=InnoDB

    CREATE TABLE IF NOT EXISTS HeadChefData ( 
        head_chef_id int UNSIGNED NOT NULL PRIMARY KEY,
        login_logo varchar(30),
        header_logo varchar(30),
        app_icon varchar(30),
        theme_color varchar(7),
        FOREIGN KEY (head_chef_id) REFERENCES Chefs(id) ON DELETE CASCADE 
    ) ENGINE=InnoDB

    -- test1
    -- test2
    -- test
    -- main starting data
    INSERT INTO Chefs (name, email, hashed_password, chef_type, created_by_chef_id, is_active)
    VALUES ('Russell Moore', 'truthandgoodness87@gmail.com', '$2y$10$YXhJaRzpd48K9ynspshTEOg.E9aVd/0.Gb5m3B8B4Iaus2zlGV7/.', 1, 0, 1)
    INSERT INTO Chefs (name, email, hashed_password, chef_type, created_by_chef_id, is_active)
    VALUES ('Charles Swann', 'charles@swanhaven.co', '$2y$10$MNH6ic1ZiyKrtIyP4kQn6e3NgkeJvoBAY.33E.yCIuRdNg1.nLlcO', 1, 1, 1)
    INSERT INTO Chefs (name, email, hashed_password, chef_type, created_by_chef_id, is_active)
    VALUES ('Test Dev', 'testdev@gmail.com', '$2y$10$SX2WWO8yPR0V7/l29U5QzuLD/RYV.7LGesA6KpgWwkLL0z..s9/HK', 1, 1, 1)

    INSERT INTO HeadChefData (head_chef_id, login_logo, header_logo, app_icon, theme_color)
    VALUES (1, 'login_logo_1.png', 'header_logo_1.png', 'app_icon_1.ico', '#EA453D')
    INSERT INTO HeadChefData (head_chef_id, login_logo, header_logo, app_icon, theme_color)
    VALUES (2, 'login_logo_2.png', 'header_logo_2.png', 'app_icon_2.ico', '#608171')

    -- Note: make default theme so that if we delete a head chef the chefs underneath him/her have somewhere else to go according to a theme

-- @ Recipes
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
) ENGINE=InnoDB

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
) ENGINE=InnoDB

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
) ENGINE=InnoDB

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
) ENGINE=InnoDB

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
) ENGINE=InnoDB

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
) ENGINE=InnoDB

    CREATE TABLE IF NOT EXISTS RecipesToAllergies ( 
        allergy_id int UNSIGNED NOT NULL,
        recipe_id int UNSIGNED NOT NULL,
        PRIMARY KEY (allergy_id, recipe_id),
        FOREIGN KEY (allergy_id) REFERENCES Allergies(id) ON DELETE CASCADE,
        FOREIGN KEY(recipe_id) REFERENCES Recipes(id) ON DELETE CASCADE
    ) ENGINE=InnoDB













-- test sql for fun 
-- get recipes and ratings
SELECT r.title, AVG(re.rating)
FROM Recipes AS r
    INNER JOIN Reviews AS re
        ON r.id = re.recipe_id
GROUP BY r.id, r.title;

-- get recipes and rating count
SELECT r.title, COUNT(re.rating)
FROM Recipes AS r
    INNER JOIN Reviews AS re
        ON r.id = re.recipe_id
GROUP BY r.id, r.title;

-- count of try leader recipes for chef
SELECT c.name, COUNT(chef_id)
FROM Chefs AS c
    INNER JOIN Trylater AS t
        ON c.id = t.chef_id
GROUP BY c.id, c.name;

SELECT recipe_id
FROM myfavorites
WHERE chef_id = 1


SELECT id, title, is_private, is_published, chef_id
FROM recipes
WHERE chef_id = 1 OR is_private = 0
ORDER BY chef_id;


-- Testing
-- TODO: need to do some intense testing when the tool is up and I can perform more exact queries, and have a smaller test set to make sure I filter correctly
-- max cook_time
SELECT MAX(cook_time)
FROM Recipes;

-- simple query testing
-- * mine default
    SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating 
    FROM Recipes AS r 
    WHERE r.chef_id = 1 
        AND (r.is_private = 0 OR r.chef_id = 1) 
        AND r.is_published = 1 LIMIT 20




-- * cook_time, 
    SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating, r.cook_time 
    FROM Recipes AS r 
    WHERE (r.is_private = 0 OR r.chef_id = 1) 
        AND is_published = 1 
        AND (r.cook_time BETWEEN 0 AND 10) LIMIT 20

-- * stars
    SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating 
    FROM Recipes AS r 
    WHERE (r.is_private = 0 OR r.chef_id = 1) 
        AND is_published = 1 
        AND (r.cook_time BETWEEN 0 AND 60) 
        AND r.average_rating >= 4 LIMIT 20

-- * myFavorites
    SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating 
    FROM Recipes AS r 
        INNER JOIN MyFavorites AS f 
            ON r.id = f.recipe_id 
    WHERE is_published = 1 
        AND f.chef_id = 1 
        AND (r.is_private = 0 OR r.chef_id = 1) 
        AND is_published = 1 
        AND (r.cook_time BETWEEN 0 AND 60) 
        AND r.average_rating >= 4 LIMIT 20

-- * tryLater
    SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating 
    FROM Recipes AS r 
        INNER JOIN MyFavorites AS f 
            ON r.id = f.recipe_id 
        INNER JOIN TryLater AS tl 
            ON r.id = tl.recipe_id 
    WHERE is_published = 1 
        AND f.chef_id = 1 
        AND tl.chef_id = 1 
        AND (r.is_private = 0 OR r.chef_id = 1) 
        AND is_published = 1 
        AND (r.cook_time BETWEEN 0 AND 60) 
        AND r.average_rating >= 4 LIMIT 20

-- * categories
    SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating 
    FROM Recipes AS r 
        INNER JOIN RecipesToCategories AS rc 
            ON r.id = rc.recipe_id 
        INNER JOIN Categories AS c 
            ON c.id = rc.cat_id 
        INNER JOIN MyFavorites AS f 
            ON r.id = f.recipe_id 
        INNER JOIN TryLater AS tl 
            ON r.id = tl.recipe_id 
    WHERE is_published = 1 
        AND c.id IN (30) 
        AND f.chef_id = 1 
        AND tl.chef_id = 1 
        AND (r.is_private = 0 OR r.chef_id = 1) 
        AND is_published = 1 
        AND (r.cook_time BETWEEN 0 AND 60) 
        AND r.average_rating >= 4 LIMIT 20
    -- 0

    SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating 
    FROM Recipes AS r 
        INNER JOIN RecipesToCategories AS rc 
            ON r.id = rc.recipe_id 
        INNER JOIN Categories AS c 
            ON c.id = rc.cat_id 
    WHERE is_published = 1 
        AND c.id IN (30) 
        AND (r.is_private = 0 OR r.chef_id = 1) 
        AND is_published = 1 
        AND (r.cook_time BETWEEN 0 AND 60) 
        AND r.average_rating >= 4 LIMIT 20
    -- 20+

    SELECT MAX(id)
    FROM Categories;

-- * tags
    SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating 
    FROM Recipes AS r 
        INNER JOIN RecipesToTags AS rt 
            ON r.id = rt.recipe_id 
        INNER JOIN Tags AS t 
            ON t.id = rt.tag_id 
    WHERE is_published = 1 
        AND t.id IN (30) 
        AND (r.is_private = 0 OR r.chef_id = 1) 
        AND is_published = 1 LIMIT 20

-- * allergies
    SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating 
    FROM Recipes AS r 
        INNER JOIN RecipesToAllergies AS ra 
            ON r.id = ra.recipe_id 
        INNER JOIN Allergies AS a 
            ON a.id = ra.allergy_id 
    WHERE is_published = 1 
        AND a.id IN (5) 
        AND (r.is_private = 0 OR r.chef_id = 1) 
        AND is_published = 1 LIMIT 20

-- * prep_time
    SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating FROM Recipes AS r 
        INNER JOIN RecipesToCategories AS rc 
            ON r.id = rc.recipe_id 
        INNER JOIN Categories AS c 
            ON c.id = rc.cat_id 
        INNER JOIN RecipesToTags AS rt 
            ON r.id = rt.recipe_id 
        INNER JOIN Tags AS t 
            ON t.id = rt.tag_id 
        INNER JOIN RecipesToAllergies AS ra 
            ON r.id = ra.recipe_id 
        INNER JOIN Allergies AS a 
            ON a.id = ra.allergy_id 
        INNER JOIN MyFavorites AS f 
            ON r.id = f.recipe_id 
        INNER JOIN TryLater AS tl 
            ON r.id = tl.recipe_id 
    WHERE is_published = 1 
        AND c.id IN (1) 
        AND t.id IN (15) 
        AND a.id IN (4) 
        AND f.chef_id = 1 
        AND tl.chef_id = 1 
        AND (r.is_private = 0 OR r.chef_id = 1) 
        AND is_published = 1 
        AND (r.cook_time BETWEEN 0 AND 60) 
        AND r.average_rating >= 4 
        AND (r.prep_time BETWEEN 0 AND 15) LIMIT 20

-- * total_time
    SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating FROM Recipes AS r 
        INNER JOIN RecipesToCategories AS rc 
            ON r.id = rc.recipe_id 
        INNER JOIN Categories AS c 
            ON c.id = rc.cat_id 
        INNER JOIN RecipesToTags AS rt 
            ON r.id = rt.recipe_id 
        INNER JOIN Tags AS t 
            ON t.id = rt.tag_id 
        INNER JOIN RecipesToAllergies AS ra 
            ON r.id = ra.recipe_id 
        INNER JOIN Allergies AS a 
            ON a.id = ra.allergy_id 
        INNER JOIN MyFavorites AS f 
            ON r.id = f.recipe_id 
        INNER JOIN TryLater AS tl 
            ON r.id = tl.recipe_id 
    WHERE is_published = 1 
        AND c.id IN (1) 
        AND t.id IN (15) 
        AND a.id IN (4) 
        AND f.chef_id = 1 
        AND tl.chef_id = 1 
        AND (r.is_private = 0 OR r.chef_id = 1) 
        AND is_published = 1 
        AND (r.cook_time BETWEEN 0 AND 60) 
        AND r.average_rating >= 4 
        AND (r.prep_time BETWEEN 0 AND 60) 
        AND (r.total_time BETWEEN 0 AND 40) LIMIT 20









SELECT DISTINCT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating 
FROM Recipes AS r 
    INNER JOIN MyFavorites AS f 
        ON r.id = f.recipe_id 
WHERE r.chef_id = 1 
    OR f.chef_id = 1 
    AND (r.is_private = 0 OR r.chef_id = 1) 
    AND r.is_published = 1 LIMIT 20



SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating, r.chef_id 
FROM Recipes AS r 
    INNER JOIN MyFavorites AS f 
        ON r.id = f.recipe_id 
WHERE f.chef_id = 1 
    AND (r.is_private = 0 OR r.chef_id = 1) 
    AND r.is_published = 1 LIMIT 20


SELECT chef_id, recipe_id
FROM MyFavorites
WHERE chef_id = 1

SELECT DISTINCT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating 
FROM Recipes AS r 
    INNER JOIN RecipesToCategories AS rc 
        ON r.id = rc.recipe_id 
    INNER JOIN Categories AS c 
        ON c.id = rc.cat_id 
    INNER JOIN RecipesToTags AS rt 
        ON r.id = rt.recipe_id 
    INNER JOIN Tags AS t 
        ON t.id = rt.tag_id 
    INNER JOIN RecipesToAllergies AS ra 
        ON r.id = ra.recipe_id 
    INNER JOIN Allergies AS a 
        ON a.id = ra.allergy_id 
    INNER JOIN MyFavorites AS f 
        ON r.id = f.recipe_id 
    INNER JOIN TryLater AS tl 
        ON r.id = tl.recipe_id 
WHERE c.id IN (1,2,3,4) 
    AND t.id IN (15,5,6,8) 
    AND a.id IN (1,2,3,4) 
    AND f.chef_id = 1 
    AND tl.chef_id = 1 
    AND (r.is_private = 0 OR r.chef_id = 1) 
    AND r.is_published = 1 
    AND (r.cook_time BETWEEN 0 AND 60) 
    AND r.average_rating >= 2 
    AND (r.prep_time BETWEEN 0 AND 10) 
    AND (r.total_time BETWEEN 0 AND 120) LIMIT 20




SELECT DISTINCT r.id, r.id, r.title, r.total_time, r.title, r.description, r.main_image, r.average_rating 
FROM Recipes AS r 
    INNER JOIN RecipesToCategories AS rc 
        ON r.id = rc.recipe_id 
    INNER JOIN Categories AS c 
        ON c.id = rc.cat_id 
    INNER JOIN RecipesToTags AS rt 
        ON r.id = rt.recipe_id 
    INNER JOIN Tags AS t 
        ON t.id = rt.tag_id 
    INNER JOIN RecipesToAllergies AS ra 
        ON r.id = ra.recipe_id 
    INNER JOIN Allergies AS a 
        ON a.id = ra.allergy_id 
    INNER JOIN MyFavorites AS f 
        ON r.id = f.recipe_id 
    INNER JOIN TryLater AS tl 
        ON r.id = tl.recipe_id 
WHERE c.id IN (1,2,3,4) 
    AND t.id IN (15) 
    AND a.id IN (4) 
    AND f.chef_id = 1 
    AND tl.chef_id = 1 
    AND (r.is_private = 0 OR r.chef_id = 1) 
    AND r.is_published = 1 
    AND (r.cook_time BETWEEN 0 AND 60) 
    AND r.average_rating >= 4 
    AND (r.prep_time BETWEEN 0 AND 120) 
    AND (r.total_time BETWEEN 0 AND 120) LIMIT 20
-- 1

SELECT DISTINCT r.id, r.id, r.title, r.total_time, r.title, r.description, r.main_image, r.average_rating 
FROM Recipes AS r 
    INNER JOIN RecipesToCategories AS rc 
        ON r.id = rc.recipe_id 
    INNER JOIN Categories AS c 
        ON c.id = rc.cat_id
WHERE c.id IN (1,2,3,4)
    AND (r.is_private = 0 OR r.chef_id = 1) 
    AND r.is_published = 1 
    AND (r.cook_time BETWEEN 0 AND 60) 
    AND r.average_rating >= 4 
    AND (r.prep_time BETWEEN 0 AND 120) 
    AND (r.total_time BETWEEN 0 AND 120) 
ORDER BY r.id LIMIT 20
-- 1

SELECT r.id, r.title, r.total_time, r.description, r.main_image, r.average_rating, rc.recipe_id, rc.cat_id 
FROM Recipes AS r INNER JOIN RecipesToCategories AS rc ON r.id = rc.recipe_id INNER JOIN Categories AS c ON c.id = rc.cat_id INNER JOIN RecipesToTags AS rt ON r.id = rt.recipe_id INNER JOIN Tags AS t ON t.id = rt.tag_id INNER JOIN RecipesToAllergies AS ra ON r.id = ra.recipe_id INNER JOIN Allergies AS a ON a.id = ra.allergy_id INNER JOIN MyFavorites AS f ON r.id = f.recipe_id INNER JOIN TryLater AS tl ON r.id = tl.recipe_id WHERE c.id IN (1,2,3,4) AND t.id IN (15) AND a.id IN (4) AND f.chef_id = 1 AND tl.chef_id = 1 AND (r.is_private = 0 OR r.chef_id = 1) AND r.is_published = 1 AND (r.cook_time BETWEEN 0 AND 60) AND r.average_rating >= 4 AND (r.prep_time BETWEEN 0 AND 10) AND (r.total_time BETWEEN 0 AND 120) LIMIT 20
-- 4

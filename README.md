# recipe_app
This is a project built on the Core Integration or Open Source Framework 
located here: https://github.com/RussellMoore1987/open_source_project

## Installation Instructions
Right now the system has a little bit of a cumbersome installation process, Sorry! This will be improved as the system is finalized.

### Installation Video & Tour
https://drive.google.com/file/d/1M6xs188Zqyqgtv972aRQV9Aia1BvclAR/view?usp=sharing

### Software Needed
- PHP
- MySQL
- NodeJS

I am using WAMP as my server installation for MySQL and PHP. You do not have to use WAMP if you do not want to. https://www.wampserver.com/en/

**Realize however if you do not use WAMP you will need to change some of the path variables for the DevTool**

Here is the normal paths to access the system.

http://localhost/recipe_app/public/login.php // login page

http://localhost/recipe_app/public/admin/ // this will give you a 404 page

http://localhost/recipe_app/public/admin/add_edit_post // if there, add edit post page 

### Download These Repositories
If using WAMP download this repository in this directory C:\wamp64\www\
```
git clone https://github.com/RussellMoore1987/recipe_app
```

and
```
git clone https://github.com/RussellMoore1987/devTool2
```

### Create Database
- In your MySQL create a database named RecipeApp
- You need to have a user in the database with a username and password of "root"
    - If you would like to change the username and password or database name the file is located: {root}\private\db\db_credentials.php

### Run DevTool
- Open the project file structure for the "devTool2" 
- Initiate the project 
```
npm i
```
then 
```
npm start
```

**Note: If things are not working quite right you may need to go into the react code and change the URL path for the requests. Change http://localhost/recipe_app/ to the appropriate path.**

### Create Tables and Insert Records
At this point you should be into the dev tool. From here you can use the various CRUD commands, as well as inserting records to get up and running with your installation. For more comprehensive tour scroll up to the installation video and tour section.



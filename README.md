
#Laravel CRUD with AJAX

##System Requirements
1. PHP (Version 7.3+)
2. Composer (Version 1.10.10)
3. NPM (Version 6.14.5)
4. Mysql (Version 5.7.31)


## Framework Used
1. Laravel 8 for PHP

## Project Setup
1. Git clone the repository.
2. Run composer install to load PHP dependencies to root of project folder.

    ```shell
    composer install
    ```
    
    Without dev dependencies i.e. only Production dependencies
    ```shell
    composer install --no-dev
    ```
    
3. Run npm install to load Node dependencies to root of project folder.

    ```shell
    npm install
    ```
4. Create a .env file to the root of the project folder if not created by copying the .env.example file.
5. Setup the configuration of app environment as local, database connection and other settings in .env file.
6. Setup virtual host and point the document location to public folder.
7. Turn on mod_rewrite engine for apache.
8. Setup database by running migration command

    ```shell
    php artisan migrate
    ```
 
9. Create the symbolic link for storage

    ```shell
     php artisan storage:link
    ```  
10. Compile js file

    ```shell
    npm run dev 
    ```
    
    Without dev dependencies i.e. only Production dependencies
    ```shell
    npm run prod
    ``` 
11. Run Project
    
    ```shell
    php artisan serve
    ```

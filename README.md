# Midstay Techinal Test

## Installation
- Copy environment sample file
    ```sh
    cp .env.example .env
    ```

- Modify database configuration on environment file
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=[db_name]
    DB_USERNAME=[db_username]
    DB_PASSWORD=[db_password]
    ```

- Run migration
    ```sh
    php artisan migrate
    ```

- Run seeding
    ```sh
    php artisan db:seed
    ```
    
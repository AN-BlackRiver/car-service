1. composer install  
2. cоздаем .ENV файл  
3. выполняем - php artisan key:generate  
4. настраиваем подключение к БД (Указываем ваши данные для подключения):  
   --------------------------------------------------------------------
    DB_CONNECTION=pgsql  
    DB_HOST=127.0.0.1  
    DB_PORT=5432  
    DB_DATABASE=car-service  
    DB_USERNAME=postgres  
    DB_PASSWORD=postgres_pass  
4. настраиваем подключение к Redis (Указываем ваши данные для подключения):
   ---------------------------------------------------------------------
    CACHE_STORE=redis
   
    REDIS_HOST=127.0.0.1  
    REDIS_PASSWORD=null  
    REDIS_PORT=6379  
6. запускаем миграции с сидом php artisan migrate --seed (при желании базу можно поднять из дампа файл лежит /database/dump-sql)
   

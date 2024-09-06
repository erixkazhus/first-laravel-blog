How to setup:
1. Create a database in phpmyadmin mysql, make sure that database uses 3306 port
2. Rename .env.example file to .env
3. replace your database name, username, and password with yours
4. run command php artisan key:generate
5. run command php artisan migrate
6. run command  php artisan db:seed --class=CategorySeeder
7. run command php artisan serve
8. Register user
9. Go to Blog-> Create Post

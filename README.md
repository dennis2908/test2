# Used technology :

I am using php laravel 8, auth admin and user, adminLTE, mysql, postgreSQL, heroku, Email Confirmation

# Instalation and running server locally :

1. git clone https://github.com/dennis2908/grterchdennis
2. Open the file .env and adjust DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD to your MYSQL setting.</br>
3. Use command prompt and direct to root folder and type :  
   $ php artisan key:generate</br>
   $ php artisan optimize:clear</br>
   $ php artisan migrate:fresh --seed</br>
   $ php artisan serve</br>

# Notes :

  - Admin Login : http://127.0.0.1:8000/login/admin </br>
  
  - User Login : http://127.0.0.1:8000/login/ </br>
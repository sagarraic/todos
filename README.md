Simple Laravel TODO App with Vue
This is built on Laravel Framework 8.75

## Installation
This is built on Laravel Framework 8.75

Clone the given repository:
```
https://github.com/sagarraic/todos.git
```

Then go to folder redirectory by this command:
```
cd todos
```

Install composer:
```
composer install
```

Install the laravel/ui composer package with this command:
```
composer require laravel/ui
```

The laravel/ui package has some helpful Artisan commands which will automatically scaffold out everything you need to get started with Vue.
```
php artisan ui vue
```

Finally, you’ll need to install the newly added dependencies and compile them.
```
npm install && npm run dev
```

Then create a environment file using this command:
```
cp .env.example .env
```

At last generate application key, which will be used for password hashing, session and cookie encryption etc.
```
php artisan key:generate
```

Then edit .env file with correct credential for your database server. Just edit these two line (DB_USERNAME, DB_PASSWORD).
Then create a database named todos and then do a database migration using this command-
```
php artisan migrate:fresh --seed
```

Run server using this command:
```
php artisan serve
```
Then go to http://localhost:8000 from your browser and see the app.
Now, login with following credentials
### Username: 
admin@gmail.com
### Password: 
admin123

BOOM!! Enjoy the simple todo application, thanks!
Cheers!! Happy Coding!

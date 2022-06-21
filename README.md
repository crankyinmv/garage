RESTful Server Architecture Test

Setup:

Create a database and database user for the application
Copy .env.example to .env
Set up the DB section of .env with the proper credentials
Migrate:
php artisan migrate
Other stuff:
composer install
php artisan key:generate


I used the default auth setup, but added an admin field to user. This is not set through the UI. If you want to add an admin user you'll need to register a normal user then manually set this field to true or 1 in your DB client.

Running: 
This is the dev version. I hope that's OK. You can start the server by running the following on the command line in the garage directory: php artisan serve

The app should run on localhost:8000

Or you can set up a web server to run out of garage/public

Testing:

anonymous access With noone logged in, try all the GET routes in web.php. They should all redirect to login. The other routes are create, update and delete. I added some ugly buttons to the non-logged in header which post to the remaining routes. Update and delete tests are available if there's at least 1 of that type of vehicle present. Each button should redirect back to the login screen.

authorized access As I mentioned earlier, I set this up to recognize 2 different types of users: regular and admin. These represent the customers and employees with access to records respectively. Admins should be able to list, update, and delete vehicles from all the customers, but not add vehicles. Regular customers should be able to create vehicles, as well as list, update or delete their own vehicles (not the vehicles of other customers).

validation Use the update and create forms and try to use the wrong types or maybe even inject SQL.
For the VINs and HINs, each should be unique within it's table. I added some restrictions on the formatting for both but you'll still be able to enter ID's which would not pass muster with the DMV.RESTful Server Architecture Test

Setup:

Create a database and database user for the application
Copy .env.example to .env
Set up the DB section of .env with the proper credentials
Migrate
I used the default auth setup, but added an admin field to user. This is not set through the UI. If you want to add an admin user you'll need to manually set this field to true or 1 in your DB client.

Running: This is the dev version. I hope that's OK. You can start the server by running the following on the command line in the garage directory: php artisan serve

The app should run on localhost:8000

Or you can set up a web server to run out of garage/public

Testing:

anonymous access With noone logged in, try all the GET routes in web.php. They should all redirect to login. The other routes are create, update and delete. I added some ugly buttons to the non-logged in header which post to the remaining routes. Update and delete tests are available if there's at least 1 of that type of vehicle present. Each button should redirect back to the login screen.

authorized access As I mentioned earlier, I set this up to recognize 2 different types of users: regular and admin. These represent the customers and employees with access to records respectively. Admins should be able to list, update, and delete vehicles from all the customers, but not add vehicles. Regular customers should be able to create vehicles, as well as list, update or delete their own vehicles (not the vehicles of other customers).

validation Use the update and create forms and try to use the wrong types or maybe even inject SQL.
For the VINs and HINs, each should be unique within it's table. I added some restrictions on the formatting for both but you'll still be able to enter ID's which would not pass muster with the DMV.

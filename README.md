Git Link
https://github.com/ayushma-jain/laravel_project_task/


Take clone from git using 
git clone https://github.com/ayushma-jain/laravel_project_task/

move to root folder
cd laravel_project_task

run below commands (Make sure you have node,composer and php setup in your system)
composer install
npm install

Create DB "availability_db" and run below command.
php artisan migrate 

All set now you can run below commands to start the app.
php artisan serve
npm run dev

hit URL in browser
http://localhost:8000/
<p align="center">
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>
</p>
<p align="center">Online Test Application</p>


## About Project

This is an online test utility with minimal features build with laravel:

- Clone and cd into repository folder and run below commands:
- composer install
- php artisan passport:install
- php artisan migrate
- php artisan tinker 
    - factory(\App\User::class)->create(['email'=>'admin@admin.com', 'is_admin'=>1]) [Create Admin User];
    - factory(\App\User::class)->create(['email'=>'user1@user.com']) [Create Test Users, You can run this command multiple time by changing email to create multiple users]
    - factory(\App\Question::class, 5)->create(); [Create 5 sample questions]
- npm install
- npm run dev
- Configure PASSING_PERCENTAGE, QUESTION_TIMER_SECONDS, Mail and other basic environment variables in .env file
- If .env file is not available on root folder create one using .env.example file
- php artisan key:generate
- php artisan serve

## APIs
 - There are login, logout, get all question list and submit result API's
 - You can find sample api response and postman collection in 'API_Responses' folder on project root
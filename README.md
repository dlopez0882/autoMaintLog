# AutoMaintLog

## Description

As a maticulous vehicle owner, I like to keep a running log of all the services that my vehicle(s) go through.  Prior to this, I was using a spreadsheet to keep track of all my services. I decided to build a small CRUD application and modernize the way I go about logging my vehicles maintenance records. 

This application is built using [Laravel 9](https://laravel.com/) and [Vue 3](https://vuejs.org/). I decided to use Laravel because I have used other PHP frameworks in the past with great success. I wanted to give Laravel a try as it seems to be widely used today, according to [JetBrains](https://www.jetbrains.com/lp/devecosystem-2021/php/) and [Kinsta](https://kinsta.com/blog/php-frameworks/).

## How to Install and Run the Project
1. Clone this project locally.
2. ```cd {project_directory}```.
3. Install composer dependencies (note: must have Composer installed).
4. Install NPM dependicies (note: must have npm installed).
5. Run ```cp .env.example .env```
6. Update DB connections as necessary.
7. [Optional] Configure a mail server if you want full functionality of password reset features.
8. Run ```php artisan key:generate```
9. Run ```php artisan migrate```
10. Run ```php artisan serve```
11. Run ```npm run dev```
11. Navigate to outputted URL (example: http://localhost:8000/)
12. After stopping the project, all you will need to do is
    * ```cd {project_directory}```
    * Run ```php artisan serve```
    * Run ```npm run dev```


## How to Use the Project

1. Create a new user using the "Register" link.
2. Login as the user.
3. Add a vehicle.
    * See vehicle's service logs. 
    * Delete a vehicle - note: deleting a vehicle also deletes all of its associated service logs.
4. Add a service log record.
    * Update a service log item.
    * Delete a service log item.
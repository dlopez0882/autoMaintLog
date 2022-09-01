# AutoMaintLog

## Description

As a maticulous vehicle owner, I like to keep a running log of all the services that my vehicle(s) go through.  Prior to this, I was using a spreadsheet to keep track of all my services. I decided to build a small CRUD application to take care of this. 

This application is build using [Laravel 9](https://laravel.com/) and [Vue3](https://vuejs.org/). I decided to use Laravel because I have used other PHP frameworks in the past with great success. I wanted to give Laravel a try as it seems to be widely used today.

In addition to modernize the way I keep track of my vehicle's maintenance records, I wanted to make this application to:
1. Help me learn a modern PHP framework (such as [Laravel](https://laravel.com/)), and
2. Help me learn a modern Javascript framework (such as [VueJS](https://vuejs.org/)).

## How to Install and Run the Project
1. Clone this project locally.
2. cd to project directory.
3. Install composer dependencies (note: must have Composer installed).
4. Install NPM dependicies (note: must have npm installed).
5. Run ```cp .env.example .env```
6. Update DB connections as necessary.
7. [Optional] Configure a mail server if you want full functionality of password reset features.
8. Run ```php artisan key:generate```
9. Run ```php artisan migrate```
10. Run ```php artisan serve```
11. Navigate to outputted URL (example: http://localhost:8000/)

## How to Use the Project

1. Create a new user using the "Register" link.
2. Login as the user.
3. Add a vehicle.
    * See vehicle's service logs. 
    * Delete a vehicle - note: deleting a vehicle also deletes all of its associated service logs.
4. Add a service log record.
    * Update a service log item.
    * Delete a service log item.
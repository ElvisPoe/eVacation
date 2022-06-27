<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Welcome to eVacation

### Installation
Clone the repo. Run composer install. Run npm run dev.
You can run php artisan migrate --seed for dummy admin user.

#### I used the Laravel Breeze Starter Kit for a quick Register/Login functionality.

#### Supervisor account: admin@supervisor.test | password

In the first page you can see a list with the most recent pending applications.
You can quickly Approve or Reject them from here.

In the navigation we can go to Applications where we can see all the entries.
There is a filter All, Approved, Pending and Rejected, so we can filter our results.

When an application is Approved we can only Reject it.
When an application is Pending we can Approve it or Reject it.
When an application is Rejected we can Approve it.

In the navigation we can go to Users where we can see all the entries.
We can create a new user, we can edit an existing one, or we can show one user with his applications.

As an employee we can Log in/Register ( Default Role is Employee )
Firstly you can see a list with your past applications.
You can create an application with the dates and the reason.
Days are calculated automatically. End date must be greater than(or same with) the Start Date.
I've added a JS validator in the application/create blade for a better UI and a Backend validation for more security.

When a new application is created, It triggers a Service where the email is sent App/Services.

When an email button Approve/Reject is clicked the response is sent to the employee.
The email is sent even if we Approve/Reject the application in the App.

In App/Services/SlackService I connected the app with a Slack Channel, so we can fetch users from there.

# Programming Task

## Introduction

In  this repo is a simple Laravel PHP application which has two api endpoints. The application is incomplete and your task is to complete the code based on the instructions below.

In the tests directory are some phpunit tests. Some of the tests are testing features which have already been implemented so they pass. Some of the tests are for features which have not yet been implemented so they currently fail. When the programming task is complete all of the tests will pass.

## Installation

You are not being tested on your ability to set up the environment that this programming task runs in so if you have any issues don't hesitate to ask for help.

This is a Laravel 7 app, in order to run it you will need a php 7.2 or higher PHP environment and composer installed to install the packages.

This application uses an sqlite database to simplify set up.

### Instructions

1. **Clone this project onto your local machine**. Using git clone this repo onto your local machine.

2. **Set up a PHP environment**. You can either run php (7.2 or higher) locally on your machine or you can use a Laravel Homestead to run the project in a virtual machine. Refer to the Laravel documentation for more details https://laravel.com/docs/7.x/installation

3. **Install composer**. Composer is a package manager which will automatically install all of the libraries which this project depends on. If you are using Homestead you will already have composer installed in your virtual machine, otherwise follow the installation instructions https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos

4. **Install sqlite**. If you are using Homestead you will already have sqlite installed. If you are using Mac you probably already have sqlite installed. Otherwise install it from here https://www.sqlite.org/index.html

5. **Run composer install**. In a terminal navigate to the directory where this project is downloaded and run ``composer install`` to install all of the necessary dependencies.

6. **Migrate and seed the database**. Run ``php artisan migrate --seed`` from the terminal to run database migrations and the database seeder. You can read more about it here https://laravel.com/docs/7.x/migrations#introduction.

7. **Run the tests**  Running ``vendor/bin/phpunit`` in the terminal from the directory where this project is will run the unit tests. You should see that some tests pass and some tests fail. As you complete the coding task more of the tests will pass.

### Running the code

There are two ways you can test this task as you complete it. When you run the phpunit tests you will be executing the code which you have written and testing that it works correctly. You can complete the task simply by running the tests and confirming that they pass.

You can also interact with the api yourself. If you are using Homestead follow the instructions on how to set up and interact with your application. If you are running PHP locally you can navigate to the public directory in the terminal (the directory in this repo called public) and run ``php -S localhost:8000`` to run the server locally. Now you can navigate to `http://localhost:8000/` to see the default Laravel homepage.

You can authenticate as the two users in the system by passing api tokens as query parameters. Visiting ``http://localhost:8001/api/leads?api_token=hrms`` in the browser will show the response for the lead index endpoint authenticated as the hrms user. Visiting ``http://localhost:8001/api/leads?api_token=erp`` will show the response to the same endpoint as the erp user. In a real system the api tokens used would be much more secure.

### Viewing the database

You can view the contents of the sqlite database using a tool such as this https://sqlitebrowser.org/. The database is located at `database/database.sqlite` in the project directory.

## The Project

Prospect Path is a platform which we have built which displays sales leads to enterprise software companies so that they can purchases them. The sales leads are contacts at companies which are looking to purchase enterprise software. The users of the system are the employees of enterprise software companies who are looking to purchase those sales leads from us. The system in this programming task takes one of the features of Prospect Path - an api which allows users to view lead data - and recreates it in a more simple form.

Both Prospect Path and this project are built in Laravel, an MVC web framework built in PHP.

### The models

The project is made up of the following models. They can be found in `app/`

#### Market
A market is a software market. Both vendors and leads are associated with a software market. The markets included in this system are HRMS and ERP. You don't need to know anything about these markets other than that they represent different types of software which software companies sell.

#### Vendor
A vendor is a enterprise software company which is looking to purchase leads.

#### User
A user is an employee working for a vendor.

#### Lead
A lead is a sales lead which is being sold. It is associated with a market and contains details of the company which is looking to purchase some software in that market.

### The api

The url paths for the two api endpoints are defined in `routes/api.php`. The code which dictates what is returned from those api endpoints is in `app/Http/Controllers/LeadController.php`

## The Task

#### Part one - The get lead api endpoint

a) The get lead api endpoint at /leads/{lead_id} where {lead_id} is replaced with the id number of the lead should return the lead data for the lead requested. Update the code in `app/Http/Controllers/LeadController` to return the lead data from the endpoint. The data should be similar to that returned from the index endpoint but just for a single lead.

Once this part is complete the test ``test_as_a_user_i_want_to_get_an_individual_lead_from_the_lead_get_api_endpoint`` in `tests/Feature/LeadApiTest.php` should pass. You can run just that test individually to see if it passes with the command ``vendor/bin/phpunit --filter test_as_a_user_i_want_to_get_an_individual_lead_from_the_lead_get_api_endpoint`` run from the root directory of the project.

b) Prevent users from accessing leads from another market. Each User is associated with a Vendor, and each Vendor is associated with a Market. Only leads which are associated with the same Market as a User's Vendor should be accessible to a User. If the lead requested is from another market a 404 not found response should be returned.

Once this part is complete the test ``test_as_a_user_i_cannot_get_an_individual_lead_from_another_market_from_the_get_api_endpoint`` in ``tests/Feature/LeadApiTest.php`` should pass. You can run just that test individually to see if it passes with the command ``vendor/bin/phpunit --filter test_as_a_user_i_cannot_get_an_individual_lead_from_another_market_from_the_get_api_endpoint`` run from the root directory of the project.

### Part two - Inactive vendors

Each vendor has a boolean flag on their model called `active`. The vendor called HRMSSoft has this flag set to true and the vendor ERPSoft has it set to false. Update the api so that when this flag is set to false for a vendor both the lead index api endpoint and the get lead api endpoint return a 403 forbidden response for any user associated with that vendor.

Once this part is complete the tests ``test_as_a_user_whos_vendor_is_not_active_i_cannot_use_the_lead_index_api_endpoint`` and ``test_as_a_user_whos_vendor_is_not_active_i_cannot_use_the_lead_get_api_endpoint`` in `tests/Feature/LeadApiTest.php` should pass. You can run each test individually to see if it passes with the commands ``vendor/bin/phpunit --filter test_as_a_user_whos_vendor_is_not_active_i_cannot_use_the_lead_index_api_endpoint`` and ``vendor/bin/phpunit --filter test_as_a_user_whos_vendor_is_not_active_i_cannot_use_the_lead_get_api_endpoint`` run from the root directory of the project. All of the other tests should continue to pass.

If you have any questions feel free to email jack@prospectpath.com for advice.
 
## Submission

To submit the completed task either zip the project folder (exclude the vendor folder to keep the file size small) and email it to jack@prospectpath.com or push the code to a private repo on Github and share the repo with https://github.com/jackowagstaffe (please don't post your solution as a public repo in case one of the other candidates finds it).

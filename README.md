# Laravel 8.2 REST APi for DevBook
This API is created using Laravel 8.2 API Resource. The program will allow the user to create, update, read, and delete User model. It has scheduler, which will run every day to clean inactive users. If the user are inactive for 6 month, notification mail will be sent using mailtrap and deleted if they are still inactive following week. Middleware LastActive is used in order to record the inactivity of the user. The program also allows user to find other user based on the keyword provided on the api route(api/find-users). It also contains protected routes which are accessed via Passport access token.

#### Following are the Models
* User

#### Usage
Clone the project via git clone or download the zip file.

##### .env
Create a database and connect your database in .env file. Setup your mail configuration file. I am using Mailtrap and the smtp driver to send your email messages to a "dummy" mailbox.
##### Composer Install
cd into the project directory via terminal and run the following  command to install composer packages.
###### `composer install`
##### Generate Key
then run the following command to generate fresh key.
###### `php artisan key:generate`
##### Run Migration
then run the following command to create migrations in the database.
###### `php artisan migrate`
##### Passport Install
run the following command to install passport
###### `php artisan passport:install`

### API EndPoints
* POST `http://localhost:8000/api/register`
->  Form Data
    * first_name
    * dob
    * national_insurance_number
    * profile_image(file)
    * full_address
    * bio
    * email
    * password

-> Response
    * access_token

* POST `http://localhost:8000/api/profile` - Only the provided field will be updated.
->  Headers
    * Authorization : 'Bearer' + {{access_token}}
    * Accept : application/json

->  Form Data
    * first_name
    * dob
    * profile_image(file)
    * full_address
    * password
    * _method=PATCH

-> Response
    * updated user record.

* DELETE `http://localhost:8000/api/profile`
->  Headers
    * Authorization : 'Bearer' + {{access_token}}
    * Accept : application/json
-> Response
    * User deleted success message.

* GET `http://localhost:8000/api/profile`
->  Headers
    * Authorization : 'Bearer' + {{access_token}}
    * Accept : application/json
-> Response
    * User record    
* GET `http://localhost:8000/api/find-users?keyword=test` - Keyword test will be searched in the bio.
->  Headers
    * Authorization : 'Bearer' + {{access_token}}
    * Accept : application/json
-> Response
    * User collection based on the keyword match within the users bio.

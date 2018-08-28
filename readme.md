Install Composer and xampp on your machine and clone the project in xampp's htdocs directory

Grant RW permission to Bootstrap and Storage folders and all files and subfolders

Start MySQL and Apache Web Server

Then update the composer with "composer update" command.

Set below values in .env Create database and give details as per below DB_HOST=<DB_HOST> DB_PORT=<DB_PORT> DB_DATABASE=<DB_DATABASE> DB_USERNAME=<DB_USERNAME> DB_PASSWORD=<DB_PASSWORD>

Also set smtp settings in .env MAIL_DRIVER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION

Run command : php artisan migrate This will create required database tables in the database specified in .env file

Hit the URL : http://localhost/CandidateEvaluator/public/

Click on Register link to register new user

Use credentials to login to the website

You can reset the password of the user by clicking the Forgot Password link(Make sure you have configured correct smtp settings in .env)

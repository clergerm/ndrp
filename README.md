# ndrp
Natural Disasters Relief Program


- Installation and configuration: This project was tested with Windows 10 in localhost using XAMPP installed on C drive.

1. Download the latest xampp version for Windows at : 
   https://www.apachefriends.org/download.html.

2. Install xampp on your C drive.

3. Open xampp control panel and start the apache and MYSQL server.

4.  Copy the site folder (ndrp) to your document root, at C:xampp/htdocs/.

5. Create from phpMyAdmin a mysql database named ndrp, no need to create a new user/password 
   as root is used as default.

6. Import ndrp.sql, located at ndrp/db/, to your database.

7. From ndrp/conf/app.php file, make sur the following paths are set:
	- FULL_DIR = "C:/xampp/htdocs/ndrp" (change it to your own path, if applicable)
	- FULL_URL = "http://localhost/ndrp"

8. To display or test the site, open your web browser and type http://localhost/ndrp


- HOW TO RUN UNIT TESTING: To run the unit tests for this program, it is required to install and configure composer, phpunit, and visual studio code.
 
1. Download/Install visual studio code for Windowas at https://code.visualstudio.com/download.

2. Launch vs code and open folder ndrp from C:/xampp/htdocs as an existing project.

3. Download and install cdownload composer at https://getcomposer.org/.

4. From vs code, open the Terminal. 

5. Change to your root directory (c:/xampp/htdocs/ndrp).

6. Install phpunit by typing composer phpunit/phpunit ^9.5

7. Make sure your composer.json file include the codes below:
{
    "require": {
        "phpunit/phpunit": "9.5"
    },
    "autoload": {
        "classmap": [
            "conf",
            "controller"
        ]
    }
}

8. Verify/make sure your phpunit.xml file include:

<?xml version="1.0" encoding="UTF-8"?>
<phpunit bootstrap = "vendor/autoload.php"
    colors          = "true" 
    verbose         = "true" 
    stopOnFailure   = "false" 
    stderr          = "true">

    <testsuites>
        <testsuite name="NDRP Test">
            <directory>test</directory>
        </testsuite>
    </testsuites>
</phpunit>

9. Run the tests from your vs code terminal as follow:
	- vendor/bin/phpunit test/RegisterClientTest.php
	- vendor/bin/phpunit test/LoginTest.php

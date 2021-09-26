# Javulna

## Table of Contents
1. [Introduction](#Introduction)
2. [Installing the application](#Install)
4. [Exercises](#Exercises)
    1.  [Exercise 1 - Find users of the app and their password](#Exercise_1)
     1. [Exercise 2 - Change another user's password](#Exercise_2)
     1. [Exercise 3 - File handling](#Exercise_3)
     1. [Exercise 4 – File handling (upload)](#Exercise_4)
     1. [Exercise 5 – URL handling](#Exercise_5)
     1. [Exercise 6- XSS](#Exercise_6)

<a name="Introduction"></a>
## Introduction 

Piha is an intentionally vulnerable PHP application. It is created for educational purposes. It is intended mainly for PHP developers.
Piha is a movie-related application, where you can log in and out, read information about movies, change some of your profile data, etc... The functionalities are far from complete or coherent, they just serve the purpose of demonstrating specific vulnerabilities.
This document contains exercises which can be done with Piha to understand how to exploit and how to fix specific vulnerabilities.

<a name="Install"></a>
## Installing the application 

Piha is simple PHP application without any frameworks.
You can directly install it on an Apache2 Webserver (or on any other PHP webserver) by copying the dist folder to your webser's app directory.

The underlying PHP system should have the php-mysql and the php-dom modules installed.
On a linux system you can install these with:

```
sudo apt-get install php-mysql
sudo apt-get install php-dom
```

Piha will need a mysql database. You can create the database by running the piha.sql file.  
You can configure database access at dist/common/config.php. 

The application has a file-upload (and download) functionality, and it stores uploaded files on the server's file-system. In order for the upload and download functionality to work you have to set the value of the IMAGE_FOLDER constant defined in dist/common/constants.php file to some reasonabel value (to a real path which exists on your machine). 

<a name="Exercises"></a>
## Exercises 

<a name="Exercise_1"></a>
### Exercise 1 – Find users of the app and their passwords
**Short Description**
The list of the movies of the application is accessible by all users (including anonymous users too) at {hostname}/piha/movie/movielist.php (but {hostname}/piha also redirects here). Find a vulnerability in this service and exploit it, so that you can see all users of the application and their passwords!
Login with the newly accessed passwords!

**URL**
On the {hostname}/piha/movie/movielist.php endpoint you can list movies of the database. This endpoint is accessible to anonymous (not logged in) users too.  

**Detailed description**
The service behind this endpoint is vulnerable to one of the most classic exploit of programming. Find the vulnerability, and exploit it so that you can get users and their passwords from the database! (Hint: The table containing the users' data is called APPUSER.)   
When you are done, check the source code movie/movielist.php and fix it.   
Discuss what could have been the developers motivation creating this code!  

<a name="Exercise_2"></a>
### Exercise 2 – change another user's password
**Short Description**
The application contains a password change functionality under Profile->Change password. Abuse it to change another user's password!


**Detailed description**
The change password service first creates a password-change xml to call a remote password change service with it (in reality the remote service does nothing remotely, just parses the xml and changes the password locally).  
Find a vulnerability within this service!  
This is how the password service creates the xml file:
```php
function createXml($name, $newPassword)
{
    $xmlString = <<<EOD
            <?xml version="1.0" encoding="UTF-8"?>
            <PasswordChange>
                <pwd>PWD_TO_REPLACE</pwd>
                <userName>USERNAME_TO_REPLACE</userName> 
            </PasswordChange>
            EOD;
    $xmlString = str_replace("PWD_TO_REPLACE", $newPassword, $xmlString);
    $xmlString = str_replace("USERNAME_TO_REPLACE", $name, $xmlString);
    return $xmlString;
}
```

After the exploit fix the vulnerability within the code!



<a name="Exercise_3"></a>
### Exercise 3 – File handling
**Short Description**
The application has a file upload and a file download functionality. Both of them suffer from several vulnerabilities. Find a vulnerability, with which you can read any file from the server's files-system!

**Detailed description**
The application stores uploaded files on the server's file-system. In order for the upload and download functionality to work you first have to set the value of the IMAGE_FOLDER constant defined in common/constants.php file to some reasonabel value (to a real path which exists on your machine).  
Then you can upload profile image in Profile->My profile picture, and you can see other user's profile picutre at Profile->Other user's profile (enter a valid user-name into the search input to see his/her uploaded picture).
Try to use the Other user's profile page to access arbitrary files from the server!
Once you are done fix the found vulnerability!  

<a name="Exercise_4"></a>
### Exercise 4 – File handling (upload)
**Short Description**
The application has a file upload and a file download functionality. Both of them suffer from several vulnerabilities. Find a vulnerability, with which you can uploaad a backdoor to the http server!

**Detailed description**
You can upload a profile image in Profile->My profile picture.  
Check the code at user/uploadprofilepicture.php to see how it works!  
This is the key part:
```php
$path_parts = pathinfo($_FILES["profilepicture"]["name"]);
$extension = $path_parts['extension'];
$target_file = IMAGE_FOLDER . $_SESSION["login"] . "." . $extension;
move_uploaded_file($_FILES["profilepicture"]["tmp_name"], $target_file);
```
How can you abuse this code to upload a file outside of the IMAGE_FOLDER?  
Once you are done fix the found vulnerability! 
What other vulnerabilities have you noticed within this file-upload?  

<a name="Exercise_5"></a>
### Exercise 5 – URL handling
**Short Description**
Authenticated users can change the theme of their application. However this functionality contains a sever URL-related vulnerability. Find and fix it!

**Detailed description**
Once logged in you can change the color-theme of the app at Profile->My Profile. Check what changes in the HTML source-code when you change your theme.  
If you have an idea now how to hack it, go for it. You can access several sensitive data by exploiting this vulnerability.  
If you don't find the vulnerability check the user/myprofile.php file!  
Finally fixt the vulnerability!



<a name="Exercise_6"></a>
### Exercise 6 – XSS
**Short Description**
The movie/movielist.php suffers from XSS vulnerability. Find it and fix it!

**Detailed description**  
Find all the XSS vulnerabilities at movie/movielist.php!   
Fix them!
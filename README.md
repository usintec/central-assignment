# Kanban board for Github issues

## About

This is a simple, read-only, Kanban-board for Github issues.

### Concepts and workflow

* `Queued:` are open issues, in a milestone with no one assigned
* `Active:` are any open issue, in a milestone with someone assigned
   * Active issues can, optionally, be paused by adding any of the configured "pause labels" to the issue
* `Completed:` are any issues in a milestone that is closed

#### Required environment variables

* `GH_CLIENT_ID`
* `GH_CLIENT_SECRET`
* `GH_ACCOUNT`
* `GH_REPOSITORIES`

# Application URL

## https://central.ijmb-jupeb-assured.com/

# Steps to run the Application on Windows OS

## Prerequisite

* Windows os version 7 and above
* Composer
* PHP 7.2
* Apache webserver
* Xampp (PHP 7.2 & Apache): https://downloadsapachefriends.global.ssl.fastly.net/7.2.34/xampp-windows-x64-7.2.34-0-VC15-installer.exe?from_af=true

## Step 1

* Clone the repository in a new directory (central-ass): git clone https://github.com/usintec/central-assignment.git 
* Navigate to the project directory (central-ass) and run: composer install
* Create .env file in the project direcoty add the information below with your github info:
* Note: you will get GH_CLIENT_SECRET & GH_CLIENT_ID when you create Oauth app in github.
* 1.  GH_REPOSITORIES=Gas-Law-Computation-Software|central-assignment|cms-products-api-nodejs
* 2.  GH_ACCOUNT=usintec
* 3.  GH_CLIENT_SECRET=xxxxxxxxxxxxxx
* 4.  GH_CLIENT_ID=xxxxxxxxxxxx

## Step 2
* Copy your project folder to C:\xampp7.2\htdocs to host the application locally
* Note: while creating app oAuth app on github, you are to provide "http://localhost/central-ass/src/public/" as your callback url
* Start Apache webserver in Xampp.
* Start your favourite browser and enter the url: http://localhost/central-ass/src/public/

## Congratulations

# Steps to run the Application on Linux Ubuntu & Host on DigitalOcean

## Prerequisite
* Droplet (VM) running Linux Ubuntu 20.04
* Composer
* Nginx
* Domain Name
* Certbot (optional)

## Step 1

* Clone the repository in a new directory (central-ass): git clone https://github.com/usintec/central-assignment.git 
* Navigate to the project directory (central-ass) and run:  composer install --ignore-platform-req=ext-mbstring
* Create .env file in the project direcoty add the information below with your github info:
* Note: you will get GH_CLIENT_SECRET & GH_CLIENT_ID when you create Oauth app in github.
* 1.  GH_REPOSITORIES=Gas-Law-Computation-Software|central-assignment|cms-products-api-nodejs
* 2.  GH_ACCOUNT=usintec
* 3.  GH_CLIENT_SECRET=xxxxxxxxxxxxxx
* 4.  GH_CLIENT_ID=xxxxxxxxxxxx

## Step 2
* Copy your project folder to "~/../var/www" to host the application on the webserver
* Note: while creating app oAuth app on github, you are to provide "http://localhost/central-ass/src/public/" as your callback url
* Create Nginx virtual host: https://serverspace.io/support/help/nginx-virtual-hosts-on-ubuntu-20-04/
* Create symbolic link: sudo ln -s /etc/nginx/sites-available/central-ass.com /etc/nginx/sites-enabled/
* Test your configuration with sudo nginx -t
* Restart the server with sudo systemctl reload nginx or sudo service nginx restart
* Protect your domain with SSL certificate: certbot --nginx -d central.ijmb-jupeb-assured.com -d www.central.ijmb-jupeb-assured.com

## Congratulations

## Note: Automated testing will be added soon

# Another assignment with my videos that may be of intrest to you

## https://github.com/usintec/cms-products-api-laravel.git
----

_Originally a "fork" of the [Kanban Board](https://github.com/ellislab/kanban-board) plugin to [ExpressionEngine](https://ellislab.com/expressionengine) then more or less completely rewritten._

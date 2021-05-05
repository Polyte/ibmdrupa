# ibmdrupal
Drupal is a free and open source content-management framework written in PHP and distributed under the GNU General Public License. Drupal provides a back-end framework for at least 2.3% of all web sites worldwide – ranging from personal blogs to corporate, political, and government sites.

Lando offers a configurable recipe for developing Drupal 9 apps.

Getting Started
Before you get started with this recipe we assume that you have:

Installed Lando and gotten familiar with its basics
Initialized a Landofile for your codebase for use with this recipe
Read about the various services, tooling, events and routing Lando offers.
 
 
############LETS START#####################

First clone the repository to your local machine atleast running the latest Docker Engine

The lando.yml file contains the below which sets all required images to be configured for drupal 9

3 Containers are installed after the first build command:

Type "Lando start" to get started on your cmd. This will install all the containers to make this project runable on Windows, Linux and Other Distros.


name: ibmdrupal
recipe: drupal9
config:
  php: '7.3'
  composer_version: '2.0.7'
  via: apache:2.4
  webroot: .
  database: mysql:5.7
  drush: true
  xdebug: false
 
 #####################################################

# Start it up
lando start

* This will start our appserver and database(mysql 5.7) services which will be opened(accessed) as urls to:
 http://ibmdrupal.lndo.site:8080/ or ', 'https://ibmdrupal.lndo.site/' 

# List information about this app.
lando info

######################### The Drupal 9 Website Already contains a configured JSON:API module that exposes
Mobile Phone Products with the Field Names: 
Product Name(Title),
Description, 
SKU & Price. 
##########################

These can be viewable once the project is running the drupal install.

To view JSON exposed data type: /api/phones which will expose all the products on the dashboard of your drupal install.

e.g 

'http://ibmdrupal.lndo.site:8080/api/phones

'https://ibmdrupal.lndo.site/api/phones

Our Backend already contains a Custom Post Type Phones and can be used to add or modify additional Projects.

If anything is unclear please let me know on phmakwala@gmail.com

Thank you for using my Lando Drupal Repo. Feel free to use at your own tests.

:)

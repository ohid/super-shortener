# Lara Todo

Super Shortener is a URL shortening app built on top of Laravel framework. 
Super shortener shortens urls with ajax response and givs all statistics info about url in google chart graph.


### Version
master

### Live Demo
http://url.ohidul.com/

### Installation

Clone this repository first-
```sh
$ git clone https://github.com/ohid/super-shortener.git super-shortener
```

Now cd into super-shortener-
```sh
$ cd super-shortener
```

Install composer-
```sh
$ composer install  
```

Duplicate `.env.example` file to `.env` file to create a environment file-
```sh
$ cp .env.example .env
```

Edit `.env` file with with your database credential and mail service

Now create database tables by running this command-
```
php artisan migrate
```

Generate a application key
```
php artisan key:generate
```

## Run on server
```
php artisan serve
```


Now you are all setup to go. Thanks

## Have any  question?
ask me at ohidul.islam951@gmail.com


# Screenshots

Home page shortening url
![Home page shortening url](https://f80b40e2f310199b7fee1416426c7e105de8fafa.googledrive.com/host/0B6SVI7iK7bjjOEFkNDJjXzBQRG8)

![List of urls](https://37873425a3ec674ffd28d1839dd44501f2da12a5.googledrive.com/host/0B6SVI7iK7bjjelpHamNvV2RrTlE)

Statistics of url
![Statistics of url](https://3a207e688e472a46f8d68d626e56840030f780bc.googledrive.com/host/0B6SVI7iK7bjjU1dIUS1mM05KaUE)

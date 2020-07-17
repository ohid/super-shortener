# Super Shortener

Super Shortener is a URL shortening app built on top of Laravel framework. 
Super shortener shortens urls with ajax response and givs all statistics info about url in google chart graph.


### Version
master

### Live Demo
http://url.dhrubok.website/

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
![Home page shortening url](https://i.imgur.com/qCSbYtX.png)

Statistics of url
![Statistics of url](https://i.imgur.com/IDT7iAH.png)
![Statistics of url](https://i.imgur.com/oWYNnkR.png)

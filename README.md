# SPREADTHELOVE

## What is that ?

At HelloAsso we are used to sending each other little kind words for christmas period

This repo contain a single page to collect words and a script to send mail

## How to run

You need ready to use php web server and a mysql/mariadb to run this project

Set environment variable by using .env (see .env.example for example ;)) or use command line to setup you environment

Create schema on your mysql server with `db.sql`

install dependencies `composer install`

And let's go !

## How to use

I use it like that:
- Deploy everything except sender.php (otherwise people can send mail before end)
- Fill `receiver` table with your data
- Give deadline to people to write words
- Close website
- Deploy & visit sender.php
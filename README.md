# SlamQuiz
================================
## Introduction
Slamquiz is a Mcq software, offering a panel of questions randomly selected 
![Accueil](https://raw.githubusercontent.com/RomainY/SlamQuiz/develop/assets/screenshot_home.PNG)

## Setup
* Open Command Prompt terminal
* Write `git clone https://github.com/RomainY/slamstarter.git`
* and `Composer install`

## Load the DataBase
* Go to phpMyAdmin and create an user 'slamquiz', and a database with all privileges to this user
* Go to the '.env' file in SlamQuiz
	* Configure your database with id and pass of your user -> in 										`DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name`
* Write `php bin/console doctrine:migrations:migrate`
	* Now your Database is created
 	[Plan détaillé](https://github.com/RomainY/SlamQuiz/blob/develop/Astuces/00_symf_category_entity.txt)
* Write `php bin/console doctrine:fixtures:load`
	* The  database are created with data in the 'src\DataFixtures' folders
	* *[Create additional fixtures](https://github.com/RomainY/SlamQuiz/blob/develop/Astuces/02_create_category_fixtures.txt)


## Boot 
* Open Command Prompt terminal
* Go to 'SlamQuiz' folder [C:\>cd wamp64/www/SlamQuiz]
* Write `php bin/console server:run`
* In your browser write in the url the link you got [Often: http://127.0.0.1:8000]


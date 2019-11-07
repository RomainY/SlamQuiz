# SlamQuiz
================================
## Présentation
Slamquiz est un logiciel de Qcm , proposant un panel de questions choisies aléatoirement 
![Accueil](https://raw.githubusercontent.com/RomainY/SlamQuiz/develop/assets/screenshot_home.PNG)

## Installation du logiciel
* Ouvrez un invite de commande windows (cmd)
* Tappez la commande 'git clone https://github.com/RomainY/SlamQuiz.git'
* Tappez la commande 'Composer install'

## Charger la base de données
* Allez dans phpMyAdmin puis créez un utilisateur 'slamquiz', et créez ui une base de donnée avec tout les privilèges
* Allez dans le fichier '.env' dans SlamQuiz
	* Configurez aves les informations de votre utilisateur -> dans ###> doctrine/doctrine-bundle ###
* Dans l'invite de commande tappez 'php bin/console doctrine:migrations:migrate'
	* Ceci va créer la Bd
 	[Plan détaillé](https://github.com/RomainY/SlamQuiz/blob/develop/Astuces/00_symf_category_entity.txt)
* Puis tappez 'bin/console doctrine:fixtures:load'
	* Ce qui va charger la Bd avec les données fournis dans le dossier 'src\DataFixtures'
	* *[Pour créer de nouvelles fixtures](https://github.com/RomainY/SlamQuiz/blob/develop/Astuces/02_create_category_fixtures.txt)


## Utiliser le logiciel
* Ouvrez un invite de commande windows (cmd)
* Placez vous dans le répertoire 'SlamQuiz' [C:\>cd wamp64/www/SlamQuiz]
* Tappez la commande 'php bin/console server:run'
* dans votre navigateur tappez dans l'url le chemin donné [Souvent: http://127.0.0.1:8000]


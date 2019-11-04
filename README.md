# SlamQuiz
================================
## Présentation
Slamquiz est un logiciel de Qcm , proposant un panel de questions choisies aléatoirement 

## Installation du logiciel
* Ouvrez un invite de commande windows (cmd)
* Tappez la commande 'git clone https://github.com/RomainY/slamstarter.git'
* Tappez la commande 'Composer install'

##Charger la base de données
* Dans l'invite de commande tappez 'php bin/console doctrine:migrations:migrate'
	* Ceci va créer la Bd
 	*[Plan détaillé](Astuces\00_symf_category_entity.txt)
* Puis tappez ''
	* Ce qui va charger la Bd avec les données fournis dans le dossier 'src\DataFixtures'
	* *[Pour créer de nouvelles fixtures](Astuces\02_create_category_fixtures.txt)

## Ajouter de nouvelles tables

## Utiliser le logiciel
* Ouvrez un invite de commande windows (cmd)
* Placez vous dans le répertoire 'SlamQuiz' [C:\>cd wamp64/www/SlamQuiz]
* Tappez la commande 'php bin/console server:run'
* dans votre navigateur tappez dans l'url le chemin donné [Souvent: http://127.0.0.1:8000]
* Résultat obtenu 

![Accueil](assets\screenshot_home.PNG)

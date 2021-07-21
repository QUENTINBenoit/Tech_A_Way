# Initialisation de base

- Réalisation du clone du repos dans son dossier local grâce à la clé ssh et la commande "git clone clé-ssh-du-repos".
- Installer le package symfony website-skeleton à l'aide de composer et de la commande : "composer create-project symfony/website-skeleton my_project_name" (https://symfony.com/doc/current/setup.html).

# Création de sa branche de travail

- Dans composer, créer une nouvelle branche de travail nommé selon la fonctionnalité développée sur cette branche à l'aide de la commande : git checkout -b nom-de-la-branche.

# Fichier de configuration
On crée le fichier `.env.local` à la racine du projet. C'est dans ce fichier qu'on renseignera les accès à la base de données.

`DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.3.25"` 

Pour récupérer la version de mysql (MariaDB), on peut lancer la commande :
- `mysql --version` (mysql  Ver 15.1 Distrib *10.3.29*-MariaDB, for debian-linux-gnu (x86_64) using readline 5.2)

- `db_user` : l'identifiant de connexion à la BDD
- `db_password` : le mot de passe permettant l'accès à la BDD
- `db_name` : c'est le nom de votre base de données

:warning: il faut renseigner votre propre version de Mariadb ou de MySQL

## Création de la BDD
- `php bin/console doctrine:database:create` ou `php bin/console d:d:c`

## Création des entités
on utilise la commande maker : 
- `php bin/console make:entity`
Ensuite on renseigne les  propriétés (nom, type, null? ...)
après avoir crée la table et renseigné les propriétés, on retrouve dans src\Entity la classe Product avec les propriétés et getter/setter associés.
on retrouve également dans src/Repository les méthodes génériques qui pourront être utilisés plus tard (quand la BDD sera opérationnelle) pour faire des requêtes SQL.

## Migration

- `php bin/console make:migration`

La commande va créer un fichier dans le dossier `migration` 

Ensuite, on lance cette migration afin de générer nos tables dans la BDD

- `php bin/console doctrine:migrations:migrate`

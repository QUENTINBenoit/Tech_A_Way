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

## fixtures
les fixtures permettent de créer en BDD des items aléatoires dans les tables désirées afin de pouvoir travailler avec ces données dans symfony.
commande : `composer require --dev orm-fixtures`

Then, we load the data in the database with command :
- `php bin/console doctrine:fixtures:load`

### Faker
use next command to load Faker : `composer require fzaninotto/faker`
`use Faker;`
in the method load, make : `$faker = Faker\Factory::create('fr_FR');`


## User
### make user
Before authenticating, we create an User: 
- `php bin/console make:user` (name of the security user class = UserSecurity)

In the configuration, I specify that the element that will allow the user to connect is his email. 
I also choose to hash passwords because it is an obligation for all sites
Then, 2 folders have been created :  src/Entity/UserSecurity.php (automatically generated some methods of Userinterface in it like the getUserIdentifier method that returns the email) and src/Repository/UserSecurityRepository.php

An other folder has been updated : config/packages/security.yaml. Into this folder, we see "algorithm : auto" that does it mean that symfony will automatically encode passwords with the best algorithm.

Then we can add property in entity User to complete before to do nex commands :
- `php bin/console make:migration`
- `php bin/console doctrine:migrations:migrate` 
### set up authentication
we are going to set up a guard authenticator
- `php bin/console make:auth`
we call class of the authenticator "LoginFormAuthenticator" and the controller class "SecurityController"
- created: `src/Security/LoginFormAuthenticator.php`
- updated: `config/packages/security.yaml`
- created: `src/Controller/SecurityController.php`
- created: `templates/security/login.html.twig`

Now, we can access to page /login to authenticate.
Whatever page we go to, symfony will call the LoginFormAuthenticator to verify that we have the right to access it.
i finish the redirect "homepage" in the App\Security\LoginFormAuthenticator::onAuthenticationSuccess() method.

### make registration

we create a form so that the customer can register
- `php bin/console make:registration-form`

 updated: src/Entity/User.php
 created: src/Form/RegistrationFormType.php
 created: src/Controller/RegistrationController.php
 created: templates/registration/register.html.twig

 - `composer require symfony/rate-limiter` Then, configure so that the user has to wait 15 minutes after 3 connection attempts.


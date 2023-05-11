#JdcRestaurant  
  
Ce projet est un site web pour un restaurant, permettant aux utilisateurs de s'inscrire, de se connecter et de réserver une table. Le projet a été développé en utilisant les technologies suivantes :  
  
*PHP  
*Symfony  
*Twig  
*Doctrine  
*PostgreSQL  
*Prérequis  
  
##Avant d'exécuter ce projet en local, vous devez installer les outils suivants :  
  
*PHP  
*Composer  
*Symfony CLI  
*PostgreSQL  
  
#Installation  
  
##Clonez ce dépôt de code en utilisant la commande suivante :  
git clone https://github.com/votre-nom-d-utilisateur/JdcRestaurant.git  

Installez les dépendances en utilisant Composer :  
cd JdcRestaurant  
composer install  
  
Créez la base de données :  
php bin/console doctrine:database:create  
php bin/console doctrine:schema:create  

(Fixture uniquement pour les utilisateur création 1à ProfilUser avec le rôle  ROLE_USER) Si vous souhaitez remplir la base de données avec des données de test, exécutez :  
php bin/console doctrine:fixtures:load  
  
Lancez le serveur Symfony :  
symfony serve  
  
Le site web devrait maintenant être accessible à l'adresse http://localhost:8000.  
  
Création d'un administrateur  
  
Pour créer un administrateur qui aura accès au back-office du site web, suivez les étapes suivantes :  

Connectez-vous à la base de données PostgreSQL en utilisant un client SQL.
Pour créer un adminstateur faire la commande dans le terminal symfony console d:f:l cela créra 10 utilisateur avec le role user et 2 avec le role admin
Connectez-vous au site web avec ce nouvel utilisateur pour accéder au back-office et au Dashboard de EasyAdmin.
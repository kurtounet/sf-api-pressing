Installation du bundle:
composer require --dev symfony/test-pack
Créer un test :
symfony console make:test
Commande pour exécuter les tests :
Php bin/phpunit : exécution des tests

Créer la base de données pour les tests :
Symfony console d:d:c --env=test
Application des migrations pour les tests :
Symfony console d:m:m --env=test
Charger la base de données de test :
Symfony console d:f:l --env=test

Commande pour exécuter un test spécifique :
php bin/phpunit --filter AuthTest
Exécuter une méthode de test spécifique :
php bin/phpunit --filter AuthTest::testLogin

php bin/phpunit --filter BasicTest::testSomething --testdox
php bin/phpunit --filter ApiAuthentificationTest::testLoginWithValidCredentials

sous windows : set .........
Script Composer:
"scripts": {
    "test": "set APP_ENV=test && php bin/phpunit"
}

commande: composer test --filter ClassTest::fonctionDeTest --testdox
composer test --filter ApiAuthentificationTest::testLoginWithValidCredentials

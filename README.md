# PROJET DU BUSINESS CASE POUR L'EXAMEN DE FORMATION DEVELOPPEUR WEB/WEB MOBILE

# Test

composer require --dev symfony/test-pack symfony/http-client

created et update entity trait php voir gpt
php bin/console lexik:jwt:generate-keypair --overwrite

## À FAIRE

API

- created et update entity
- choix du service -> article -> quantité
- Faire une route pour récupérer les commandes sans employé : api/commandes/noassign (fait)
- Faire une route pour récupérer les commandes du client : api/client/commandes (fait)
- Faire une route pour Assigner une Commande a un employé ROLE_Employee: api/employee/items (fait)
- Faire une route pour Assigner une Commande a un employé ROLE_Employee: api/employee/items  
- Faire une route pour Employé qui indique qu'il a fini l' item Employee:api/item/{id}/complete
- Faire avec les catégories parent
- -

Faire une route pour

# Page côté front

### Login
> routes: /api/check_login
  
## Visiteur
### Landing page
liste 3 services
> routes: /api/services 
### Présentation des services
> routes: /api/services

## **Espace Utilisateur**
## Espace Client
>#### Page dépôt
>### Processuse de dépot    
    >- 1 Choix du service
    >   - route: GET /api/services
    >- 2 Choix des article ManyToMany entre SERVICE et ARTICLE
    >   - routes: GET /api/articles
    >- 3 Choix du quantité
    >   - route: /api/services
    >- 4 Valider le dépot
    >   - route:POST /api/items

### Page liste commandes
> controller
> route personnalisé : /api/commande/user/{id}
### Page panier
> stocker dans le localStorage
### Page liste Profile
> routes: /api/user/{id} 
### Page liste contact
> routes: /api/contact/
## Espace Admin
#### Page liste des ustilisateurs
> routes: /api/users
#### Page liste commandes
#### Page liste des taches
#### Page Profile
## Espace Employee
#### Page liste des taches
#### Page Profile
#### Page contact

### Espace Manager
### Espace Employee


## Employé - admin
> list des commande pour l'employer


## Admin
- Admin
  - liste de commande
  > routes: /api/commandes
  - liste des users
  > routes: /api/user
  - employer
  - client

# Page côté BACK

### Authentification

### Dashboard (a faire)
>
> - Services
> - utilisateurs
> - commandes

## Pour JWT

### Configuration

> - security.yaml (fait)
    - firewall (fait)
    - acces control (à terminer)
> - route.yaml (fait)

## CREATION DES ENTITEES

security: is_granteg("ROLE_ADMIN")
>
>- Article.php (fait v2)
>- Material.php (fait v2)
>- Meansofpayment.php (fait v2)
>- Category.php (fait)
>- Client (fait)
>- Commande.php (fait)
>- Employee (fait)
>- Item.php (fait)
>- ItemStatus.php (fait)
>- Service.php (fait)
>- User.php (fait)

## GROUPS DE SERIALISATION
>
>- Category.php
    - category:list:read    - category:write  
>- Client.php
    - client :read  - client :write  
>- Commande.php
    - commande:read - commande:write  
>- Employee
    - employee:read - employee:write
>- Item.php
    - item :read - item :write  
>- ItemStatus.php
    - itemStatus:read - itemStatus:write  
>- Service.php  
    - service :read - service :write
>- User.php  
    - user:read - user:write

## FIXTURES

>- Article.php (fait)
>- Category.php (fait) (avoir)
>- Commande.php
>- Item.php  
>- ItemEtat.php  (fait)
>- Material.php (fait)  
>- Meansofpayment.php (fait)
>- Service.php (fait)
>- ServiceStatus.php (fait)
>- User.php (fait) ok

## Création d'un projet API

Pour créer un projet en mode API, on va utiliser l'outil Symfony CLI :

```bash
symfony new my-project --version=6.4
```

Le projet créé par l'outil est beaucoup plus léger. On y trouve uniquement le composant Console, Dotenv, et quelques autres liés au framework. Mais nous n'avons plus toute la suite qui était installée en mode full-stack.

Si on liste les commandes disponibles, on constate qu'on n'a même pas le maker.

On va donc commencer par installer les composants dont on aura besoin.

Ensuite, on peut lancer le projet comme d'habitude avec la commande :

```bash
symfony serve --no-tls
```

Mais le profiler n'apparaît pas sur la page d'accueil.

## Installation de composants

Pour travailler en local, on va installer quelques composants usuels, tels que le profiler, Doctrine, le maker, etc.

Une fois ces composants installés, on pourra alors installer API Platform.

### SYMFONY FLEX

Symfony Flex est déjà intégré au projet. On retrouvera donc l'exécution de recettes automatiques au sein de notre projet.

### Doctrine

Pour installer le Bundle Doctrine, on peut utiliser son alias Flex :

```bash
composer require orm
```

La recette qui s'exécute nous crée automatiquement le fichier de configuration de Doctrine, les migrations, ajoute la variable d'environnement `DATABASE_URL`, etc. On pourra donc configurer l'accès à la base de données dans le fichier `.env.local`.

### Profiler

Le profiler peut être installé grâce au package `symfony/profiler-pack`. On peut utiliser l'alias `profiler`, et on veillera à l'ajouter en tant que dépendance de développement :

```bash
composer require --dev profiler
```

Si on relance l'application, on retrouve la Web Debug Toolbar en bas de page.

### Maker

Le maker peut quant à lui être installé avec l'alias `maker` :

```bash
composer require --dev maker
```

### Fixtures

Tout comme en mode full-stack :

```bash
composer require --dev orm-fixtures
```

On pourra ensuite installer Faker, au besoin.

### Security

Afin de pouvoir créer une classe d'utilisateurs et avoir de l'authentification et du contrôle d'accès, on peut ajouter le security-pack de Symfony :

```bash
composer require security
```

### Installation et création de la première ressource

Pour installer API Platform, on pourra utiliser son alias Flex `api` :

```bash
composer require api
```

### Création d'un projet API

```bash
symfony new bcapipressing --version=6.4
```

### Installation des bundles

Installation du bundle orm-fixtures (fait)

```bash
composer require --dev orm-fixtures
```

Installation du bundle fakerphp (fait)

```bash
composer require --dev fakerphp/faker
```

Installation du bundle symfony/orm-pack (fait)

```bash
composer require symfony/orm-pack
```

Installation du bundle maker (fait)

```bash
composer require --dev maker
```

Installation du bundle security (fait)

```bash
composer require security
```

Installation du bundle API (fait)

```bash
composer require api
```

Installation du bundle lexik JWT (fait)

```bash
composer require lexik/jwt-authentication-bundle
```

```bash
php bin/console lexik:jwt:generate-keypair
```

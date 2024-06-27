# PROJET DU BUSINESS CASE POUR L'EXAMEN DE FORMATION DEVELOPPEUR WEB/WEB MOBILE

## À FAIRE

API
    Toute pour récupérer les commande sans employer

php bin/console lexik:jwt:generate-keypair --overwrite

- Faire les groupes de sérialisation dans les entity
- Faire les fixtures
- choix du service -> article -> quantité
- Route pour récupérer les commandes sans employé
- Assigner une Commande a un employé ROLE_ADMIN
- Employé indique qu'il a fini la commande ROLE_ADMIN

# Page côté front

### Login
> routes: /api/check_login
  
## Visiteur
### Landing page 
liste 3 services
> routes: /api/services  

### Présentation des service
> routes: /api/services
 
## Espace Utilisateur:

### Page profile
> routes: /api/user/{id}  
  
### Page liste commande
> controller
> route personnalisé : /api/commande/user/{id}

### Page dépôt
>### Processuse de dépot:
    >- 1 Choix du service 
    >   - route:GET /api/services
    >- 2 Choix des article ManyToMany entre SERVICE et ARTICLE
    >   - routes:GET /api/articles 
    >- 3 Choix du quantité 
    >   - route: /api/services
    >- 4 Valider le dépot
    >   - route:POST /api/items

### Page panier

### - contact
> routes: /api/contact/ 

panier

## Employé - admin
    > list des commande pour l'employer
    > routes: /api/check_login
    
## Admin
- Admin
  - liste de commande
  >routes: /api/commande
  - liste des users 
  >routes: /api/user
    - employer
    - client
 
# Page côté BACK

### Authentification
### Dashboard
> - Services
> - utilisateurs
> - commandes
 



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
## Pour JWT
### Configuration :

#### security.yaml

#### route.yaml

## CREATION DES ENTITEES
security: is_granteg("ROLE_ADMIN")
>- Article.php (fait)
>- Category.php (fait) (avoir)
>- Commande.php (fait)
>- Item.php (fait)
>- ItemEtat.php (fait)
>- Material.php (fait)
>- Meansofpayment.php (fait)
>- Service.php (fait)
>- ServiceStatus.php (fait)
>- User.php (fait)

## GROUPS SERIALISATION
>- Article.php 


#[ApiResource(
    normalizationContext: ['groups' => ['articles:list']],
    operations: [
        new GetCollection()
    ]
)]
#[ApiFilter(BooleanFilter::class, properties: ['visible'])]
#[ApiFilter(SearchFilter::class, properties: ['title' => 'ipartial'])]
>- Category.php  
>- Commande.php  
>- Item.php  
>- ItemEtat.php  
>- Material.php  
>- Meansofpayment.php  
>- Service.php  
>- ServiceStatus.php  
>- User.php  

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

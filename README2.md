# Etape 1: CREATION REPO GITHUB
> puis git clone https:.....(ton repo)

# Etape 2: Installation du symfony CLI

TOUT CE FAIT DANS LE TERMINAL (POWER SHELL)

## La doc : <https://symfony.com/download>

 1.installation de scoop la doc <https://scoop.sh/>
## IL NE FAUT PAS que powershell soit en administarteur
Quand tu ouvre powershell tu as :
Pour mon pc
 ```bash
PS C:\Users\Tony> 
 ```
ensuite tu tape : cd /
Comme ca:
 ```bash
PS C:\Users\Tony> cd /
 ```
cela donne :
 ```bash
PS C:\>:
 ```
TU colle ca :
```bash
 Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
Invoke-RestMethod -Uri <https://get.scoop.sh> | Invoke-Expression
```
comme ca :
 ```bash
PS C:\> Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
Invoke-RestMethod -Uri <https://get.scoop.sh> | Invoke-Expression
```

 ```

 ```bash
PS C:\> prompt, run:
 ```
 ```bash
 Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
Invoke-RestMethod -Uri <https://get.scoop.sh> | Invoke-Expression
```

 2 .installation de symfony Cli

 ```bash
 scoop install symfony-cli
```

# Etape 3: Création d'un projet Symfony

## DANS LE DOSSIER DE TON REPO (Apres le git clone)
Pour créer un projet en mode API, on va utiliser l'outil Symfony CLI :

```bash
symfony new my-project --version=6.4
```

Ensuite, on peut lancer le projet comme d'habitude avec la commande :

```bash
symfony serve --no-tls
```

Mais le profiler n'apparaît pas sur la page d'accueil.

## Installation des composants

### Doctrine

Pour installer le Bundle Doctrine

```bash
composer require symfony/orm-pack
```

### Profiler

```bash
composer require --dev profiler
```

### Maker

```bash
composer require --dev maker
```

### Fixtures

Tout comme en mode full-stack :

```bash
composer require --dev orm-fixtures
```

On pourra ensuite installer Faker, au besoin.

```bash
composer require --dev fakerphp/faker
```

### Security

Afin de pouvoir créer une classe d'utilisateurs et avoir de l'authentification et du contrôle d'accès, on peut ajouter le security-pack de Symfony :

```bash
composer require security
```

### Installation et création de la première ressource

Pour installer API Platform:

```bash
composer require api
```

## Installation du bundle lexik JWT (pour les JWT)

```bash
composer require lexik/jwt-authentication-bundle
```








# PROJET DU BUSINESS CASE POUR L'EXAMEN DE FORMATION DEVELOPPEUR WEB/WEB MOBILE

# Test 
composer require --dev symfony/test-pack symfony/http-client


created et update entity trait php voir gpt
php bin/console lexik:jwt:generate-keypair --overwrite

## À FAIRE
API
- Route pour récupérer les commande sans employer
- created et update entity 
- choix du service -> article -> quantité
- Route pour récupérer les commandes sans employé
- Assigner une Commande a un employé ROLE_Employer
- Employé indique qu'il a fini la commande Employee

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
### Dashboard (a faire)
> - Services
> - utilisateurs
> - commandes
 




## Pour JWT
### Configuration :

> - security.yaml (fait)
    - firewall (fait)
    - acces control (à terminer)
> - route.yaml (fait)
 

## CREATION DES ENTITEES
security: is_granteg("ROLE_ADMIN")
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


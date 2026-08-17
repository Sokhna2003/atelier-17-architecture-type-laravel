# Atelier 17 — Architecture type Laravel

Mini-application PHP illustrant l'architecture de Laravel : front-controller, router, controllers, container (injection de dépendances) et views.

## Sommaire

- [Aperçu](#aperçu)
- [Architecture](#architecture)
- [Structure du projet](#structure-du-projet)
- [Installation](#installation)
- [Routes disponibles](#routes-disponibles)
- [Workflow Git](#workflow-git)

## Aperçu

Le projet reproduit le squelette de Laravel avec un point d'entrée unique (`public/index.php`), un router qui associe URL et contrôleurs, un container qui construit les objets et injecte leurs dépendances automatiquement, et des vues séparées de la logique métier.

```
Requête HTTP
    │
    ▼
public/index.php   ← front-controller : point d'entrée unique
    │
    ▼
Router              ← route la requête vers un Controller
    │
    ▼
Controller           ← appelle Repository, renvoie une View
    │
    ├── Repository   ← accès aux données (PDO)
    └── View          ← rendu HTML
```

## Architecture

| Couche | Rôle | Fichiers |
|---|---|---|
| Front-controller | Point d'entrée unique de toute requête | `public/index.php` |
| Router | Associe méthode + URL → `Controller@action` | `core/Router.php`, `routes/web.php` |
| Container | Construit les objets, injecte les dépendances (réflexion PHP) | `core/Container.php` |
| Controller | Reçoit la requête, appelle les Repositories, renvoie une View | `app/Controllers/` |
| Repository | Accès aux données via PDO | `app/Repositories/` |
| View | Rendu HTML, séparé de la logique | `core/View.php`, `views/` |
| Database | Connexion PDO (singleton) | `core/Database.php`, `config/database.php` |

Seul le dossier `public/` est exposé par le serveur web ; `app/`, `core/` et `routes/` restent hors de portée du navigateur.

## Structure du projet

```
atelier-17-architecture-type-laravel/
├── app/
│   ├── Controllers/
│   │   ├── HomeController.php     (index, about)
│   │   └── BookController.php     (index)
│   └── Repositories/
│       ├── BookRepositoryInterface.php
│       └── BookRepository.php
├── bootstrap/
│   └── autoload.php               (autoloader PSR-4 maison)
├── config/
│   └── database.php                (paramètres de connexion PDO)
├── core/
│   ├── Container.php               (injection de dépendances)
│   ├── Database.php                 (singleton PDO)
│   ├── Router.php                    (routage)
│   └── View.php                       (rendu des templates)
├── public/
│   └── index.php                      (front-controller)
├── routes/
│   └── web.php                         (déclaration des routes)
└── views/
    ├── home.php
    ├── books.php
    └── about.php
```

## Installation

**Prérequis** : PHP 8+, une base MySQL, Apache ou le serveur intégré de PHP.

1. Cloner le repo :
   ```bash
   git clone https://github.com/sokhna2003/atelier-17-architecture-type-laravel.git
   cd atelier-17-architecture-type-laravel
   ```

2. Configurer la base de données dans `config/database.php` :
   ```php
   return [
       'host' => 'localhost',
       'dbname' => 'bibliotheque',
       'user' => 'root',
       'password' => '',
   ];
   ```

3. Importer le schéma et les données de la table `books` (et `categories`) dans MySQL.

4. Lancer le serveur :
   ```bash
   php -S localhost:8000 -t public
   ```
   ou pointer le document root d'Apache vers le dossier `public/`.

5. Ouvrir `http://localhost:8000` dans le navigateur.

## Routes disponibles

| Méthode | URL | Contrôleur | Description |
|---|---|---|---|
| GET | `/` | `HomeController@index` | Page d'accueil |
| GET | `/books` | `BookController@index` | Liste des livres (depuis la base) |
| GET | `/about` | `HomeController@about` | Page à propos |

## Workflow Git

Le projet a été construit branche par branche, une par fonctionnalité :

| Branche | Contenu |
|---|---|
| `feature/squeletteCore` | Front-controller, router, container, vue, config |
| `feature/pageAccueil` | `HomeController@index` + `views/home.php` |
| `feature/listeLivres` | `BookRepository`, `BookController` + `views/books.php` |
| `feature/pageAbout` | `HomeController@about` + `views/about.php` |

Chaque branche a été fusionnée dans `main` après son commit dédié.

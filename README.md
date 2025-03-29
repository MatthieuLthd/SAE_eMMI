# SAE_eMMI

## Table des matières

1. [Introduction](#introduction)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Structure des répertoires](#structure-des-répertoires)
5. [Dépendances](#dépendances)
6. [Exécution du projet](#exécution-du-projet)
7. [Routes](#routes)
8. [Contributeurs](#contributeurs)

## Introduction

SAE_eMMI est une application web développée avec Symfony et AngularJS. Elle permet la gestion des événements et des utilisateurs, avec des fonctionnalités d'inscription, de connexion, et de tableau de bord pour les administrateurs et les utilisateurs.

## Installation

### Prérequis

- PHP >= 7.4
- Composer
- Node.js et npm
- MySQL
- XAMPP (ou tout autre serveur web local)

### Étapes d'installation

1. Clonez le dépôt du projet :

    ```bash
    git clone https://github.com/MatthieuLthd/SAE_eMMI.git
    cd SAE_eMMI
    ```

2. Installez les dépendances PHP avec Composer :

    ```bash
    composer install
    ```

3. Installez les dépendances JavaScript avec npm :

    ```bash
    npm install
    ```

4. Configurez votre base de données dans le fichier `.env` :

    ```dotenv
    DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
    ```

5. Créez la base de données et exécutez les migrations :

    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

6. Démarrez le serveur web local :

    ```bash
    symfony server:start
    ```

## Configuration

### Fichier `.env`

Le fichier `.env` contient les variables d'environnement nécessaires à la configuration de l'application. Assurez-vous de configurer correctement les paramètres de connexion à la base de données.

### Configuration de Symfony

Les fichiers de configuration de Symfony se trouvent dans le répertoire `config/`. Les principaux fichiers de configuration incluent :

- `config/packages/` : Contient les configurations des différents bundles et services.
- `config/routes.yaml` : Définit les routes de l'application.

### Configuration d'AngularJS

Les fichiers de configuration d'AngularJS se trouvent dans le répertoire `Frontend/Configuration/`. Le fichier principal est `app.js`, qui configure les routes et les contrôleurs AngularJS.

## Structure des répertoires

Voici un aperçu de la structure des répertoires du projet :


GitHub Copilot
Voici la documentation technique en Markdown pour votre fichier README.md :

SAE_eMMI/
├── Backend/
│   ├── config/
│   ├── public/
│   ├── src/
│   │   ├── Controller/
│   │   ├── Entity/
│   │   ├── Form/
│   │   ├── Repository/
│   ├── templates/
│   ├── translations/
│   ├── var/
│   ├── vendor/
├── Frontend/
│   ├── Configuration/
│   │   ├── app.js
│   ├── Controllers/
│   │   ├── dashboardService.js
│   │   ├── dashboardController.js
│   │   ├── userService.js
│   │   ├── userController.js
│   ├── Page/
│   │   ├── dashboard.html
│   │   ├── register.html
│   │   ├── events.html
├── README.md





## Dépendances

### Dépendances PHP

Les dépendances PHP sont gérées par Composer et définies dans le fichier `composer.json`. Voici quelques-unes des principales dépendances :

- Symfony Framework
- Doctrine ORM
- Twig

### Dépendances JavaScript

Les dépendances JavaScript sont gérées par npm et définies dans le fichier `package.json`. Voici quelques-unes des principales dépendances :

- AngularJS
- Bootstrap

## Exécution du projet

### Démarrer le serveur Symfony

Pour démarrer le serveur Symfony, exécutez la commande suivante :

```bash
symfony server:start
```

## Routes

### Routes Symfony

Les routes Symfony sont définies dans le fichier `config/routes.yaml`. Voici quelques-unes des principales routes :

- `/dashboard` : Tableau de bord
- `/events` : Liste des événements
- `/events/create` : Créer un événement
- `/events/{id}/update` : Mettre à jour un événement
- `/events/{id}/delete` : Supprimer un événement

### Routes AngularJS

Les routes AngularJS sont définies dans le fichier `Frontend/Configuration/app.js`. Voici quelques-unes des principales routes :

- `#/dashboard` : Tableau de bord
- `#/register` : Inscription
- `#/events` : Liste des événements

## Contributeurs

- Nom du contributeur 1
- Nom du contributeur 2

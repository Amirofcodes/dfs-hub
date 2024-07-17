# ProductMNG_sy

First Symfony project

# Système de Gestion de Produits

Ce projet est un Système de Gestion de Produits construit avec Symfony 6. Il permet aux utilisateurs authentifiés d'ajouter de nouveaux produits et de visualiser une liste de tous les produits. Le système offre maintenant une authentification locale ainsi qu'une authentification via GitHub.

## Fonctionnalités

- Authentification utilisateur :
  - Inscription locale avec email et mot de passe
  - Connexion locale
  - Inscription et connexion via GitHub
  - Déconnexion
- Gestion des produits :
  - Ajout de nouveaux produits
  - Liste de tous les produits
- Persistance des données :
  - Base de données MySQL pour les utilisateurs et les produits
  - Sauvegarde supplémentaire des produits dans un fichier JSON

## Nouvelles Fonctionnalités

- Intégration de l'authentification GitHub
- Style cohérent pour les pages de connexion et d'inscription
- Barre de navigation pour une navigation facile entre les pages

## Structure du Projet

```
productMng/
├── config/
│   └── packages/
│       ├── security.yaml
│       └── knpu_oauth2_client.yaml
├── public/
├── src/
│   ├── Controller/
│   │   ├── ProductController.php
│   │   ├── RegistrationController.php
│   │   ├── SecurityController.php
│   │   └── GitHubController.php
│   ├── Entity/
│   │   ├── Product.php
│   │   └── User.php
│   ├── Form/
│   │   ├── ProductType.php
│   │   └── RegistrationFormType.php
│   ├── Repository/
│   │   ├── ProductRepository.php
│   │   └── UserRepository.php
│   ├── Security/
│   │   ├── AppCustomAuthenticator.php
│   │   └── GitHubAuthenticator.php
│   └── Service/
│       └── JsonProductPersister.php
├── templates/
│   ├── product/
│   │   ├── index.html.twig
│   │   └── new.html.twig
│   ├── registration/
│   │   └── register.html.twig
│   ├── security/
│   │   └── login.html.twig
│   ├── base.html.twig
│   └── partials/
│       └── _navbar.html.twig
└── var/
    └── products.json
```

## Composants Clés

1. **Entités** :

   - `Product.php` : Représente un produit avec ses propriétés.
   - `User.php` : Représente un utilisateur du système, incluant maintenant un champ pour l'ID GitHub.

2. **Contrôleurs** :

   - `ProductController.php` : Gère l'ajout et la liste des produits.
   - `RegistrationController.php` : Gère l'inscription des utilisateurs.
   - `SecurityController.php` : Gère la connexion et la déconnexion locales.
   - `GitHubController.php` : Gère le processus de connexion via GitHub.

3. **Formulaires** :

   - `ProductType.php` : Formulaire pour ajouter/éditer un produit.
   - `RegistrationFormType.php` : Formulaire d'inscription locale.

4. **Services** :

   - `JsonProductPersister.php` : Sauvegarde les produits dans un fichier JSON.

5. **Sécurité** :

   - `AppCustomAuthenticator.php` : Gère le processus d'authentification locale.
   - `GitHubAuthenticator.php` : Gère le processus d'authentification via GitHub.

6. **Templates** :
   - Templates Twig pour le rendu des pages produits, connexion, inscription, et la barre de navigation.

## Configuration et Exécution du Projet

1. Clonez le dépôt.
2. Installez les dépendances : `composer install`
3. Configurez votre base de données dans le fichier `.env`.
4. Configurez vos clés GitHub OAuth dans le fichier `.env` :
   ```
   GITHUB_CLIENT_ID=votre_client_id
   GITHUB_CLIENT_SECRET=votre_client_secret
   ```
5. Créez la base de données : `php bin/console doctrine:database:create`
6. Appliquez les migrations : `php bin/console doctrine:migrations:migrate`
7. Démarrez le serveur : `php -S localhost:8000 -t public`
8. Accédez à `http://localhost:8000` dans votre navigateur.

## Utilisation

1. Inscrivez-vous en utilisant l'inscription locale ou via GitHub.
2. Connectez-vous au système.
3. Utilisez la barre de navigation pour accéder à la liste des produits ou pour ajouter un nouveau produit.
4. Pour ajouter un produit, remplissez le formulaire sur la page "Ajouter un Produit".
5. Visualisez tous les produits sur la page "Liste des Produits".

## Améliorations Futures

- Implémentation de la modification et de la suppression des produits.
- Ajout de pagination à la liste des produits.
- Amélioration de la validation des données.
- Ajout de tests unitaires et fonctionnels.
- Implémentation d'un système de recherche de produits.
- Ajout de rôles utilisateurs (ex: administrateur, éditeur).
- Intégration d'autres fournisseurs d'authentification OAuth (ex: Google, Facebook).

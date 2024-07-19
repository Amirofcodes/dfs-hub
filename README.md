# ProductMNG_sy

First Symfony project

# Système de Gestion de Produits

Ce projet est un Système de Gestion de Produits construit avec Symfony 6. Il permet aux utilisateurs authentifiés d'ajouter de nouveaux produits et de visualiser une liste de tous les produits. Le système offre une authentification locale ainsi qu'une authentification via GitHub.

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
- Profil utilisateur :
  - Page de profil affichant les informations de l'utilisateur
  - Fonctionnalité d'upload et d'affichage de photo de profil

## Nouvelles Fonctionnalités

- Intégration de l'authentification GitHub
- Style cohérent pour les pages de connexion et d'inscription
- Barre de navigation adaptative pour une navigation facile entre les pages
- Page d'accueil adaptative qui change en fonction de l'état de connexion de l'utilisateur
- Ajout et affichage de photo de profil pour les utilisateurs

## Structure du Projet

```
productMng/
├── config/
│   └── packages/
│       ├── security.yaml
│       └── knpu_oauth2_client.yaml
├── public/
│   └── uploads/
│       └── profile_pictures/
├── src/
│   ├── Controller/
│   │   ├── ProductController.php
│   │   ├── RegistrationController.php
│   │   ├── SecurityController.php
│   │   ├── GitHubController.php
│   │   ├── HomeController.php
│   │   └── UserController.php
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
│   ├── user/
│   │   └── index.html.twig
│   ├── home/
│   │   └── index.html.twig
│   ├── base.html.twig
│   └── partials/
│       └── _navbar.html.twig
└── var/
    └── products.json
```

## Composants Clés

1. **Entités** :

   - `Product.php` : Représente un produit avec ses propriétés.
   - `User.php` : Représente un utilisateur du système, incluant des champs pour l'ID GitHub et la photo de profil.

2. **Contrôleurs** :

   - `ProductController.php` : Gère l'ajout et la liste des produits.
   - `RegistrationController.php` : Gère l'inscription des utilisateurs.
   - `SecurityController.php` : Gère la connexion et la déconnexion locales.
   - `GitHubController.php` : Gère le processus de connexion via GitHub.
   - `HomeController.php` : Gère l'affichage de la page d'accueil.
   - `UserController.php` : Gère l'affichage et la mise à jour du profil utilisateur, y compris l'upload de photo de profil.

3. **Formulaires** :

   - `ProductType.php` : Formulaire pour ajouter/éditer un produit.
   - `RegistrationFormType.php` : Formulaire d'inscription locale.

4. **Services** :

   - `JsonProductPersister.php` : Sauvegarde les produits dans un fichier JSON.

5. **Sécurité** :

   - `AppCustomAuthenticator.php` : Gère le processus d'authentification locale.
   - `GitHubAuthenticator.php` : Gère le processus d'authentification via GitHub.

6. **Templates** :
   - Templates Twig pour le rendu des pages produits, connexion, inscription, accueil, profil utilisateur et la barre de navigation.

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
7. Assurez-vous que le dossier `public/uploads/profile_pictures` existe et a les permissions appropriées.
8. Démarrez le serveur : `symfony server:start`
9. Accédez à `http://localhost:8000` dans votre navigateur.

## Utilisation

1. Visitez la page d'accueil pour voir une description du projet.
2. Inscrivez-vous en utilisant l'inscription locale ou via GitHub.
3. Connectez-vous au système.
4. Utilisez la barre de navigation pour accéder à la liste des produits, ajouter un nouveau produit, ou voir votre profil utilisateur.
5. Pour ajouter un produit, remplissez le formulaire sur la page "Ajouter un Produit".
6. Visualisez tous les produits sur la page "Liste des Produits".
7. Consultez et mettez à jour vos informations utilisateur sur la page "Profil Utilisateur", y compris l'ajout d'une photo de profil.

## Améliorations Futures

- Implémentation de la modification et de la suppression des produits.
- Ajout de pagination à la liste des produits.
- Amélioration de la validation des données.
- Ajout de tests unitaires et fonctionnels.
- Implémentation d'un système de recherche de produits.
- Ajout de rôles utilisateurs (ex: administrateur, éditeur).
- Intégration d'autres fournisseurs d'authentification OAuth (ex: Google, Facebook).
- Amélioration de la gestion des photos de profil (redimensionnement, recadrage, etc.).

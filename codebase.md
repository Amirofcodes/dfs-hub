# composer.json

```json
{
    "name": "it-akademy/dfs-hub",
    "description": "A comprehensive learning platform for IT-Akademy students focusing on the DFS curriculum and RNCP certification",
    "type": "project",
    "license": "proprietary",
    "minimum-stability": "stable",
    "prefer-stable": true,
    "require": {
        "php": ">=8.1",
        "ext-ctype": "*",
        "ext-iconv": "*",
        "doctrine/dbal": "^3",
        "doctrine/doctrine-bundle": "^2.12",
        "doctrine/doctrine-migrations-bundle": "^3.3",
        "doctrine/orm": "^3.2",
        "knpuniversity/oauth2-client-bundle": "^2.18",
        "league/oauth2-github": "^3.1",
        "symfony/asset": "6.3.*",
        "symfony/console": "6.3.*",
        "symfony/dotenv": "6.3.*",
        "symfony/flex": "^2",
        "symfony/form": "6.3.*",
        "symfony/framework-bundle": "6.3.*",
        "symfony/mime": "6.3.*",
        "symfony/runtime": "6.3.*",
        "symfony/security-bundle": "6.3.*",
        "symfony/twig-bundle": "6.3.*",
        "symfony/validator": "6.3.*",
        "symfony/yaml": "6.3.*",
        "twig/extra-bundle": "^2.12|^3.0",
        "twig/twig": "^2.12|^3.0"
    },
    "config": {
        "allow-plugins": {
            "php-http/discovery": true,
            "symfony/flex": true,
            "symfony/runtime": true
        },
        "sort-packages": true
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "App\\Tests\\": "tests/"
        }
    },
    "replace": {
        "symfony/polyfill-ctype": "*",
        "symfony/polyfill-iconv": "*",
        "symfony/polyfill-php72": "*",
        "symfony/polyfill-php73": "*",
        "symfony/polyfill-php74": "*",
        "symfony/polyfill-php80": "*",
        "symfony/polyfill-php81": "*"
    },
    "scripts": {
        "auto-scripts": {
            "cache:clear": "symfony-cmd",
            "assets:install %PUBLIC_DIR%": "symfony-cmd"
        },
        "post-install-cmd": [
            "@auto-scripts"
        ],
        "post-update-cmd": [
            "@auto-scripts"
        ]
    },
    "conflict": {
        "symfony/symfony": "*"
    },
    "extra": {
        "symfony": {
            "allow-contrib": false,
            "require": "6.3.*"
        }
    },
    "require-dev": {
        "symfony/maker-bundle": "^1.53"
    }
}

```

# compose.yaml

```yaml
version: '3'

services:
###> doctrine/doctrine-bundle ###
  database:
    image: postgres:${POSTGRES_VERSION:-16}-alpine
    environment:
      POSTGRES_DB: ${POSTGRES_DB:-app}
      # You should definitely change the password in production
      POSTGRES_PASSWORD: ${POSTGRES_PASSWORD:-!ChangeMe!}
      POSTGRES_USER: ${POSTGRES_USER:-app}
    volumes:
      - database_data:/var/lib/postgresql/data:rw
      # You may use a bind-mounted host directory instead, so that it is harder to accidentally remove the volume and lose all your data!
      # - ./docker/db/data:/var/lib/postgresql/data:rw
###< doctrine/doctrine-bundle ###

volumes:
###> doctrine/doctrine-bundle ###
  database_data:
###< doctrine/doctrine-bundle ###

```

# compose.override.yaml

```yaml
version: '3'

services:
###> doctrine/doctrine-bundle ###
  database:
    ports:
      - "5432"
###< doctrine/doctrine-bundle ###

```

# README.md

```md
# DFS HUB

DFS HUB is a comprehensive learning platform designed for IT-Akademy students, focusing on the Développeur Full Stack (DFS) curriculum and RNCP certification resources. This project is developed as part of the RNCP certification process.

## Project Overview

DFS HUB aims to provide a centralized platform for DFS students to access learning resources, track their progress, and prepare for RNCP certification. The platform is built with a focus on modern web development practices and technologies.

## Key Features

- User Authentication (Local and GitHub OAuth)
- User Profiles with Learning Activity Tracking
- Learning Resource Management (Courses, Tutorials, Articles)
- RNCP Certification Information and Resources
- Personalized Learning Paths
- Q&A Section
- Real-time Collaboration
- Admin Panel for User Management

## Technologies Used

- **Backend Framework**: Symfony 6.2
- **Database**: MySQL
- **ORM**: Doctrine
- **Frontend**: Twig templating engine, JavaScript
- **Authentication**: Symfony Security, KnpU OAuth2 Client Bundle
- **API**: RESTful API with Symfony
- **Real-time Features**: WebSockets (planned)
- **Search**: Elasticsearch (planned)
- **Caching**: Redis (planned)
- **Testing**: PHPUnit

## Technical Details

### Backend Architecture

- MVC architecture using Symfony's best practices
- Doctrine ORM for database interactions
- Custom services for business logic
- Event listeners for specific application events

### Security Measures

- Symfony Security for authentication and authorization
- CSRF protection
- Password hashing using bcrypt
- OAuth2 integration for GitHub login
- Role-based access control (ROLE_ADMIN, ROLE_MENTOR, ROLE_STUDENT)

### Database Design

- Relational database schema optimized for learning resource management
- Entities: User, Course, Lesson, Question, Answer, UserProgress, UserActivity

### API Design

- RESTful API endpoints for resource management
- JWT authentication for API access

### Performance Optimizations

- Doctrine query optimization
- Lazy loading of related entities
- Caching strategies (to be implemented)

### Testing Strategy

- Unit tests for critical business logic
- Functional tests for controllers and API endpoints
- Integration tests for database interactions

## Recent Updates

- Implemented an admin panel for user management
- Enhanced user roles system (ROLE_ADMIN, ROLE_MENTOR, ROLE_STUDENT)
- Added user activity tracking
- Improved security configuration and access control
- Created a dashboard for user profile and activity display

## RNCP Certification Relevance

This project demonstrates competencies in:

1. Designing and modeling web applications
2. Developing the frontend and backend of web applications
3. Implementing database design and management
4. Ensuring application security
5. Integrating third-party services (OAuth)
6. Applying best practices in software development
7. Implementing user role management and access control

By developing DFS HUB, we aim to showcase skills as Full Stack Developers and meet the requirements for RNCP certification.

```

# .gitignore

```
# Ignore directories generated by Composer
/vendor/
/node_modules/

# Ignore directories generated by Symfony
/var/
/public/bundles/
/public/uploads/

# Ignore cache, logs, and sessions
/var/cache/
/var/log/
/var/sessions/

# Ignore environment-specific files
/.env
/.env.local
/.env.*.local

# Ignore database and local configuration files
/var/data/
/config/jwt/
/config/secrets/prod/
/config/secrets/dev/
/config/secrets/test/

# Ignore IDE specific files
/.idea/
/.vscode/
/*.swp

# Ignore OS generated files
.DS_Store
Thumbs.db

# Ignore autogenerated files
/public/build/
/public/js/
/public/css/
/public/images/

# Ignore PHPUnit result logs
/phpunit.result.cache
/coverage/

# Ignore Symfony profiler results
/profiler/

# Ignore Composer lock file (if you prefer)
/composer.lock

# Ignore auto-generated files from Symfony
/src/Kernel.php

# Ignore migrations auto-generated files
/migrations/*

# Ignore Symfony flex auto-generated recipes
/config/bootstrap.php

```

# .aidigestignore

```
# Symfony specific
/var/
/vendor/
/public/bundles/
/public/uploads/
/var/cache/*
/var/log/*
/var/sessions/*

# Configuration and environment files
/.env
/.env.local
/.env.local.php
/.env.*.local

# Composer files
/composer.phar
/composer.lock
/symfony.lock

# PHPUnit
/phpunit.xml
/.phpunit.result.cache

# Build and deploy related
/build/
/deploy/

# Frontend related
/node_modules/
/public/build/
/npm-debug.log
/yarn-error.log

# IDE and editor files
/.idea/
/.vscode/
*.sublime-project
*.sublime-workspace
*.komodoproject
.komodotools/
.project
.buildpath
.settings/

# OS generated files
.DS_Store
.DS_Store?
._*
.Spotlight-V100
.Trashes
ehthumbs.db
Thumbs.db

# Backup files
*~
*.bak
*.swp

# Other common ignore patterns
*.log
*.sql
*.sqlite
*.tmp
*.temp

# Symfony specific files that might contain sensitive information
/config/secrets/prod/prod.decrypt.private.php

# Custom application files (adjust as needed)
/public/uploads/profile_pictures/
```

# templates/base.html.twig

```twig
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}{% endblock %}
    </head>
    <body>
        {% if app.user %}
            {% include 'partials/_navbar.html.twig' %}
        {% endif %}
        {% block body %}{% endblock %}
        {% block javascripts %}{% endblock %}
    </body>
</html>
```

# src/Kernel.php

```php
<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}

```

# public/index.php

```php
<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

```

# migrations/Version20240719000000.php

```php
<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240719000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add profile_picture to User entity if not exists';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            SET @dbname = DATABASE();
            SET @tablename = "user";
            SET @columnname = "profile_picture";
            SET @preparedStatement = (SELECT IF(
              (
                SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
                WHERE
                  TABLE_SCHEMA = @dbname
                  AND TABLE_NAME = @tablename
                  AND COLUMN_NAME = @columnname
              ) > 0,
              "SELECT 1",
              CONCAT("ALTER TABLE ", @tablename, " ADD ", @columnname, " VARCHAR(255) DEFAULT NULL")
            ));
            PREPARE alterIfNotExists FROM @preparedStatement;
            EXECUTE alterIfNotExists;
            DEALLOCATE PREPARE alterIfNotExists;
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP profile_picture');
    }
}

```

# migrations/Version20240717083724.php

```php
<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240717083724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add githubId to User entity if not exists';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            SET @dbname = DATABASE();
            SET @tablename = "user";
            SET @columnname = "github_id";
            SET @preparedStatement = (SELECT IF(
              (
                SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
                WHERE
                  TABLE_SCHEMA = @dbname
                  AND TABLE_NAME = @tablename
                  AND COLUMN_NAME = @columnname
              ) > 0,
              "SELECT 1",
              CONCAT("ALTER TABLE ", @tablename, " ADD ", @columnname, " VARCHAR(255) DEFAULT NULL")
            ));
            PREPARE alterIfNotExists FROM @preparedStatement;
            EXECUTE alterIfNotExists;
            DEALLOCATE PREPARE alterIfNotExists;
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP github_id');
    }
}

```

# migrations/.gitignore

```

```

# config/services.yaml

```yaml
# This file is the entry point to configure your own services.
# Files in the packages/ subdirectory configure your dependencies.

# Put parameters here that don't need to change on each machine where the app is deployed
# https://symfony.com/doc/current/best_practices.html#use-parameters-for-application-configuration
parameters:
  profile_pictures_directory: "%kernel.project_dir%/public/uploads/profile_pictures"

services:
  # default configuration for services in *this* file
  _defaults:
    autowire: true # Automatically injects dependencies in your services.
    autoconfigure: true # Automatically registers your services as commands, event subscribers, etc.

  # makes classes in src/ available to be used as services
  # this creates a service per class whose id is the fully-qualified class name
  App\:
    resource: "../src/"
    exclude:
      - "../src/DependencyInjection/"
      - "../src/Entity/"
      - "../src/Kernel.php"

  # add more service definitions when explicit configuration is needed
  # please note that last definitions always *replace* previous ones
  App\Service\JsonProductPersister:
    arguments:
      $projectDir: "%kernel.project_dir%"
  App\Security\GitHubAuthenticator:
    arguments:
      $clientRegistry: "@knpu.oauth2.registry"
      $entityManager: "@doctrine.orm.entity_manager"
      $router: "@router"
      $passwordHasher: "@security.user_password_hasher"

```

# config/routes.yaml

```yaml
controllers:
    resource:
        path: ../src/Controller/
        namespace: App\Controller
    type: attribute

```

# config/preload.php

```php
<?php

if (file_exists(dirname(__DIR__).'/var/cache/prod/App_KernelProdContainer.preload.php')) {
    require dirname(__DIR__).'/var/cache/prod/App_KernelProdContainer.preload.php';
}

```

# config/bundles.php

```php
<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Twig\Extra\TwigExtraBundle\TwigExtraBundle::class => ['all' => true],
    Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
    Symfony\Bundle\MakerBundle\MakerBundle::class => ['dev' => true],
    KnpU\OAuth2ClientBundle\KnpUOAuth2ClientBundle::class => ['all' => true],
];

```

# templates/user/index.html.twig

```twig
{% extends 'base.html.twig' %}

{% block title %}User Profile{% endblock %}

{% block stylesheets %}
{{ parent() }}
<style>
    .user-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .user-info {
        margin-bottom: 20px;
    }
    .user-info p {
        margin: 10px 0;
    }
    .profile-picture {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 20px;
    }
</style>
{% endblock %}

{% block body %}
<div class="user-container">
    <h1>User Profile</h1>
    
    {% for message in app.flashes('success') %}
        <div class="alert alert-success">
            {{ message }}
        </div>
    {% endfor %}

    {% if user.profilePicture %}
        <img src="{{ asset('uploads/profile_pictures/' ~ user.profilePicture) }}" alt="Profile Picture" class="profile-picture">
    {% else %}
        <p>No profile picture uploaded yet.</p>
    {% endif %}

    <div class="user-info">
        {{ form_start(form) }}
        {{ form_row(form.email) }}
        {% if user.githubId %}
            <p><strong>GitHub ID:</strong> {{ user.githubId }}</p>
        {% endif %}
        {{ form_row(form.submit) }}
        {{ form_end(form) }}
    </div>

    <h2>Upload Profile Picture</h2>
    <form action="{{ path('app_user_upload_profile_picture') }}" method="post" enctype="multipart/form-data">
        <input type="file" name="profile_picture" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>

    <h2>Recent Activities</h2>
    {% if activities|length > 0 %}
        <ul>
        {% for activity in activities %}
            <li>
                <strong>{{ activity.activityType }}</strong>: 
                {{ activity.description }} 
                <small>({{ activity.createdAt|date('Y-m-d H:i:s') }})</small>
            </li>
        {% endfor %}
        </ul>
    {% else %}
        <p>No recent activities.</p>
    {% endif %}
</div>
{% endblock %}
```

# templates/security/login.html.twig

```twig
{% extends 'base.html.twig' %}

{% block title %}Log in{% endblock %}

{% block stylesheets %}
{{ parent() }}
<style>
    .login-container {
        max-width: 400px;
        margin: 50px auto;
        text-align: center;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-control {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .btn {
        background-color: #87CEEB;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    .btn:hover {
        background-color: #5F9EA0;
    }
    .alert {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid transparent;
        border-radius: 4px;
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
</style>
{% endblock %}

{% block body %}
<div class="login-container">
    <form method="post">
        {% if error %}
            <div class="alert">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
        {% endif %}

        {% if app.user %}
            <div class="mb-3">
                You are logged in as {{ app.user.userIdentifier }}, <a href="{{ path('app_logout') }}">Logout</a>
            </div>
        {% endif %}

        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" value="{{ last_username }}" name="email" id="inputEmail" class="form-control" autocomplete="email" required autofocus>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" autocomplete="current-password" required>
        </div>

        <input type="hidden" name="_csrf_token" value="{{ csrf_token('authenticate') }}">

        <button class="btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>

    <div style="margin-top: 20px;">
        <p>Or sign in with:</p>
        <a href="{{ path('connect_github_start') }}" class="btn">
            Sign in with GitHub
        </a>
    </div>
</div>
{% endblock %}
```

# templates/registration/register.html.twig

```twig
{% extends 'base.html.twig' %}

{% block title %}Register{% endblock %}

{% block stylesheets %}
{{ parent() }}
<style>
    .register-container {
        max-width: 400px;
        margin: 50px auto;
        text-align: center;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-control {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .btn {
        background-color: #87CEEB;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: #5F9EA0;
    }
    .github-button {
        background-color: #24292e;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
    }
    .github-button:hover {
        background-color: #2c3238;
    }
</style>
{% endblock %}

{% block body %}
<div class="register-container">
    <h1>Register</h1>

    {{ form_start(registrationForm) }}
        <div class="form-group">
            {{ form_row(registrationForm.email, {'attr': {'class': 'form-control'}}) }}
        </div>
        <div class="form-group">
            {{ form_row(registrationForm.plainPassword, {
                'label': 'Password',
                'attr': {'class': 'form-control'}
            }) }}
        </div>
        <div class="form-group">
            {{ form_row(registrationForm.agreeTerms) }}
        </div>

        <button type="submit" class="btn">Register</button>
    {{ form_end(registrationForm) }}

    <div style="margin-top: 20px;">
        <p>Or register with:</p>
        <a href="{{ path('connect_github_start') }}" class="github-button">
            Register with GitHub
        </a>
    </div>
</div>
{% endblock %}
```

# templates/product/new.html.twig

```twig
{% extends 'base.html.twig' %}

{% block title %}Add New Product{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #87CEEB;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #5F9EA0;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
    </style>
{% endblock %}

{% block body %}
    <h1>Add New Product</h1>

    {% for message in app.flashes('success') %}
        <div class="alert-success">
            {{ message }}
        </div>
    {% endfor %}

    {{ form_start(form) }}
        {{ form_row(form.designation, {'label': 'Designation:'}) }}
        {{ form_row(form.univers, {'label': 'Universe:'}) }}
        {{ form_row(form.price, {'label': 'Price:'}) }}
        <button type="submit">Add Product</button>
    {{ form_end(form) }}
{% endblock %}
```

# templates/product/index.html.twig

```twig
{% extends 'base.html.twig' %}

{% block title %}Product List{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #87CEEB;
            color: white;
        }
        .add-button {
            background-color: #87CEEB;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .add-button:hover {
            background-color: #5F9EA0;
        }
    </style>
{% endblock %}

{% block body %}
    <h1>Product List</h1>

    <a href="{{ path('product_new') }}" class="add-button">Add New Product</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Designation</th>
                <th>Universe</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
        {% for product in products %}
            <tr>
                <td>{{ product.id }}</td>
                <td>{{ product.designation }}</td>
                <td>{{ product.univers }}</td>
                <td>{{ product.price }}</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% endblock %}
```

# templates/partials/_navbar.html.twig

```twig
<nav style="background-color: #87CEEB; padding: 10px; text-align: center;">
    <a href="{{ path('app_home') }}" style="color: white; text-decoration: none; margin-right: 15px;">Home</a>
    {% if app.user %}
        <a href="{{ path('product_index') }}" style="color: white; text-decoration: none; margin-right: 15px;">Products</a>
        <a href="{{ path('product_new') }}" style="color: white; text-decoration: none; margin-right: 15px;">Add Product</a>
        <a href="{{ path('app_user') }}" style="color: white; text-decoration: none; margin-right: 15px;">User Profile</a>
        {% if is_granted('ROLE_ADMIN') %}
            <a href="{{ path('app_admin_index') }}" style="color: white; text-decoration: none; margin-right: 15px;">Admin Panel</a>
        {% endif %}
        <a href="{{ path('app_logout') }}" style="color: white; text-decoration: none;">Logout</a>
    {% else %}
        <a href="{{ path('app_login') }}" style="color: white; text-decoration: none; margin-right: 15px;">Login</a>
        <a href="{{ path('app_register') }}" style="color: white; text-decoration: none;">Register</a>
    {% endif %}
</nav>
```

# templates/home/index.html.twig

```twig
{% extends 'base.html.twig' %}

{% block title %}Welcome to DFS HUB{% endblock %}

{% block stylesheets %}
{{ parent() }}
<style>
    .home-container {
        text-align: center;
        max-width: 800px;
        margin: 50px auto;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 10px;
        background-color: #87CEEB;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
    .btn:hover {
        background-color: #5F9EA0;
    }
    .feature-list {
        text-align: left;
        display: inline-block;
    }
</style>
{% endblock %}

{% block body %}
<div class="home-container">
    <h1>Welcome to DFS HUB</h1>
    <p>
        DFS HUB is a comprehensive learning platform designed for IT-Akademy students, 
        focusing on the Développeur Full Stack (DFS) curriculum and RNCP certification resources.
    </p>
    <h2>Key Features:</h2>
    <ul class="feature-list">
        <li>User Authentication (Local and GitHub OAuth)</li>
        <li>User Profiles with Learning Activity Tracking</li>
        <li>Learning Resource Management</li>
        <li>RNCP Certification Information and Resources</li>
        <li>Admin Panel for User Management</li>
        <li>Role-based Access Control</li>
    </ul>
    {% if not app.user %}
        <div>
            <a href="{{ path('app_register') }}" class="btn">Register</a>
            <a href="{{ path('app_login') }}" class="btn">Login</a>
        </div>
    {% else %}
        <p>Welcome back, {{ app.user.email }}!</p>
        <a href="{{ path('app_user') }}" class="btn">My Profile</a>
    {% endif %}
</div>
{% endblock %}
```

# templates/admin/index.html.twig

```twig
{% extends 'base.html.twig' %}

{% block title %}Admin Panel{% endblock %}

{% block body %}
    <h1>Admin Panel</h1>

    <h2>User Management</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        {% for user in users %}
            <tr>
                <td>{{ user.email }}</td>
                <td>{{ user.roles ? user.roles|json_encode : '' }}</td>
                <td>
                    <a href="{{ path('app_admin_user_edit', {'id': user.id}) }}">Edit</a>
                </td>
            </tr>
        {% else %}
            <tr>
                <td colspan="3">No users found</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% endblock %}
```

# templates/admin/edit_user.html.twig

```twig
{% extends 'base.html.twig' %}

{% block title %}Edit User Roles{% endblock %}

{% block body %}
    <h1>Edit User Roles</h1>

    <h2>{{ user.email }}</h2>

    {{ form_start(form) }}
        {{ form_row(form.roles) }}
        <button type="submit" class="btn btn-primary">Save</button>
    {{ form_end(form) }}

    <a href="{{ path('app_admin_index') }}">Back to list</a>
{% endblock %}
```

# src/Service/JsonProductPersister.php

```php
<?php

namespace App\Service;

use App\Entity\Product;

class JsonProductPersister
{
    private string $filePath;

    public function __construct(string $projectDir)
    {
        $this->filePath = $projectDir . '/var/products.json';
    }

    public function save(Product $product): void
    {
        $data = [
            'id' => $product->getId(),
            'designation' => $product->getDesignation(),
            'univers' => $product->getUnivers(),
            'price' => $product->getPrice()
        ];

        $existingData = file_exists($this->filePath) ? json_decode(file_get_contents($this->filePath), true) : [];
        $existingData[] = $data;

        file_put_contents($this->filePath, json_encode($existingData, JSON_PRETTY_PRINT));
    }
}

```

# src/Security/GitHubAuthenticator.php

```php
<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use League\OAuth2\Client\Provider\GithubResourceOwner;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class GitHubAuthenticator extends OAuth2Authenticator implements AuthenticationEntryPointInterface
{
    private ClientRegistry $clientRegistry;
    private EntityManagerInterface $entityManager;
    private RouterInterface $router;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(
        ClientRegistry $clientRegistry,
        EntityManagerInterface $entityManager,
        RouterInterface $router,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->clientRegistry = $clientRegistry;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->passwordHasher = $passwordHasher;
    }

    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'connect_github_check';
    }

    public function authenticate(Request $request): Passport
    {
        $client = $this->clientRegistry->getClient('github');
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge($accessToken->getToken(), function () use ($accessToken, $client) {
                /** @var GithubResourceOwner $githubUser */
                $githubUser = $client->fetchUserFromToken($accessToken);

                $email = $githubUser->getEmail();

                // 1) have they logged in with GitHub before? Easy!
                $existingUser = $this->entityManager->getRepository(User::class)->findOneBy(['githubId' => $githubUser->getId()]);

                if ($existingUser) {
                    return $existingUser;
                }

                // 2) do we have a matching user by email?
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

                // 3) Maybe you just want to "register" them by creating
                // a User object
                if (!$user) {
                    $user = new User();
                    $user->setEmail($email);
                    $user->setGithubId($githubUser->getId());

                    // Set a random password for the user
                    $randomPassword = bin2hex(random_bytes(16));
                    $hashedPassword = $this->passwordHasher->hashPassword($user, $randomPassword);
                    $user->setPassword($hashedPassword);

                    $this->entityManager->persist($user);
                    $this->entityManager->flush();
                }

                return $user;
            })
        );
    }

    // ... rest of the class remains the same


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // change "app_homepage" to some route in your app
        $targetUrl = $this->router->generate('product_index');

        return new RedirectResponse($targetUrl);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent.
     * This redirects to the 'login'.
     */
    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        return new RedirectResponse(
            '/connect/github', // might be the site, where users choose their oauth provider
            Response::HTTP_TEMPORARY_REDIRECT
        );
    }
}

```

# src/Security/AppCustomAuthenticator.php

```php
<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class AppCustomAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email', '');
        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Redirect to the product list page after successful login
        return new RedirectResponse($this->urlGenerator->generate('product_index'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}

```

# src/Repository/UserRepository.php

```php
<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @implements PasswordUpgraderInterface<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

```

# src/Repository/UserActivityRepository.php

```php
<?php

namespace App\Repository;

use App\Entity\UserActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserActivity>
 *
 * @method UserActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserActivity[]    findAll()
 * @method UserActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserActivity::class);
    }

    public function save(UserActivity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserActivity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}

```

# src/Repository/ProductRepository.php

```php
<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // Add custom query methods if needed
}

```

# src/Repository/.gitignore

```

```

# src/Form/UserType.php

```php
<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('submit', SubmitType::class, ['label' => 'Update Profile']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

```

# src/Form/UserRoleType.php

```php
<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Student' => 'ROLE_STUDENT',
                    'Mentor' => 'ROLE_MENTOR',
                    'Admin' => 'ROLE_ADMIN',
                ],
                'expanded' => true,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

```

# src/Form/RegistrationFormType.php

```php
<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

```

# src/Form/ProductType.php

```php
<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation', TextType::class)
            ->add('univers', TextType::class)
            ->add('price', IntegerType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

```

# src/Entity/UserActivity.php

```php
<?php

namespace App\Entity;

use App\Repository\UserActivityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserActivityRepository::class)]
class UserActivity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'activities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $activityType = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getActivityType(): ?string
    {
        return $this->activityType;
    }

    public function setActivityType(string $activityType): self
    {
        $this->activityType = $activityType;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}

```

# src/Entity/User.php

```php
<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $githubId = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $profilePicture = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserActivity::class, orphanRemoval: true)]
    private Collection $activities;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
        $this->roles = ['ROLE_STUDENT']; // Default role
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_STUDENT
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getGithubId(): ?string
    {
        return $this->githubId;
    }

    public function setGithubId(?string $githubId): self
    {
        $this->githubId = $githubId;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function addRole(string $role): self
    {
        if (!in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(string $role): self
    {
        $this->roles = array_diff($this->roles, [$role]);

        return $this;
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->roles);
    }

    /**
     * @return Collection<int, UserActivity>
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(UserActivity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities->add($activity);
            $activity->setUser($this);
        }

        return $this;
    }

    public function removeActivity(UserActivity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getUser() === $this) {
                $activity->setUser(null);
            }
        }

        return $this;
    }
}

```

# src/Entity/Product.php

```php
<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $designation;

    #[ORM\Column(type: 'string', length: 255)]
    private string $univers;

    #[ORM\Column(type: 'integer')]
    private int $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;
        return $this;
    }

    public function getUnivers(): string
    {
        return $this->univers;
    }

    public function setUnivers(string $univers): self
    {
        $this->univers = $univers;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;
        return $this;
    }
}

```

# src/Entity/.gitignore

```

```

# src/Controller/UserController.php

```php
<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserActivity;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/user')]
#[IsGranted('ROLE_USER')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw new AccessDeniedException('You need to be logged in to access this page.');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Your profile has been updated.');

            return $this->redirectToRoute('app_user');
        }

        $activities = $entityManager->getRepository(UserActivity::class)->findBy(
            ['user' => $user],
            ['createdAt' => 'DESC'],
            10
        );

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'activities' => $activities,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/upload-profile-picture', name: 'app_user_upload_profile_picture', methods: ['POST'])]
    public function uploadProfilePicture(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw new AccessDeniedException('You need to be logged in to upload a profile picture.');
        }

        $profilePicture = $request->files->get('profile_picture');

        if ($profilePicture) {
            $originalFilename = pathinfo($profilePicture->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $profilePicture->guessExtension();

            try {
                $profilePicture->move(
                    $this->getParameter('profile_pictures_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // Handle exception if something happens during file upload
                $this->addFlash('error', 'An error occurred while uploading your profile picture.');
                return $this->redirectToRoute('app_user');
            }

            $user->setProfilePicture($newFilename);
            $entityManager->flush();

            $this->addFlash('success', 'Profile picture uploaded successfully!');
        }

        return $this->redirectToRoute('app_user');
    }
}

```

# src/Controller/SecurityController.php

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // If the user is already logged in, redirect to the product page
        if ($this->getUser()) {
            return $this->redirectToRoute('product_index');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

```

# src/Controller/RegistrationController.php

```php
<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            // Redirect to login page after successful registration
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}

```

# src/Controller/ProductController.php

```php
<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Service\JsonProductPersister;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/product', name: 'product_')]
#[IsGranted('ROLE_USER')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $products = $entityManager->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, JsonProductPersister $jsonPersister): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($product);
            $entityManager->flush();

            $jsonPersister->save($product);

            $this->addFlash('success', 'Product added successfully!');

            return $this->redirectToRoute('product_new');
        }

        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

```

# src/Controller/HomeController.php

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
}

```

# src/Controller/GitHubController.php

```php
<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GitHubController extends AbstractController
{
    #[Route('/connect/github', name: 'connect_github_start')]
    public function connectAction(ClientRegistry $clientRegistry): RedirectResponse
    {
        return $clientRegistry
            ->getClient('github')
            ->redirect([
                'user:email', // the scopes you want to access
            ]);
    }

    #[Route('/connect/github/check', name: 'connect_github_check')]
    public function connectCheckAction(): Response
    {
        // This method will not be executed, as the authenticator will handle this
        return new Response('This should not be reached!');
    }
}

```

# src/Controller/AdminController.php

```php
<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRoleType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin_index')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/user/{id}/edit', name: 'app_admin_user_edit', methods: ['GET', 'POST'])]
    public function editUser(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserRoleType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'User roles updated successfully.');

            return $this->redirectToRoute('app_admin_index');
        }

        return $this->render('admin/edit_user.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}

```

# src/Controller/.gitignore

```

```

# config/routes/framework.yaml

```yaml
when@dev:
    _errors:
        resource: '@FrameworkBundle/Resources/config/routing/errors.xml'
        prefix: /_error

```

# config/packages/validator.yaml

```yaml
framework:
    validation:
        email_validation_mode: html5

        # Enables validator auto-mapping support.
        # For instance, basic validation constraints will be inferred from Doctrine's metadata.
        #auto_mapping:
        #    App\Entity\: []

when@test:
    framework:
        validation:
            not_compromised_password: false

```

# config/packages/twig.yaml

```yaml
twig:
    default_path: '%kernel.project_dir%/templates'

when@test:
    twig:
        strict_variables: true

```

# config/packages/security.yaml

```yaml
security:
  # Enable password hashers
  password_hashers:
    Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface: "auto"

  # https://symfony.com/doc/current/security.html#loading-the-user-the-user-provider
  providers:
    # used to reload user from session & other features (e.g. switch_user)
    app_user_provider:
      entity:
        class: App\Entity\User
        property: email

  firewalls:
    dev:
      pattern: ^/(_(profiler|wdt)|css|images|js)/
      security: false
    main:
      lazy: true
      provider: app_user_provider
      custom_authenticators:
        - App\Security\AppCustomAuthenticator
        - App\Security\GitHubAuthenticator
      entry_point: App\Security\AppCustomAuthenticator
      form_login:
        login_path: app_login
        check_path: app_login
        enable_csrf: true
        default_target_path: product_index
        username_parameter: email
        password_parameter: password
      logout:
        path: app_logout
        target: app_login

  # Easy way to control access for large sections of your site
  # Note: Only the *first* access control that matches will be used
  access_control:
    - { path: ^/admin, roles: ROLE_ADMIN }
    - { path: ^/user, roles: ROLE_USER }
    - { path: ^/login, roles: PUBLIC_ACCESS }
    - { path: ^/register, roles: PUBLIC_ACCESS }
    - { path: ^/connect/github, roles: PUBLIC_ACCESS }
    - { path: ^/$, roles: PUBLIC_ACCESS }
    - { path: ^/, roles: ROLE_USER }
  role_hierarchy:
    ROLE_ADMIN: [ROLE_USER]
    ROLE_STUDENT: [ROLE_USER]

when@test:
  security:
    password_hashers:
      # By default, password hashers are resource intensive and take time. This is
      # important to generate secure password hashes. In tests however, secure hashes
      # are not important, waste resources and increase test times. The following
      # reduces the work factor to the lowest possible values.
      Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface:
        algorithm: auto
        cost: 4 # Lowest possible value for bcrypt
        time_cost: 3 # Lowest possible value for argon
        memory_cost: 10 # Lowest possible value for argon

```

# config/packages/routing.yaml

```yaml
framework:
    router:
        utf8: true

        # Configure how to generate URLs in non-HTTP contexts, such as CLI commands.
        # See https://symfony.com/doc/current/routing.html#generating-urls-in-commands
        #default_uri: http://localhost

when@prod:
    framework:
        router:
            strict_requirements: null

```

# config/packages/knpu_oauth2_client.yaml

```yaml
knpu_oauth2_client:
  clients:
    github:
      type: github
      client_id: "%env(GITHUB_CLIENT_ID)%"
      client_secret: "%env(GITHUB_CLIENT_SECRET)%"
      redirect_route: connect_github_check
      redirect_params: {}

```

# config/packages/framework.yaml

```yaml
# see https://symfony.com/doc/current/reference/configuration/framework.html
framework:
    secret: '%env(APP_SECRET)%'
    #csrf_protection: true
    http_method_override: false
    handle_all_throwables: true

    # Enables session support. Note that the session will ONLY be started if you read or write from it.
    # Remove or comment this section to explicitly disable session support.
    session:
        handler_id: null
        cookie_secure: auto
        cookie_samesite: lax
        storage_factory_id: session.storage.factory.native

    #esi: true
    #fragments: true
    php_errors:
        log: true

when@test:
    framework:
        test: true
        session:
            storage_factory_id: session.storage.factory.mock_file

```

# config/packages/doctrine_migrations.yaml

```yaml
doctrine_migrations:
    migrations_paths:
        # namespace is arbitrary but should be different from App\Migrations
        # as migrations classes should NOT be autoloaded
        'DoctrineMigrations': '%kernel.project_dir%/migrations'
    enable_profiler: false

```

# config/packages/doctrine.yaml

```yaml
doctrine:
    dbal:
        url: '%env(resolve:DATABASE_URL)%'

        # IMPORTANT: You MUST configure your server version,
        # either here or in the DATABASE_URL env var (see .env file)
        #server_version: '16'

        profiling_collect_backtrace: '%kernel.debug%'
        use_savepoints: true
    orm:
        auto_generate_proxy_classes: true
        enable_lazy_ghost_objects: true
        report_fields_where_declared: true
        validate_xml_mapping: true
        naming_strategy: doctrine.orm.naming_strategy.underscore_number_aware
        auto_mapping: true
        mappings:
            App:
                type: attribute
                is_bundle: false
                dir: '%kernel.project_dir%/src/Entity'
                prefix: 'App\Entity'
                alias: App

when@test:
    doctrine:
        dbal:
            # "TEST_TOKEN" is typically set by ParaTest
            dbname_suffix: '_test%env(default::TEST_TOKEN)%'

when@prod:
    doctrine:
        orm:
            auto_generate_proxy_classes: false
            proxy_dir: '%kernel.build_dir%/doctrine/orm/Proxies'
            query_cache_driver:
                type: pool
                pool: doctrine.system_cache_pool
            result_cache_driver:
                type: pool
                pool: doctrine.result_cache_pool

    framework:
        cache:
            pools:
                doctrine.result_cache_pool:
                    adapter: cache.app
                doctrine.system_cache_pool:
                    adapter: cache.system

```

# config/packages/cache.yaml

```yaml
framework:
    cache:
        # Unique name of your app: used to compute stable namespaces for cache keys.
        #prefix_seed: your_vendor_name/app_name

        # The "app" cache stores to the filesystem by default.
        # The data in this cache should persist between deploys.
        # Other options include:

        # Redis
        #app: cache.adapter.redis
        #default_redis_provider: redis://localhost

        # APCu (not recommended with heavy random-write workloads as memory fragmentation can cause perf issues)
        #app: cache.adapter.apcu

        # Namespaced pools use the above "app" backend by default
        #pools:
            #my.dedicated.cache: null

```


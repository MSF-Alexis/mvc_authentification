# Projet MVC Authentification - Guide d'Installation et de Démarrage

## 🎯 À propos de ce projet

Ce projet pédagogique vous permettra d'**apprendre à gérer l'authentification dans une architecture MVC**, une compétence essentielle du bloc BC02 du référentiel RNCP 37674 - Développeur Web et Web Mobile.

### 🎓 Objectifs d'apprentissage

À travers cette application, vous développerez vos compétences en :

- **Architecture MVC** avec un système de routage personnalisé
- **Gestion de l'authentification et des sessions** utilisateurs
- **Base de données MariaDB** avec structure de table `users`
- **Autoloading PSR-4** et gestion des dépendances avec Composer
- **Configuration d'environnement** avec DotEnv
- **Conteneurisation Docker** pour l'environnement de développement


---

## 🚀 Installation rapide (copier-coller)

### Étape 1 : Cloner le projet

```bash
git clone https://github.com/MSF-Alexis/mvc_authentification.git
cd mvc_authentification
```

### Étape 2 : Configuration de l'environnement

Sur windows : 

Copier coller le fichier **.env.example** à la racine du projet et renommé le en **.env**

Sur linux :

```bash
# Copier le fichier d'exemple des variables d'environnement
cp .env.example .env
```



### Étape 3 : Définir les variables d'environnement

Ouvrez le fichier `.env` et configurez vos variables selon cette structure :

```bash
APP_NAME="Authentification - App"

DB_HOST=database
DB_PORT=3306
MARIADB_USER=votre_utilisateur
MARIADB_PASSWORD=votre_mot_de_passe
MARIADB_DATABASE=mvc_authentification
```

**⚠️ Important :** 
- `DB_HOST=database` correspond au nom du service dans docker-compose.yml
- Les variables `MARIADB_*` sont utilisées par le conteneur MariaDB
- Sans cette configuration, le docker-compose.yml ne fonctionnera pas

### Étape 4 : Installation des dépendances

```bash
composer install
```

### Étape 5 : Construction de l'image Docker PHP (Facultatif)

Le projet utilise une image personnalisée `php-apache-dev-env`. Vous devez d'abord la construire :

```bash
# Si vous avez un Dockerfile pour php-apache-dev-env
docker build -t php-apache-dev-env .

# Ou utiliser une image PHP-Apache standard (modification temporaire)
# Modifiez docker-compose.yml : image: php:8.0-apache
```

### Étape 6 : Démarrage avec Docker

```bash
docker-compose up -d
```

### Étape 7 : Vérification de l'installation

1. **Accéder à l'application :**
   ```
   http://localhost:8080
   ```

2. **Tester la page de test :**
   ```
   http://localhost:8080/test
   ```

3. **Vérifier la base de données :**
   ```bash
   docker exec -it nom_conteneur_mariadb mysql -u votre_utilisateur -p mvc_authentification
   ```

---

## 📂 Structure du projet

```
mvc_authentification/
├── app/
│   ├── Core/
│   │   ├── Controller.php    # Contrôleur de base avec méthode render()
│   │   ├── Model.php         # Modèle de base avec connexion PDO
│   │   └── Router.php        # Système de routage avec regex
│   └── Views/
│       └── layout.php        # Template de base
├── .env.example              # Variables d'environnement
├── .gitignore               # Fichiers à ignorer par Git
├── .htaccess                # Réécriture d'URL Apache
├── composer.json            # Dépendances PHP
├── docker-compose.yml       # Configuration Docker
├── index.php                # Point d'entrée de l'application
├── init.sql                 # Script d'initialisation de la BDD
└── routes.php               # Définition des routes
```

### Dépendances Composer

Le projet utilise uniquement :
- **PHP >= 8.0**
- **vlucas/phpdotenv ^5.6** pour la gestion des variables d'environnement

---

## 🌐 Système de routage

Le routeur personnalisé (`app/Core/Router.php`) supporte :

### Routes simples
```php
$router->get('/', function() {
    // Page d'accueil
});

$router->get('test', function() {
    // Page de test
});
```

### Routes avec paramètres (regex)
```php
$router->get('user/([0-9]+)', function($id) {
    // Utilisateur par ID
});
```

### Réécriture d'URL

Le fichier `.htaccess` redirige toutes les requêtes vers `index.php` :

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?uri=$1 [L,QSA]
```

---

---

## 🧪 Tests et validation

### Vérifications post-installation :

1. **Application fonctionnelle :**
   ```bash
   curl http://localhost:8080
   # Doit afficher : "Bienvenue dans Authentification - App !"
   ```

2. **Routage opérationnel :**
   ```bash
   curl http://localhost:8080/test
   # Doit afficher : "Page de test" et "URL propre fonctionnelle !"
   ```

3. **Base de données accessible :**
   ```bash
   docker exec -it $(docker ps -q --filter "ancestor=mariadb:latest") mysql -u dev_user -p mvc_authentification -e "DESCRIBE users;"
   ```

4. **Variables d'environnement chargées :**
   - Vérifiez que le titre de la page affiche le nom de votre APP_NAME


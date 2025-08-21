# 0. Introduction - Système d'Authentification MVC

## 🎯 Objectif Général

Créer un **système d'authentification complet** en PHP en utilisant l'architecture **MVC** (Modèle-Vue-Contrôleur). Ce système permettra aux utilisateurs de :

- **S'inscrire** avec un pseudo, email et mot de passe
- **Se connecter** de manière sécurisée  
- **Gérer leur session** (connexion/déconnexion)
- **Accéder** à des pages protégées

---

## 📋 Fonctionnalités à Implémenter

### ✅ **Inscription d'utilisateur**
- Formulaire avec validation côté client et serveur
- Hachage sécurisé du mot de passe
- Vérification de l'unicité de l'email
- Messages d'erreur informatifs

### ✅ **Connexion d'utilisateur**
- Vérification des identifiants
- Création de session sécurisée
- Redirection après connexion réussie

### ✅ **Gestion des sessions**
- Sessions créées uniquement lors de la connexion
- Sécurisation contre la fixation de session
- Déconnexion propre avec nettoyage

### ✅ **Interface utilisateur**
- Formulaires HTML avec validation
- Messages d'erreur et de succès
- Navigation adaptée selon l'état de connexion

---

## 🏗️ Architecture MVC

### **Modèle (Model)**
- `User.php` : Gestion des données utilisateur en base
- Méthodes : `store()`, `findByEmail()`, `findById()`
- Requêtes préparées pour la sécurité

### **Vue (View)**  
- `auth/register.php` : Formulaire d'inscription
- `auth/login.php` : Formulaire de connexion
- `layouts/main.php` : Layout principal avec navigation

### **Contrôleur (Controller)**
- `AuthController.php` : Logique d'authentification
- Validation des données, hachage, sessions
- Liaison entre Modèles et Vues

---

## 🛠️ Technologies Utilisées

### **Langages**
- **PHP 8+** : Logique serveur
- **HTML5** : Structure des pages
- **CSS3** : Styling (optionnel)

### **Base de Données**
- **MySQL** avec **PDO** : Stockage sécurisé
- Table `users` avec champs : `id`, `pseudo`, `email`, `password`, `created_at`

### **Sécurité**
- **Hachage Argon2** : Protection des mots de passe
- **Requêtes préparées** : Protection contre les injections SQL
- **Sessions sécurisées** : Protection contre la fixation
- **Validation** : Côté client (HTML5) et serveur (PHP)

---

## 📚 Prérequis Techniques

### **Connaissances PHP** (acquises)
- Variables, tableaux, fonctions
- Structures de contrôle (if/else, boucles)
- Traitement des formulaires (`$_POST`)
- Validation et nettoyage de données
- Connexion PDO et requêtes préparées

### **Nouvelles Notions** (à apprendre)
- 🆕 **Sessions PHP** : Gestion des utilisateurs connectés  
- 🆕 **Hachage sécurisé** : `password_hash()` et `password_verify()`

---

## 📁 Structure des Fichiers

```
projet/
├── app/
│   ├── Controllers/
│   │   └── AuthController.php
│   ├── Models/
│   │   └── User.php
│   ├── Views/
│   │   ├── layouts/
│   │   │   └── main.php
│   │   └── auth/
│   │       ├── register.php
│   │       └── login.php
│   └── Core/
│       ├── Controller.php
│       └── Database.php
├── public/
│   ├── index.php
│   └── css/
│       └── main.css
├── config/
│   └── database.php
└── routes.php
```

---

## 📖 Plan de Formation

### **Document 1 : Modèle User**
- Création de la table `users`
- Classe `User` avec méthodes CRUD
- Connexion PDO sécurisée

### **Document 2 : Vues d'Authentification** 
- Formulaires HTML d'inscription/connexion
- Layout principal avec navigation
- Validation côté client

### **Document 3 : Contrôleur AuthController**
- Logique de traitement des formulaires
- Hachage et vérification des mots de passe  
- Gestion sécurisée des sessions

### **Document 4 : Intégration et Tests**
- Configuration des routes
- Tests des fonctionnalités
- Débogage et optimisation

---

## 🎯 Objectifs Pédagogiques

À la fin de cette formation, vous saurez :

1. **Structurer** une application PHP avec l'architecture MVC
2. **Sécuriser** les mots de passe avec un hachage moderne
3. **Gérer** les sessions utilisateur de manière optimale
4. **Valider** les données côté client et serveur
5. **Protéger** contre les failles de sécurité courantes
6. **Organiser** votre code de manière maintenable et évolutive

---

## ⚠️ Points d'Attention

### **Sécurité**
- **Jamais** de mots de passe en clair en base
- **Toujours** utiliser des requêtes préparées
- **Sessions** créées uniquement lors de la connexion
- **Validation** systématique des données utilisateur

### **Bonnes Pratiques**
- **Séparation** claire des responsabilités (MVC)
- **Nommage** cohérent des fichiers et variables
- **Messages d'erreur** informatifs mais pas révélateurs
- **Code** documenté et structuré

---

## 🚀 Prêt à Commencer ?

La formation est progressive et chaque document s'appuie sur le précédent. Chaque étape sera testable individuellement pour valider votre compréhension.

**Commençons par la création du modèle User !**
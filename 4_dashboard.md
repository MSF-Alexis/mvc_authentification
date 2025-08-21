# 5. Vue Dashboard - Affichage des informations utilisateur

## 🎯 Objectif

Créer la vue du tableau de bord pour afficher les informations de l'utilisateur connecté en appliquant les concepts PHP du cours initial.

## 📁 Fichier à créer

**TODO: Créez le fichier** `views/dashboard/index.php`

---

## 🔍 Concepts PHP appliqués dans la vue

### **Affichage sécurisé avec htmlspecialchars()**

```php
<h2>Bienvenue sur votre tableau de bord</h2>

<div class="user-info">
    <p>Identifiant : <strong><?= htmlspecialchars($user['id'], ENT_QUOTES) ?></strong></p>
    <p>Pseudo : <strong><?= htmlspecialchars($user['name'], ENT_QUOTES) ?></strong></p>
    <p>Email : <strong><?= htmlspecialchars($user['email'], ENT_QUOTES) ?></strong></p>
</div>
```

**Concepts utilisés :**
- **Syntaxe courte PHP** : `<?=` équivaut à `<?php echo`
- **Fonction `htmlspecialchars()`** : Protection contre les attaques XSS
- **Constante `ENT_QUOTES`** : Échappement des guillemets simples et doubles
- **Accès tableau associatif** : `$user['clé']` pour récupérer les données

---

## 🔒 Sécurité - Protection XSS

### **Pourquoi utiliser htmlspecialchars() avec ENT_QUOTES ?**

```php
// TODO: Appliquez cette technique pour tous les affichages
htmlspecialchars($user['name'], ENT_QUOTES)
```

**Protection offerte :**
- **Échappement HTML** : `<script>` devient `&lt;script&gt;`
- **Protection guillemets** : `"` devient `&quot;` et `'` devient `&#039;`
- **Prévention XSS** : Empêche l'exécution de code malveillant

**Exemple sans protection (DANGEREUX) :**
```php
<!-- NE JAMAIS FAIRE ÇA -->
<p><?= $user['name'] ?></p> <!-- Vulnérable aux attaques XSS -->
```

**Exemple avec protection (CORRECT) :**
```php
<!-- TOUJOURS FAIRE ÇA -->
<p><?= htmlspecialchars($user['name'], ENT_QUOTES) ?></p>
```

---

## 🎭 PHP & HTML - Intégration des données

### **Structure complète de la vue**

```php
<?php
// TODO: Implémentez cette vue complète
// Vérification déjà faite dans le contrôleur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Dashboard', ENT_QUOTES) ?></title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Mon Application</h1>
            <nav>
                <a href="/dashboard">Dashboard</a>
                <a href="/logout">Déconnexion</a>
            </nav>
        </header>

        <main>
            <h2>Bienvenue sur votre tableau de bord</h2>
            
            <div class="user-details">
                <p>Identifiant : <strong><?= htmlspecialchars($user['id'], ENT_QUOTES) ?></strong></p>
                <p>Pseudo : <strong><?= htmlspecialchars($user['name'], ENT_QUOTES) ?></strong></p>
                <p>Email : <strong><?= htmlspecialchars($user['email'], ENT_QUOTES) ?></strong></p>
            </div>

            <div class="actions">
                <p><a href="/profile">Modifier mon profil</a></p>
                <p><a href="/logout">Se déconnecter</a></p>
            </div>
        </main>
    </div>
</body>
</html>
```

---

## ✅ Tests de votre vue

```php
// Test d'affichage
// 1. Se connecter avec un utilisateur valide
// 2. Accéder au dashboard
//    → Doit afficher "Bienvenue sur votre tableau de bord"
//    → Doit afficher ID, pseudo (name), email de l'utilisateur
//    → Tous les caractères spéciaux doivent être échappés
```

## 🎯 Différences avec le modèle générique

**Champs spécifiques à votre projet :**
- **`$user['id']`** : Identifiant numérique
- **`$user['name']`** : Pseudo de l'utilisateur (pas 'pseudo')
- **`$user['email']`** : Adresse email

**Sécurité renforcée :**
- **`ENT_QUOTES`** : Protection des guillemets en plus des caractères HTML
- **Échappement systématique** : Toutes les données utilisateur sont protégées

---

## 🎯 Objectifs d'apprentissage

Cette étape vous permet de :

1. **Appliquer** l'affichage de données avec la syntaxe courte PHP
2. **Sécuriser** l'affichage contre les attaques XSS
3. **Utiliser** les constantes PHP (ENT_QUOTES)
4. **Accéder** aux données des tableaux associatifs
5. **Intégrer** PHP et HTML de manière propre et sécurisée
markdown authentification suivant

# 2. Vues d'Authentification

## 🎯 Objectif

Créer les vues d'inscription et de connexion en utilisant l'architecture de templates du projet MVC avec capture de contenu et layout.

## 📁 Fichiers à créer

- `app/Views/auth/register.php`
- `app/Views/auth/login.php`

## 🏗️ Architecture des vues

Le contrôleur utilise `$this->render("auth/login", $data)` qui :

1. **Extrait les données** : `extract($data)` rend `$errors`, `$title` accessibles
2. **Capture le contenu** : `ob_start()` → inclut la vue → `ob_get_clean()`
3. **Injecte dans le layout** : Le contenu capturé devient `$content` dans `layout.php`

## ✍️ Vue `register.php`

```php
<div class="form-container">
    <h2>Inscription</h2>

    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="error-messages">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/register" method="post">
        <div class="form-group">
            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" required 
                   value="<?= htmlspecialchars($_POST['pseudo'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required 
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn">S'inscrire</button>
    </form>

    <div class="form-links">
        <p><a href="/connexion">Déjà inscrit ? Se connecter</a></p>
    </div>
</div>
```

## ✍️ Vue `login.php`

```php
<div class="form-container">
    <h2>Connexion</h2>

    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="error-messages">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/login" method="post">
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required 
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="remember" value="1"> 
                Se souvenir de moi
            </label>
        </div>

        <button type="submit" class="btn">Se connecter</button>
    </form>

    <div class="form-links">
        <p><a href="/inscription">Pas encore inscrit ? S'inscrire</a></p>
        <p><a href="/mot-de-passe-oublie">Mot de passe oublié ?</a></p>
    </div>
</div>
```

## 💡 Points importants

### Architecture du rendu
- **Pas de DOCTYPE/HTML** : Les vues ne contiennent que le contenu spécifique
- **Capture de contenu** : `ob_start()` capture tout le HTML de la vue
- **Injection dans layout** : Le contenu devient `$content` dans `layout.php`
- **Variables partagées** : `extract($data)` rend les variables du contrôleur accessibles

### Sécurité
- **Échappement** : `htmlspecialchars()` pour toutes les données affichées
- **Réaffichage sélectif** : Seuls `pseudo` et `email`, jamais le `password`
- **Validation HTML5** : Attributs `required`, `type="email"` pour validation côté client

### Cohérence avec l'existant
- **Routes** : Utilise `/connexion`, `/inscription` comme dans le routeur
- **Actions** : Pointe vers `/login`, `/register` pour traitement POST
- **Classes CSS** : Structure cohérente pour styling ultérieur

## ✅ Test des vues

1. Visitez `/inscription` → Vérifie le rendu avec layout
2. Soumettez avec erreurs → Vérifie l'affichage des messages
3. Visitez `/connexion` → Vérifie la cohérence visuelle
4. Testez la préservation des valeurs en cas d'erreur
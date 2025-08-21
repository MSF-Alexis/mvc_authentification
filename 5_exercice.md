# 📱 Projet Final : Annuaire Personnel Authentifié

## 🎯 Objectif

Fusionner un annuaire CRUD existant avec un système d’authentification pour obtenir une application où chaque utilisateur gère son propre annuaire privé.

***

## 🚀 Livrables attendus

1. Copie du projet `annuaire` renommé en `annuaire_authentifie`.
2. Schéma SQL mis à jour (table `users` + colonne `user_id` dans `contacts`).
3. Modèles, contrôleurs et vues ajustés pour l’authentification et l’isolation des données.
4. Layout global avec navigation selon l’état de session.
5. Scénarios de tests documentés.

***

## 🗂️ Structure de travail

### Phase 1 – Préparation

- Dupliquer `annuaire/` en `annuaire_authentifie/`.
- Copier depuis le projet d’authentification :
    - `app/Models/User.php` → `app/Models/`
    - `app/Controllers/AuthController.php` → `app/Controllers/`
    - Dossier `views/auth/` → `views/`


### Phase 2 – Base de données

- Créer la table `users` (id, name, email, password, created_at).
- Modifier `contacts` : ajouter `user_id`, clé étrangère vers `users.id`.
- Fournir script SQL de création/altération et données de test.


### Phase 3 – Modèles

- **Contact.php** :
    - **CREATE** : ajouter `user_id` dans l’INSERT.
    - **SELECT** : méthode `getByUserId(int $userId)` pour lister.
    - **FIND/UPDATE/DELETE** : filtrer sur `user_id`.


### Phase 4 – Contrôleurs

- **ContactController::__construct()** :
    - `session_start()` si nécessaire.
    - Redirection vers `/login` si non connecté.
- Actions (index, show, store, update, delete) :
    - Récupérer `$userId = $_SESSION['user']['id']`.
    - Passer `$userId` aux méthodes du modèle.


### Phase 5 – Vues \& Layout

- **Layout** : afficher liens `Connexion/Inscription` ou `Mes Contacts/Déconnexion`.
- **contacts/index.php**, **show.php**, **form.php** : protéger l’accès si pas de session.
- Message flash pour succès et erreur.


### Phase 6 – Routes

- Auth :
    - `GET /register`, `POST /register`
    - `GET /login`, `POST /login`
    - `GET /logout`
- Contacts (protégées) :
    - `GET /contacts`, `GET /contacts/create`, `POST /contacts`
    - `GET /contacts/{id}`, `GET /contacts/{id}/edit`
    - `POST /contacts/{id}`, `POST /contacts/{id}/delete`


### Phase 7 – Tests

1. Inscription d’un nouvel utilisateur → redirection dashboard.
2. Accès non connecté à `/contacts` → redirection `/login`.
3. Create, Select pour un utilisateur, CRUD complet contacts isolés.
4. Tentative de voir/modifier les contacts d’un autre utilisateur → refus.
5. Test XSS sur champs de contact (sécurisation `htmlspecialchars()`).

***

## ⚠️ Contraintes

- Utiliser **requêtes préparées** PDO pour toutes les opérations SQL.
- Toujours vérifier `user_id` dans chaque requête CRUD.
- Échapper toute sortie utilisateur avec `htmlspecialchars(..., ENT_QUOTES)`.
- Démarrer la session **uniquement** dans le constructeur des contrôleurs.

***

## 🏆 Extensions possibles (bonus)

- Recherche et tri des contacts.
- Pagination.
- Import/export CSV.
- Groupes de contacts ou catégories.
- Avatar et upload d’image pour contacts.
- Faire un Dashboard admin (implique la création d'utilisateur ADMIN)
***

**À vous de jouer !**
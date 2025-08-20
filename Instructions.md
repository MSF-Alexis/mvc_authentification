# Instructions

Pour cette application "authentification" nous allons utiliser un seul Model nommé User.
Le but de l'authentification est de protéger du contenu de notre site aux utilisateurs qui n'ont pas de compte chez nous, comme le font de nombreux site par exemples vos banques. Personnes ne peut accéder votre page où votre solde est indiqué s'il n'as pas faut informations de connexions. 
C'est exactement ce que nous allons faire ici, créer un moyen d'enregistrer des nouveaux membres, 
tester si les informations sont bonnes lors de la tentative de connexion. 

## Étape - 1
Créer un model **/app/Models/User.php** avec
- Model comme classe parente
- Une méthode store(array $data) : bool
- Une méthode findByEmail(string $email) : array | null

## Étape - 2
Créer un controller **/app/controllers/AuthController.php** avec
- Controller comme classe parente
- Une méthode showRegisterForm()
- Une méthode register()
- Une méthode showLoginForm()
- Une méthode login()
- Une méthode logout()



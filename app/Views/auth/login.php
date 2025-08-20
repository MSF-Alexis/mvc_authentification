<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Connexion</h2>
        
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <div><?= $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/login">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    Se souvenir de moi
                </label>
            </div>
            
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
        
        <div class="mt-3">
            <a href="/inscription">Pas encore inscrit ? S'inscrire</a>
        </div>
        
        <div class="mt-2">
            <a href="/forgot-password">Mot de passe oublié ?</a>
        </div>
    </div>
</div>
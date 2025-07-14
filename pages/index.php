<?php
require ('../inc/connection.php');
$resultat = mysqli_query($bdd, 'SELECT * FROM Etudiant');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBJET_TROC - Connexion</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="auth-card card p-4">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h1 class="brand">OBJET_TROC</h1>
                    <p class="text-muted">Empruntez ou prêtez des objets en toute simplicité</p>
                </div>

                <div id="login-form" class="auth-form active">
                    <form action="traitementlog.php" method="get">
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email1" placeholder="Adresse e-mail" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="mdp1" placeholder="Mot de passe" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2">Se connecter</button>
                        <div class="text-center mb-3">
                        </div>
                        <div class="divider"></div>
                        <button type="button" id="show-signup" class="btn btn-outline-secondary w-100">
                            Créer un nouveau compte
                        </button>
                    </form>
                </div>

                <div id="signup-form" class="auth-form">
                    <form action="anehona.php" method="get">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nom" placeholder="Nom complet" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Adresse e-mail" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="mdp" placeholder="Nouveau mot de passe" required>
                        </div>
                        <div class="mb-3">
                            <input type="date" class="form-control" name="date" placeholder="Date de naissance" required>
                        </div>
                        <div class="mb-3">
                            <select name="sexe" class="form-control" required>
                                <option value="M">Homme</option>
                                <option value="F">Femme</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100 mb-3">S'inscrire</button>
                        <div class="divider"></div>
                        <button type="button" id="show-login" class="btn btn-outline-secondary w-100">
                            Déjà inscrit ? Se connecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginForm = document.getElementById('login-form');
            const signupForm = document.getElementById('signup-form');
            const showSignup = document.getElementById('show-signup');
            const showLogin = document.getElementById('show-login');

            showSignup.addEventListener('click', function () {
                loginForm.classList.remove('active');
                signupForm.classList.add('active');
            });

            showLogin.addEventListener('click', function () {
                signupForm.classList.remove('active');
                loginForm.classList.add('active');
            });
        });
    </script>
</body>
</html>

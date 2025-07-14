<?php
session_start();
require ('../inc/connection.php');
require('../inc/functions.php');

$email = $_GET['email'];
$nom = $_GET['nom'];
$date = $_GET['date'];
$mdp = $_GET['mdp'];
$sexe = $_GET['sexe'];

$_SESSION['nom'] = $nom;

// Appelle la fonction d'insertion (supposée sécurisée)
mampiditra_membre($nom, $email, $date, $mdp, $sexe);

// Prépare la requête SQL avec les variables injectées correctement
$sql = sprintf(
    "SELECT id_membre FROM membrePf WHERE nom='%s' AND email='%s' AND mdp='%s'",
    mysqli_real_escape_string($bdd, $nom),
    mysqli_real_escape_string($bdd, $email),
    mysqli_real_escape_string($bdd, $mdp)
);

$req = mysqli_query($bdd, $sql);

if ($req && mysqli_num_rows($req) > 0) {
    $id = mysqli_fetch_assoc($req);
    $_SESSION['idmembre'] = $id['id_membre'];
    echo $_SESSION['idmembre'];
    header("location:mety.php"); 
} else {
    echo "Erreur : membre non trouvé ou requête échouée.";
}
?>

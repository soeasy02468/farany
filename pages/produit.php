<?php
session_start();
require('../inc/connection.php'); // ← N'oublie pas la connexion à la base

// Vérification de la session et des paramètres
if (isset($_SESSION['idmembre']) && isset($_GET['id'])) {
    $idmembre = intval($_SESSION['idmembre']);
    $idproduit = intval($_GET['id']);

    if (isset($_GET['date_retour'])) {
        $date_retour = $_GET['date_retour'];

        // Préparer la requête correctement
        $sql = "INSERT INTO empruntPf (id_objet, id_membre, date_emprunt, date_retour)
                VALUES ($idproduit, $idmembre, NOW(), '$date_retour')";
        
        if (mysqli_query($bdd, $sql)) {
            // Redirection vers mety.php après insertion réussie
            header("Location: mety.php");
            exit();
        } else {
            echo "Erreur lors de l'enregistrement.";
        }
    }
} else {
    echo "Accès non autorisé ou paramètres manquants.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Emprunter un objet</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Choisissez la date de retour</h2>
        <form method="get">
            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? intval($_GET['id']) : ''; ?>">
            <div class="mb-3">
                <input type="date" class="form-control" name="date_retour" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Valider">
        </form>
    </div>
</body>
</html>

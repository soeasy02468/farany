<?php
session_start();
$monid = $_SESSION['idmembre'];
require('../inc/connection.php');
include('../inc/header.php');

$sql = mysqli_query($bdd, "SELECT * FROM membrePf WHERE id_membre = $monid");
$donnes = mysqli_fetch_assoc($sql);

$sqli = mysqli_query($bdd, "SELECT * FROM IMAGEPDP_Pf WHERE id_membre = $monid ORDER BY Date_upload DESC LIMIT 1");
$donnermoner = mysqli_fetch_assoc($sqli);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-img-lg { width: 150px; height: 150px; object-fit: cover; }
        .cover-photo { height: 300px; background-size: cover; background-position: center; }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="card mb-4">
        <div class="cover-photo" style="background-image: url('https://via.placeholder.com/1200x300');"></div>
        <div class="card-body position-relative">
            <div class="d-flex align-items-end">
                <?php
                if ($donnermoner) {
                    echo '<img src="../assets/image/imagePDP/' . htmlspecialchars($donnermoner['SOURCE']) . '" class="rounded-circle profile-img-lg border border-4 border-white me-4" style="margin-top: -75px;">';
                } else {
                    echo '<div class="rounded-circle profile-img-lg border border-4 border-white bg-secondary me-4" style="margin-top: -75px;"></div>';
                }
                ?>
                <div class="mb-3">
                    <h2><?= htmlspecialchars($donnes['nom']) ?></h2>
                    <a href="mety.php" class="btn btn-outline-secondary">Retour au fil d'actualité</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire changement PDP -->
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h4>Photo de profil</h4>
        </div>
        <div class="card-body">
            <form action="traitement-uploadPDP.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_membreM" value="<?= $donnes['id_membre'] ?>">
                <div class="mb-3">
                    <input type="file" name="fichier" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Changer photo de profil</button>
            </form>
        </div>
    </div>

    <!-- Objets empruntés -->
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h4>Objets que vous avez empruntés</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                $requete = "
                    SELECT objetPf.id_objet, nom_objet, date_retour, nom_categorie
                    FROM empruntPf
                    JOIN objetPf ON empruntPf.id_objet = objetPf.id_objet
                    JOIN categorie_objetPf ON objetPf.id_categorie = categorie_objetPf.id_categorie
                    WHERE empruntPf.id_membre = $monid
                    ORDER BY date_emprunt DESC
                ";
                $resultats = mysqli_query($bdd, $requete);

                if (mysqli_num_rows($resultats) > 0) {
                    while ($obj = mysqli_fetch_assoc($resultats)) {
                        echo '<div class="col-md-4 mb-4">';
                        echo '  <div class="card shadow-sm">';
                        echo '    <div class="card-body">';
                        echo '      <h5 class="card-title">' . htmlspecialchars($obj['nom_objet']) . '</h5>';
                        echo '      <p class="card-text">Catégorie : ' . htmlspecialchars($obj['nom_categorie']) . '</p>';
                        if ($obj['date_retour']) {
                            echo '<p class="text-danger">Emprunté jusqu\'au ' . htmlspecialchars($obj['date_retour']) . '</p>';
                        } else {
                            echo '<p class="text-success">Date de retour inconnue</p>';
                        }
                        echo '    </div>';
                        echo '  </div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-muted">Vous n\'avez encore emprunté aucun objet.</p>';
                }
                ?>
            </div>
        </div>
    </div>

</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

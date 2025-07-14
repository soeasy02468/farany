<?php
require('../inc/connection.php');
session_start();

if (!isset($_GET['id'])) {
    echo "Aucun objet sélectionné.";
    exit;
}

$idObjet = intval($_GET['id']);

// Infos de l'objet
$objetQuery = mysqli_query($bdd, "
    SELECT objetPf.*, categorie_objetPf.nom_categorie 
    FROM objetPf 
    JOIN categorie_objetPf ON objetPf.id_categorie = categorie_objetPf.id_categorie 
    WHERE objetPf.id_objet = $idObjet
");

$objet = mysqli_fetch_assoc($objetQuery);

if (!$objet) {
    echo "Objet introuvable.";
    exit;
}

// Images de l'objet
$imagesQuery = mysqli_query($bdd, "
    SELECT nom_image FROM images_objetPf WHERE id_objet = $idObjet
");
$images = [];
while ($img = mysqli_fetch_assoc($imagesQuery)) {
    $images[] = $img['nom_image'];
}

// Historique d'emprunts
$empruntsQuery = mysqli_query($bdd, "
    SELECT empruntPf.date_emprunt, empruntPf.date_retour, membrePf.nom 
    FROM empruntPf 
    JOIN membrePf ON empruntPf.id_membre = membrePf.id_membre 
    WHERE id_objet = $idObjet 
    ORDER BY date_emprunt DESC
");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'objet</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <style>
        .img-thumbnail {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }
        .mini-img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <a href="mety.php" class="btn btn-secondary mb-3">← Retour</a>

    <div class="row">
        <div class="col-md-6">
            <?php
            if (count($images) > 0) {
                echo '<img src="uploads/' . htmlspecialchars($images[0]) . '" class="img-thumbnail mb-3">';
            } else {
                echo '<img src="uploads/default.png" class="img-thumbnail mb-3">';
            }
            ?>

            <?php if (count($images) > 1): ?>
                <div class="row">
                    <?php foreach (array_slice($images, 1) as $img): ?>
                        <div class="col-4 mb-2">
                            <img src="uploads/<?= htmlspecialchars($img) ?>" class="mini-img">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <h3><?= htmlspecialchars($objet['nom_objet']) ?></h3>
            <p><strong>Catégorie :</strong> <?= htmlspecialchars($objet['nom_categorie']) ?></p>
            <p><strong>ID Membre Propriétaire :</strong> <?= $objet['id_membre'] ?></p>
        </div>
    </div>

    <hr>

    <h4>Historique des emprunts</h4>
    <?php
    if (mysqli_num_rows($empruntsQuery) > 0) {
        echo '<ul class="list-group">';
        while ($emp = mysqli_fetch_assoc($empruntsQuery)) {
            echo '<li class="list-group-item">';
            echo '<strong>' . htmlspecialchars($emp['nom']) . '</strong> a emprunté le <strong>' . $emp['date_emprunt'] . '</strong>';
            if ($emp['date_retour']) {
                echo ' jusqu\'au <strong>' . $emp['date_retour'] . '</strong>';
            } else {
                echo ' (non retourné)';
            }
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p class="text-muted">Aucun emprunt enregistré pour cet objet.</p>';
    }
    ?>
</div>
</body>
</html>

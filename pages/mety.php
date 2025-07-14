<?php
session_start();
$idm=$_SESSION['idmembre'] ;
require('../inc/connection.php');
include('../inc/header.php');

$categories = mysqli_query($bdd, "SELECT * FROM categorie_objetPf");

$cat = 0;
if (isset($_POST['categorie'])) {
    $cat = intval($_POST['categorie']);
}

$requete = "SELECT objetPf.*, categorie_objetPf.nom_categorie, empruntPf.date_retour, images_objetPf.nom_image
            FROM objetPf
            INNER JOIN categorie_objetPf ON objetPf.id_categorie = categorie_objetPf.id_categorie
            LEFT JOIN empruntPf ON objetPf.id_objet = empruntPf.id_objet
            LEFT JOIN images_objetPf ON objetPf.id_objet = images_objetPf.id_objet";


if ($cat > 0) {
    $requete .= " WHERE objetPf.id_categorie = $cat";
}

$resultats = mysqli_query($bdd, $requete);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Objets à emprunter</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>  
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Liste des objets</h2>

    <form method="post" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label for="categorie">Filtrer par catégorie :</label>
                <select name="categorie" id="categorie" class="form-select">
                    <option value="0">Toutes les catégories</option>
                    <?php
                    while ($catRow = mysqli_fetch_assoc($categories)) {
                        $selected = ($cat == $catRow['id_categorie']) ? 'selected' : '';
                        echo '<option value="' . $catRow['id_categorie'] . '" ' . $selected . '>' . $catRow['nom_categorie'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </div>
    </form>

    <div class="row">
    <?php
    while ($obj = mysqli_fetch_assoc($resultats)) {
        echo '<div class="col-md-4 mb-4">';
        echo '  <div class="card shadow-sm">';
        
        if (!empty($obj['nom_image'])) {
            echo '<img src="uploads/' . htmlspecialchars($obj['nom_image']) . '" class="card-img-top" alt="' . htmlspecialchars($obj['nom_objet']) . '">';
        } else {

            echo '<img src="uploads/default.png" class="card-img-top" alt="Image par défaut">';
        }
        
        echo '    <div class="card-body">';
        echo '      <h5 class="card-title">' . htmlspecialchars($obj['nom_objet']) . '</h5>';
        echo '      <p class="card-text">Catégorie : ' . htmlspecialchars($obj['nom_categorie']) . '</p>';
        
        if ($obj['date_retour']) {
            echo '<p class="text-danger">Emprunté jusqu\'au ' . htmlspecialchars($obj['date_retour']) . '</p>';
        } else {
            echo '<a href="produit.php?id=' . (int)$obj['id_objet'] . '"><p class="text-success">Disponible</p></a>';
        }
        
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
    }
    ?>
</div>

</div>
<a href="envoye_offre.php">Envoyer une offre</a>
</body>
</html>

<?php
session_start();
$idm = $_SESSION['idmembre'];
require('../inc/connection.php');
require('../inc/functions.php');
include('../inc/header.php');

$categories = mysqli_query($bdd, "SELECT * FROM categorie_objetPf");

$cat = 0;
if (isset($_POST['categorie'])) {
    $cat = intval($_POST['categorie']);
}

$requete = "
    SELECT objetPf.*, categorie_objetPf.nom_categorie, empruntPf.date_retour, images_objetPf.nom_image
    FROM objetPf
    INNER JOIN categorie_objetPf ON objetPf.id_categorie = categorie_objetPf.id_categorie
    LEFT JOIN empruntPf ON objetPf.id_objet = empruntPf.id_objet
    LEFT JOIN images_objetPf ON objetPf.id_objet = images_objetPf.id_objet
";

if ($cat > 0) {
    $requete .= " WHERE objetPf.id_categorie = $cat";
}

$requete .= " GROUP BY objetPf.id_objet";
$resultats = mysqli_query($bdd, $requete);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Objets à emprunter</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary fw-bold">Objets disponibles à l'emprunt</h2>

    <form method="post" class="mb-4">
        <div class="row g-2">
            <div class="col-md-6">
                <label for="categorie" class="form-label">Filtrer par catégorie :</label>
                <select name="categorie" id="categorie" class="form-select">
                    <option value="0">-- Toutes les catégories --</option>
                    <?php while ($catRow = mysqli_fetch_assoc($categories)) {
                        $selected = ($cat == $catRow['id_categorie']) ? 'selected' : '';
                        echo '<option value="' . $catRow['id_categorie'] . '" ' . $selected . '>' . htmlspecialchars($catRow['nom_categorie']) . '</option>';
                    } ?>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtrer</button>
            </div>
        </div>
    </form>

    <div class="row">
        <?php while ($obj = mysqli_fetch_assoc($resultats)) : ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <?php if (!empty($obj['nom_image'])): ?>
                        <img src="uploads/<?= htmlspecialchars($obj['nom_image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($obj['nom_objet']) ?>">
                    <?php else: ?>
                        <img src="uploads/default.png" class="card-img-top" alt="Image par défaut">
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($obj['nom_objet']) ?></h5>
                        <p class="card-text">Catégorie : <?= htmlspecialchars($obj['nom_categorie']) ?></p>
                        
                        <?php if ($obj['date_retour']) : ?>
                            <p class="indisponible">De retoru le <?= htmlspecialchars($obj['date_retour']) ?></p>
                        <?php else : ?>
                            <p class="disponible">Disponible</p>
                        <?php endif; ?>
                        
                        <div class="mt-auto pt-3">
                            <?php if (!$obj['date_retour']) : ?>
                                <a href="produit.php?id=<?= (int)$obj['id_objet'] ?>" class="btn btn-emprunt text-white w-100 mb-2">
                                    Emprunter
                                </a>
                            <?php endif; ?>
                            <a href="produitP.php?id=<?= (int)$obj['id_objet'] ?>" class="btn btn-details text-white w-100">
                                Voir détails
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="text-center mt-4">
    </div>
</div>

</body>
</html>
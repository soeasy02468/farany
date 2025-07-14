<?php
session_start();
require('../inc/connection.php'); // Connexion à la base dans $bdd

// Paramètres de l'upload
$repertoireUpload = __DIR__ . '/uploads/';
$tailleMax = 2 * 1024 * 1024; // 2 Mo
$typesAutorises = ['image/jpeg', 'image/png'];

// Récupération des données du formulaire
$nomObjet = isset($_POST['nom_objet']) ? trim($_POST['nom_objet']) : '';
$idCategorie = isset($_POST['id_categorie']) ? (int)$_POST['id_categorie'] : 0;
$idMembre = isset($_SESSION['idmembre']) ? (int)$_SESSION['idmembre'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($nomObjet == '' || $idCategorie <= 0 || $idMembre <= 0) {
        die('Données manquantes ou invalides.');
    }

    if (!isset($_FILES['fichier'])) {
        die('Aucun fichier reçu.');
    }

    $fichier = $_FILES['fichier'];

    if ($fichier['error'] != UPLOAD_ERR_OK) {
        die('Erreur lors de l\'upload : ' . $fichier['error']);
    }

    if ($fichier['size'] > $tailleMax) {
        die('Le fichier est trop volumineux.');
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $fichier['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $typesAutorises)) {
        die('Type de fichier non autorisé : ' . $mime);
    }

    $nomOriginal = pathinfo($fichier['name'], PATHINFO_FILENAME);
    $extension = pathinfo($fichier['name'], PATHINFO_EXTENSION);
    $nouveauNom = $nomOriginal . '_' . uniqid() . '.' . $extension;

    if (!move_uploaded_file($fichier['tmp_name'], $repertoireUpload . $nouveauNom)) {
        die('Échec du déplacement du fichier.');
    }

    // Insertion dans la base de données (sans requêtes préparées)
    $nomObjetEsc = mysqli_real_escape_string($bdd, $nomObjet);
    $idCategorieEsc = (int)$idCategorie;
    $idMembreEsc = (int)$idMembre;

    $sql = "INSERT INTO objetPf (nom_objet, id_categorie, id_membre) VALUES ('$nomObjetEsc', $idCategorieEsc, $idMembreEsc)";
    $result = mysqli_query($bdd, $sql);

    if (!$result) {
        die('Erreur lors de l\'insertion dans la base : ' . mysqli_error($bdd));
    }

    $idObjet = mysqli_insert_id($bdd);

    $nouveauNomEsc = mysqli_real_escape_string($bdd, $nouveauNom);
    $sqlImg = "INSERT INTO images_objetPf (id_objet, nom_image) VALUES ($idObjet, '$nouveauNomEsc')";
    $resultImg = mysqli_query($bdd, $sqlImg);

    if (!$resultImg) {
        die('Erreur lors de l\'insertion de l\'image : ' . mysqli_error($bdd));
    }

    echo "Objet et fichier uploadés avec succès ! ID objet : $idObjet";
} else {
    echo "Méthode HTTP non autorisée.";
}
?>

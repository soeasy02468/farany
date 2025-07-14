<?php
session_start();
require('../inc/connection.php');
require('../inc/functions.php');

$repertoireUpload = __DIR__ . '/uploads/';
$tailleMax = 2 * 1024 * 1024; // 2 Mo
$typesAutorises = ['image/jpeg', 'image/png'];

$nomObjet =$_POST['nom_objet'];
$idCategorie = $_POST['id_categorie'];
$idMembre =$_SESSION['idmembre'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $fichier = $_FILES['fichier'];

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

    $nomObjetEsc = mysqli_real_escape_string($bdd, $nomObjet);
    $idCategorieEsc = (int)$idCategorie;
    $idMembreEsc = (int)$idMembre;

    $result = mampidita_object($nomObjetEsc,$idCategorieEsc,$idMembreEsc);

    if (!$result) {
        die('Erreur lors de l\'insertion dans la base : ' . mysqli_error($bdd));
    }

    $idObjet = mysqli_insert_id($bdd);
    
    $resultImg = mampiditra_image($nouveauNom,$idObjet);
    if (!$resultImg) {
        die('Erreur lors de l\'insertion de l\'image : ' . mysqli_error($bdd));
    }

    echo "Objet et fichier uploadés avec succès ! ID objet : $idObjet";
} else {
    echo "Méthode HTTP non autorisée.";
}
?>

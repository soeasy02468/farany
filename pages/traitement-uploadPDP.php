<?php
session_start();
require ('../inc/connection.php');
include ('../inc/functions.php');

$monid = $_SESSION['idmembre'];
$uploadDir = __DIR__ . '/../assets/image/imagePDP/';
$maxSize = 2 * 1024 * 1024; // 2 Mo
$allowedMimeTypes = ['image/jpg', 'image/png', 'application/pdf', 'image/jpeg','image/webp'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier'])) {
    $file = $_FILES['fichier'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Erreur lors de l’upload : ' . $file['error']);
    }

    if ($file['size'] > $maxSize) {
        die('Le fichier est trop volumineux.');
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMimeTypes)) {
        die('Type de fichier non autorisé : ' . $mime);
    }

    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $originalName . '_' . uniqid() . '.' . $extension;

    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        debutimagePDP($monid, $newName);

        $update_sql = "UPDATE IMAGEPDP_Pf SET Date_Upload = NOW() WHERE id_membre = $monid AND Source = '$newName'";
mysqli_query($bdd, $update_sql);

        header("Location: profil.php?source=" . urlencode($newName));
        exit;
    } else {
        echo "Échec du déplacement du fichier.";
    }
} else {
    echo "Aucun fichier reçu.";
}
?>

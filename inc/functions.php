<?php 
include("connection.php");

function mampiditra_membre($nom, $email, $date, $mdp, $sexe) {
    global $bdd; 
    $sql = "INSERT INTO membrePf (nom, email, date_de_naissance, mdp, genre) VALUES ('%s', '%s', '%s', '%s', '%s')";
    $sql = sprintf($sql, $nom, $email, $date, $mdp, $sexe);
    mysqli_query($bdd, $sql);
}

function verif($email, $mdp){
    global $bdd;
    $sql = "SELECT id_membre FROM membrePf WHERE email = '%s' AND mdp = '%s'";
    $sql = sprintf($sql, $email,$mdp);
    $req = mysqli_query($bdd , $sql);
}

function mampidita_object($nomObjetEsc , $idCategorieEsc,$idMembreEsc){
    global $bdd;
    $sql = "INSERT INTO objetPf (nom_objet, id_categorie, id_membre) VALUES ('%s','%s', '%s')";
    $sql = sprintf($sql,$nomObjetEsc,$idCategorieEsc,$idMembreEsc);
    $result = mysqli_query($bdd, $sql);
    return $result;
}

function mampiditra_image($nouveauNom, $idObjet){
    global $bdd;
    $nouveauNomEsc = mysqli_real_escape_string($bdd, $nouveauNom);
    $sqlImg = "INSERT INTO images_objetPf (id_objet, nom_image) VALUES ('%s', '%s')";
    $sqlImg = sprintf($sqlImg, $idObjet, $nouveauNomEsc);
    $resultImg = mysqli_query($bdd, $sqlImg);
    return $resultImg;
}

?>

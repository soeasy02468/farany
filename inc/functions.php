<?php 
include("connection.php");

function mampiditra_membre($nom, $email, $date, $mdp, $sexe) {
    global $bdd; // Ensure the database connection is accessible
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
?>

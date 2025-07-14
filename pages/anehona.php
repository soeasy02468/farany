<?php
    session_start();
require ('../inc/connection.php');

    $email=$_GET['email'];
    $nom=$_GET['nom'];
    $date=$_GET['date'];
    $mdp=$_GET['mdp'];
    $sexe = $_GET['sexe'];
    $_SESSION['nom']= $nom;
    mampiditra_membre($nom, $email, $date, $mdp, $sexe);
    // echo $sql;
    // $requete =mysqli_query($bdd,$sql);
    header("location:mety.php");
    ?>
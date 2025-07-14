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
    $sql="SELECT id_membre from membrePf WHERE nom='%s' AND email='%s' AND mdp='%s'";
    $req=mysqli_query($bdd,$sql);
    $id = mysqli_fetch_assoc($req);
    $_SESSION['id_membre'] = $id['id_membre'];  
    // echo $sql;
    // $requete =mysqli_query($bdd,$sql);
    header("location:mety.php");
    ?>
<?php
   session_start();
   include ('../inc/connection.php');
   require('../inc/functions.php');
   
   // 1. Récupération sécurisée des inputs
   $email1 = mysqli_real_escape_string($bdd, $_GET['email1']);
   $mdp1 = mysqli_real_escape_string($bdd, $_GET['mdp1']);
   
// //    2. Requête préparée (meilleure pratique)
   $sql = "SELECT id_membre FROM membrePf WHERE email = ? AND mdp = ?";
   $stmt = mysqli_prepare($bdd, $sql);
   mysqli_stmt_bind_param($stmt, "ss", $email1, $mdp1);
   mysqli_stmt_execute($stmt);
    // verif($email1 , $mdp1);
   
   // 3. Récupération du résultat
   $result = mysqli_stmt_get_result($stmt);
   $row = mysqli_fetch_assoc($result);
   
   // 4. Vérification et stockage en session
   if ($row) {
       $_SESSION['idmembre'] = $row['id_membre'];
       header("Location: mety.php");
    // echo $_SESSION['idmembre'];
       exit;
   } else {
       // Gestion échec connexion
       header("Location: login.php?error=1");
       exit;
   }
?>
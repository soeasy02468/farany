<?php
   session_start();
   include ('../inc/connection.php');
   require('../inc/functions.php');
   $email1 = mysqli_real_escape_string($bdd, $_GET['email1']);
   $mdp1 = mysqli_real_escape_string($bdd, $_GET['mdp1']);
   
   $sql = "SELECT id_membre FROM membrePf WHERE email = ? AND mdp = ?";
   $stmt = mysqli_prepare($bdd, $sql);
   mysqli_stmt_bind_param($stmt, "ss", $email1, $mdp1);
   mysqli_stmt_execute($stmt);
   
   $result = mysqli_stmt_get_result($stmt);
   $row = mysqli_fetch_assoc($result);
   
   if ($row) {
       $_SESSION['idmembre'] = $row['id_membre'];
       header("Location: mety.php");
       exit;
   } else {
       header("Location: login.php?error=1");
       exit;
   }
?>
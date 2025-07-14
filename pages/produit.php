<?php
    session_start();
    $idmembre= $_SESSION['idmembre'] ;
    $idproduit=$_GET['id'];
    $date_retour=$_GET['date_retour'];
    $sql="INSERT INTO empruntPf (id_objet,id_membre,date_emprunt,date_retour) Values ('%s', '%s', NOW(), '%s') ";
    $sql = sprintf($sql, $idproduit, $idmembre, $date_retour);
    mysqli_query($bdd, $sql);
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
    <input type="date" class="form-control" name="date_retour" placeholder="Selectionnez la date de retour de votre produit" required>
    <input type="submit" value="Valider">
    </form>
</body>
</html>
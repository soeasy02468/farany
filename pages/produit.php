<?php
    $idproduit=$_GET['id'];
    $requete = "SELECT objetPf.*, categorie_objetPf.nom_categorie, empruntPf.date_retour
            FROM objetPf
            INNER JOIN categorie_objetPf ON objetPf.id_categorie = categorie_objetPf.id_categorie
            LEFT JOIN empruntPf ON objetPf.id_objet = empruntPf.id_objet";
            
    $sql="INSERT INTO empruntPf values "
?>  
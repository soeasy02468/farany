<?php
    include("../inc/functions.php");
    include("../inc/header.php");
    $objet =  voir_umprunt($_SESSION['idmembre']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>umprunt</title>
</head>
<body>
     <div>
        <table class="table" style="margin-top: 20px; margin-left: 20px; width: 80%;">
        <tr>
            <th style="font-size:150%"">Objet emprunter</th>
        </tr>
        <?php foreach ($objet as $obj) { ?>
            <tr>
                <td> <?php echo $obj['nom_objet'] ?>
                <form action="rendre.php">
                    <input type="submit" value="Rendre" class="btn btn-danger" name="rendre">
                </form>            
            </td>

            </tr>
        <?php }?>
        </table>
    </div>
</body>
</html>
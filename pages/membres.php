<?php
    include("../inc/functions.php");
    include("../inc/header.php");
    $membres = maka_membre();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Membres</title>
</head>
<body>
    <div>
        <table class="table" style="margin-top: 20px; margin-left: 20px; width: 80%;">
        <tr>
            <th style="font-size:150%">id_membre</th>
            <th style="font-size:150%"">nom</th>
           
        </tr>
        <?php foreach ($membres as $mem) { ?>
            <tr>
                <td> <?php echo $mem['id_membre'] ?></td>
                <td> <?php echo $mem['nom'] ?></td>
                
            </tr>
        <?php }?>
        </table>
    </div>
</body>
</html>
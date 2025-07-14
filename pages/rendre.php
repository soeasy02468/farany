<?php
    include('../inc/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Rendre</title>
</head>
<body>
    <h2>ETAT DE L'OBJET </h2>
    <div class="mb-6">
        <form action="traitement_rendre.php">
        <select name="etat" class="form-control" required>
            <option value="ok">ok</option>
            <option value="abime">Abime</option>
        </select>
        <input type="submit" value="rendre">
        </form>
    </div>
</body>
</html>
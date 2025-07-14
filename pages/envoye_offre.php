<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <title>Envoyer une offre</title>
</head>
<body>

  <div class="container py-5">
    <h2 class="mb-4">Envoyer une offre</h2>
    <form action="traitement_upload.php" method="post" enctype="multipart/form-data">
      
      <div class="mb-3">
        <label for="nom_objet" class="form-label">Nom de l'objet</label>
        <input type="text" class="form-control" id="nom_objet" name="nom_objet" placeholder="Nom objet" required>
      </div>
      
      <div class="mb-3">
        <label for="categorie" class="form-label">Catégorie</label>
        <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Catégorie" required>
      </div>
      
      <div class="mb-3">
        <label for="fichier" class="form-label">Choisir un fichier</label>
        <input class="form-control" type="file" id="fichier" name="fichier" required>
      </div>
      
      <button type="submit" class="btn btn-primary">Uploader</button>
    </form>
  </div>

</body>
</html>

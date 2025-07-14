<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../pages/mety.php">OBJET_TROC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="../pages/mety.php">Objets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/envoye_offre.php">Ajouter un objet</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/mes_umprunt.php">Mes emprunts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/membres.php">Membres</a>
        </li> 
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['idmembre'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="profil.php">Mon Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/deconnection.php">Déconnexion</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="connexion.php">Connexion</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

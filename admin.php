<?php

include_once 'connxion_db.php';
session_start();

// verification 
if(empty($_SESSION['nom']) &&  $_SESSION['num_etudiant']!=1)
header('location:login.php');

$num=$_SESSION['num_etudiant'];

?>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des etudiants</title>
    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<nav class="navbar navbar-dark bg-dark fixed-top " aria-label="First navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Gestion des etudiants</a>
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbarsExample01">
        <ul class="navbar-nav me-auto mb-2">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admin.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="insertion_edt.php">Mise à jours des EDT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="insertion_annonce.php">Mise à jours des annonces</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="liste_etudiant.php">Liste des inscrits par niveau, des notes, des classements des etudiants </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="parametre_admin.php">Paramètres</a>
          </li>
        </ul>
        <form id="error" action="affichage_inscrits.php" method="post">
        <?php echo $_SESSION['alert']?>
          <input class="form-control" type="text" name="recherche" placeholder="Rechercher le nom ou le prenom d'un etudiant" aria-label="Search">
          <button class="btn btn-secondary mt-1" type="submit" name="rch">Rechercher</button>
        </form>
        <a href="deconnexion.php" class="btn btn-secondary mt-2">Deconnexion</a>
      </div>
    </div>
  </nav>

  
<div class="mt-5">
  <div class="cover-container d-flex w-100 h-50 p-3 mx-auto flex-column d-flex h-80 text-center">
  <main class="px-3 mt-5 justify-content-center align-items-center">
  <?php
    // Requête pour récupérer les informations des étudiants
    $sql = "SELECT num_etudiant, nom, image, image_type FROM etudiant WHERE num_etudiant='$num'";
    $result = mysqli_query($db, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['image']) {
                echo '<img src="data:' . $row['image_type'] . ';base64,' . base64_encode($row['image']) . '" class="bd-placeholder-img rounded-circle mt-2" width="140" height="140" />';
            } else {
                echo 'Pas d\'image';
            }
        }
    } else {
        echo 'Erreur lors de la récupération des données: ' . mysqli_error($db);
    }
  ?>

  <h1 class="mt-5 mb-4">BIENVENUE</h1>
    <p class="lead">Cette page est reservé seulement pour vous <?php echo $_SESSION['prenom'] ?>.</p>
    <p class="lead">
      <a href="liste_etudiant.php" class="btn btn-lg btn-secondary fw-bold border-white bg-black mt-5">Continue</a>
    </p>
  </main>
</div>
</div>

<script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
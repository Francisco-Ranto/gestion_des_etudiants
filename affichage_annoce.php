<?php
include_once 'connxion_db.php';

// verification des utilisateur
if(empty($_SESSION['nom']))
header('location:login.php');

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
      <a class="navbar-brand" href="#">ETUDIANT</a>
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbarsExample01">
        <ul class="navbar-nav me-auto mb-2">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="user.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="affichage_annoce.php">Les annonces</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="affichage_edt.php">Emploi du temps</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="affichage_note.php">Mes notes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="parametre_user.php">Paramètres</a>
          </li>
        </ul>        
        <a href="deconnexion.php" class="btn btn-secondary mt-2">Deconnecté</a>
      </div>
    </div>
</nav>


<div class="container px-4 py-5 mt-5" id="custom-cards">
    <h2 class="pb-2 border-bottom text-center">Liste des annonces</h2>

    <?php
      $niveau=$_SESSION['niveau'];
      $sql="SELECT * FROM annonce WHERE niveau='$niveau' OR niveau='Tous le niveau' ORDER BY date DESC";
      $inscrits= mysqli_query($db,$sql);
      while ($res=mysqli_fetch_array($inscrits)) {
    ?>

    <div class="row row-cols-1 align-items-stretch text-center g-4 py-5">
      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
            <h3 class=" mt-4 mb-5 lh-1 fw-bold text-center"><?php echo $res['description'];?></h3>
            <ul class="d-flex list-unstyled mt-2">
              <li class="col-md-8">
                
              </li>
              <li class="col-md-4 col-6">
                <small><?php echo $res['date'];?></small>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <?php
            }?>
  </div>
  <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
  </body>
  </html>
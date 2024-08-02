<?php
include_once 'connxion_db.php';

// verification si n'est pas admin
if(empty($_SESSION['nom']) &&  $_SESSION['num_etudiant']!=1)
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
      <a class="navbar-brand" href="#">Gestion des etudiants</a>
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbarsExample01">
        <ul class="navbar-nav me-auto mb-2">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="admin.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="insertion_edt.php">Mise à jours des EDT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="insertion_annonce.php">Mise à jours des annonces</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="liste_etudiant.php">Liste des inscrits par niveau, des notes, des classements des etudiants </a>
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

  <form method="post" action="affichage_inscrits.php" class="mt-5">
    
    <div class="pt-5">
      <h1 class="text-center">Liste des etudiants</h1>
      <?php if(isset($_GET['error1'])){ ?>
                        <h4 class="fw-bold mb-2 mt-5 text-center text-uppercase text-danger"><?php echo $_GET['error1']?></h4>
                    <?php } ?>
      <div class="bd-example d-flex justify-content-center align-items-center">
            
            <div class="m-5">
              <label for="niveau" class="form-label ">Niveau</label>
              <select name="niveau" class="form-select form-select-sm" aria-label=".form-select-sm مثال">
                <option selected="">Niveau</option>
                <option valueL="L1">L1</option>
                <option value="L2">L2</option>
                <option value="L3">L3</option>
                <option value="M1">M1</option>
                <option value="M2">M2</option>
              </select>
            </div>
           
        </div>
    </div>

      <div class="bd-example d-flex justify-content-center align-items-center">
      <div class="m-5">
        <button class="btn btn-outline-dark" type="submit" name="inscrits">Les inscrits</button>
      </div> 
      <div class="m-5">
        <button class="btn btn-outline-dark" type="submit" name="notes">Les notes</button>
      </div> 
      <div class="m-5">
        <button class="btn btn-outline-dark" type="submit" name="classement">Les classements</button>
      </div>  
    </div>

</form> 

  <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
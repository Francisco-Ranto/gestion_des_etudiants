<?php
include_once 'connxion_db.php';

// verification des utilisateur
if(empty($_SESSION['nom']))
header('location:login.php');

$num=$_SESSION['num_etudiant'];
$niveau=$_SESSION['niveau'];

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
            <a class="nav-link" href="affichage_annoce.php">Les annonces</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="affichage_edt.php">Emploi du temps</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="affichage_note.php">Mes notes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="parametre_user.php">Paramètres</a>
          </li>
        </ul>        
        <a href="deconnexion.php" class="btn btn-secondary mt-2">Deconnecté</a>
      </div>
    </div>
</nav>

  

<div  id="affichage" class=" table-responsive p-5">
  <div class="">  
  <h1 class="text-center mt-5"><span class="stylesheet"><?php echo $_SESSION['nom']; ?> <?php echo $_SESSION['prenom']; ?></span>, vos notes:</h1>
  </div>    
  <table class="table table-striped table-sm mt-5">
        <thead>
          <tr>
            <th scope="col">Matière</th>
            <th scope="col">Note</th>
          </tr>
        </thead>
        <tbody>
          <?php
                $sql="SELECT * FROM note WHERE num_etudiant='$num' ORDER BY note DESC";
                $inscrits= mysqli_query($db,$sql);
                while ($res=mysqli_fetch_array($inscrits)) {
                ?><tr>
                  <td><?php echo $res['matiere'];?></td>
                  <td><?php echo $res['note'];?></td>
                </tr>
                <?php
            }?>
        </tbody>
      </table>
</div>
  <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
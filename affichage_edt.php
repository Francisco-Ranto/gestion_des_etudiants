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
            <a class="nav-link" href="affichage_annoce.php">Les annonces</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="affichage_edt.php">Emploi du temps</a>
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

  
<div  id="affichage" class=" table-responsive p-5 mt-5">
  <div class="bd-example mt-5">
  <?php
        $niveau=$_SESSION['niveau'];
        $sql="SELECT * FROM edt WHERE niveau='$niveau' ORDER BY id_edt desc limit 1";
        $inscrits= mysqli_query($db,$sql);
        while ($res=mysqli_fetch_array($inscrits)) {
    ?>
    <div class="">  
      <h4 class="text-center mb-5">EMPLOIE DU TEMPS</h4>
        <div class="bd-example d-flex m-3">
          <div class="col-md-8">
            <h6>SEMAINE:    <?php echo $res['semaine'];?></h6>
          </div>  
          <div class="col-md-4">
              <h6>NIVEAU:   <?php echo $res['niveau'];?></h6>
          </div>
        </div>
        <table class="table table-sm table-bordered mt-2 mb-4">
        <thead>
          <tr>
            <th scope="col">Heure</th>
            <th scope="col">Lundi</th>
            <th scope="col">Mardi</th>
            <th scope="col">Mercredi</th>
            <th scope="col">Jeudi</th>
            <th scope="col">Vendredi</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <th scope="row"><?php echo $res['heure1'];?></th>
            <td><?php echo $res['lundi1'];?></td>
            <td><?php echo $res['mardi1'];?></td>
            <td><?php echo $res['mercredi1'];?></td>
            <td><?php echo $res['jeudi1'];?></td>
            <td><?php echo $res['vendredi1'];?></td>
          </tr>
          
          <tr>
            <th scope="row"><?php echo $res['heure1'];?></th>
            <td><?php echo $res['lundi2'];?></td>
            <td><?php echo $res['mardi2'];?></td>
            <td><?php echo $res['mercredi2'];?></td>
            <td><?php echo $res['jeudi2'];?></td>
            <td><?php echo $res['vendredi2'];?></td>
          </tr>
          <tr>
            <th colspan="6" class="text-center">APRES-MIDI</th>
          </tr>
          <tr>
          <th scope="row"><?php echo $res['heure3'];?></th>
            <td><?php echo $res['lundi3'];?></td>
            <td><?php echo $res['mardi3'];?></td>
            <td><?php echo $res['mercredi3'];?></td>
            <td><?php echo $res['jeudi3'];?></td>
            <td><?php echo $res['vendredi3'];?></td>

          </tr>
          <tr>
          <th scope="row"><?php echo $res['heure4'];?></th>
            <td><?php echo $res['lundi4'];?></td>
            <td><?php echo $res['mardi4'];?></td>
            <td><?php echo $res['mercredi4'];?></td>
            <td><?php echo $res['jeudi4'];?></td>
            <td><?php echo $res['vendredi4'];?></td>

          </tr>
          </tbody>
        </table>
        <?php
            }?>
</div>

  <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
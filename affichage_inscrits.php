<?php 
include_once 'connxion_db.php';

// verificationn
if(empty($_SESSION['nom']) &&  $_SESSION['num_etudiant']!=1)
header('location:login.php');

// Des initiations
$alert='';
$sql='';
$effectif='';
$res='';
$titre='';
$modifier='';
$supprimer='';
$label_numero='';
$label_nom='';
$label_classement='';
$label_note='';
$label_prenom='';
$label_email='';
$label_niveau='';
$label_pwd='';
$label_matiere='';
$label_ajouter='';
$label_modifier='';
$label_supprimer='';

//affichage des recherches
if (isset($_POST['rch'])) {
  $recherche= $_POST["recherche"];
  $sql="SELECT * FROM etudiant WHERE nom LIKE '%$recherche%' OR prenom LIKE '%$recherche%'";
  $inscrits= mysqli_query($db,$sql);
  if (empty($recherche)) {
    $_SESSION['alert']='<p class="fw-bold mb-2 text-uppercase text-danger">Veiller remplir le champ</p>';
  }
  elseif (mysqli_num_rows($inscrits)==0) {
    $titre='<h1 class="text-center text-danger mb-5 mt-5">Auccun resultat</h1>';
  }
  else {
          $alert= '<h4 class="text-center mt-5 text-uppercase text-success">Resultat</h4>';
          $modifier='<button type="button" class="btn btn-success">Modifier</button>';
          $supprimer='<button type="button" class="btn btn-danger">Supprimer</button>';
          $titre='<h1 class="text-center mb-5 mt-5">Resultat du recherche</h1>';
          $label_numero='<th scope="col">Numero</th>';
          $label_nom='<th scope="col">Nom</th>';
          $label_prenom='<th scope="col">Prenom</th>';
          $label_email='<th scope="col">Email</th>';
          $label_niveau='<th scope="col">Niveau</th>';
          $label_pwd='<th scope="col">Mot de passe</th>';
          $label_modifier='<th scope="col">Modifier</th>';
          $label_supprimer='<th scope="col">Supprimer</th>';
      }
          
}

// Affichage des inscrits
if (isset($_POST['inscrits'])) {
    $niveau= $_POST["niveau"];

    if ($niveau=='Niveau') {
        header('location: liste_etudiant.php?error1=Veiller entré le niveau ');
        
    }
    else {

            $sql="SELECT * FROM etudiant WHERE niveau='$niveau'";
            $sql1="SELECT COUNT(nom) as effectif FROM etudiant WHERE niveau='$niveau'";
            $inscrits= mysqli_query($db,$sql);
            $inscrits1= mysqli_query($db,$sql1);
            if (mysqli_num_rows($inscrits)==0) {
              header('location: liste_etudiant.php?error1=Auccun resultat ');            }
            else {
            $effectif='<h3 class="text-center">Effectif:<?php echo $total;?></h3>';
            $alert= '<h4 class="text-center mt-5 text-uppercase text-success">Resultat</h4>';
            $modifier='<button type="button" class="btn btn-success">Modifier</button>';
            $supprimer='<button type="button" class="btn btn-danger">Supprimer</button>';
            $titre='<h1 class="text-center mb-5 mt-5">Resultat des inscrits</h1>';
            $label_numero='<th scope="col">Numero</th>';
            $label_nom='<th scope="col">Nom</th>';
            $label_prenom='<th scope="col">Prenom</th>';
            $label_email='<th scope="col">Email</th>';
            $label_niveau='<th scope="col">Niveau</th>';
            $label_ajouter='<th scope="col">Ajouter</th>';
            $label_modifier='<th scope="col">Modifier</th>';
            $label_supprimer='<th scope="col">Supprimer</th>';
            }
            
    }

}

// Affichage des notes
if (isset($_POST['notes'])) {
  $niveau= $_POST["niveau"];

  if ($niveau=='Niveau') {
      header('location: liste_etudiant.php?error1=Veiller entré le niveau ');
      
  }
  else {

          $sql="SELECT et.*, note.* FROM etudiant et, note WHERE note.num_etudiant=et.num_etudiant AND et.niveau='$niveau' ORDER BY et.num_etudiant , note.matiere ASC";
          $inscrits= mysqli_query($db,$sql);
          if (mysqli_num_rows($inscrits)==0) {
            header('location: liste_etudiant.php?error1=Auccun resultat ');            }
          else {
          $alert= '<h4 class="text-center mt-5 text-uppercase text-success">Resultat</h4>';
          $titre='<h1 class="text-center mb-5 mt-5">Resultat des notes</h1>';
          $label_numero='<th scope="col">Numero</th>';
          $label_note='<th scope="col">Note</th>';
          $label_nom='<th scope="col">Nom</th>';
          $label_prenom='<th scope="col">Prenom</th>';
          $label_matiere='<th scope="col">Matière</th>';
          $label_niveau='<th scope="col">Niveau</th>';
          $label_modifier='<th scope="col">Modifier</th>';
          $label_supprimer='<th scope="col">Supprimer</th>';
          }
          
  }

}

// Affichage des classements
if (isset($_POST['classement'])) {
  $niveau= $_POST["niveau"];

  if ($niveau=='Niveau') {
      header('location: liste_etudiant.php?error1=Veiller entré le niveau ');
      
  }
  else {

          $sql="SELECT et.*, AVG(note)  as moyenne FROM etudiant et, note WHERE et.num_etudiant=note.num_etudiant AND et.niveau='$niveau' GROUP BY et.num_etudiant ORDER BY moyenne DESC";
          $inscrits= mysqli_query($db,$sql);
          if (mysqli_num_rows($inscrits)==0) {
            header('location: liste_etudiant.php?error1=Auccun resultat ');            }
          else {
          $alert= '<h4 class="text-center mt-5 text-uppercase text-success">Resultat</h4>';
          $titre='<h1 class="text-center mb-5 mt-5">Resultat des classements</h1>';
          $label_numero='<th scope="col">Numero</th>';
          $label_classement='<th scope="col">Classement</th>';
          $label_note='<th scope="col">Moyenne</th>';
          $label_nom='<th scope="col">Nom</th>';
          $label_prenom='<th scope="col">Prenom</th>';
          $label_niveau='<th scope="col">Niveau</th>';
          }
          
  }

}

// Insertion note

if (isset($_POST['insertion_note'])) {
    $num= $_POST["num"];
    $matiere= $_POST["matiere"];
    $note= $_POST["note"];
    $niveau= $_POST["niveau"];
    
    if (empty($matiere) || empty($note)) {
        $alert='<h4 class="text-center mt-5 text-uppercase text-danger">veiller remplir le champ</h4>';
        
    }
    else {
      $req="SELECT * FROM note WHERE num_etudiant='$num' AND matiere='$matiere'";
      $sql=mysqli_query($db,$req);
      $ver= mysqli_fetch_array($sql);
      if (!empty($ver['num_etudiant'])) {
        $alert='<h4 class="text-center mt-5 text-uppercase text-danger">Matière déja existé</h4>';
      }
      else {
        
        $req="INSERT INTO `note`(`num_etudiant`, `matiere`, `note`) VALUES ('$num','$matiere','$note')";
        $insertion= mysqli_query($db,$req);
        $alert= '<h4 class="text-center mt-5 text-uppercase text-success">Insertion a été effectué!!</h4>';
      }
    }

}

// Modification des notes
if (isset($_POST['modifier_note'])) {
  $id_note= $_POST["id_note"];
  $note= $_POST["note"];
    
  $req="UPDATE note SET note='$note' WHERE id_note='$id_note'";
  $insertion= mysqli_query($db,$req);
  $alert= '<h4 class="text-center mt-5 text-uppercase text-success">Modification a été effectué!!</h4>';
}


// Modification des etudiants
if (isset($_POST['modifier_etudiant'])) {
    $num_etu= $_POST["numero"];
    $num= $_POST["num"];
    $nom= $_POST["nom"];
    $prenom= $_POST["prenom"];
    $niveau= $_POST["niveau"];
    $email_etudiant= $_POST["email"];

    if (empty($num_etu) || empty($nom) || empty($prenom) || empty($email_etudiant)) {
        $alert='<h4 class="text-center mt-5 text-uppercase text-danger">veiller remplir le champ</h4>';
        
    }
    else {
      $req="SELECT * FROM etudiant WHERE num_etudiant<>$num AND num_etudiant=$num_etu";
      $sql=mysqli_query($db,$req);
      $ver= mysqli_fetch_array($sql);
      if (!empty($ver['num_etudiant'])) {
        $alert='<h4 class="text-center mt-5 text-uppercase text-danger">Numero ou email déja existé</h4>';
      }
      else {
        
        $req="UPDATE etudiant SET num_etudiant='$num_etu', nom='$nom', prenom='$prenom', niveau='$niveau', email='$email_etudiant' WHERE num_etudiant='$num'";
        $insertion= mysqli_query($db,$req);
        $alert= '<h4 class="text-center mt-5 text-uppercase text-success">Modification a été effectué!!</h4>';
      }
    }

}

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
  
  <div  id="affichage" class="table-responsive mt-5  p-5">  
      <?php echo $titre;?>
      <a href="liste_etudiant.php"><button class="btn btn-outline-dark">Retour</button></a>
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <?php echo $label_classement;?>
            <?php echo $label_numero;?>
            <?php echo $label_nom;?>
            <?php echo $label_prenom;?>
            <?php echo $label_niveau;?>
            <?php echo $label_matiere;?>
            <?php echo $label_email;?>
            <?php echo $label_note;?>
            <?php echo $label_ajouter;?>
            <?php echo $label_modifier;?>
            <?php echo $label_supprimer;?>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($titre=='<h1 class="text-center mb-5 mt-5">Resultat des inscrits</h1>')
          {
            
            $i=0;
              while ($res=mysqli_fetch_array($inscrits)) {
                $res1=mysqli_fetch_array($inscrits1);
                ?><tr>
                  <td><?php echo $res['num_etudiant'];?></td>
                  <td><?php echo $res['nom'];?></td>
                  <td><?php echo $res['prenom'];?></td>
                  <td><?php echo $res['niveau'];?></td>
                  <td><?php echo $res['email'];?></td>
                  <td><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#insertion<?php echo $res['num_etudiant']; ?>">Ajouter une note</button></td>
                  <td><button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modification<?php echo $res['num_etudiant']; ?>">Modifier</button></td>
                  <td><a href="supprimer.php?num_etudiant=<?php echo $res['num_etudiant'];?>" class="btn btn-danger" onclick="confirmDeletion(event)">Supprimer</a></td>
                </tr>

                
                    <!-- Modal Insertion -->
                    <div class="modal" id="insertion<?php echo $res['num_etudiant']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="">
                              <input type="hidden" name="num" value="<?php echo $res['num_etudiant']; ?>">
                              <input type="hidden" name="niveau" value="<?php echo $res['niveau']; ?>">
                                <h1 class="text-center mt-3 mb-4">Ajouter un note</h1>
                                <div class="bd-example">
                                  <div class="m-2" >
                                    <label for="matiere" class="form-label ">Matière</label>
                                    <input name="matiere" class="form-control form-control-sm" type="text" aria-label=".form-control-sm مثال" required>
                                  </div>
                                  <div class="m-2">
                                    <label for="note" class="form-label ">Note</label> 
                                    <input name="note" class="form-control form-control-sm" type="number" step="any" aria-label=".form-control-sm مثال" required>
                                  </div>
                                  
                            <div class="bd-example d-flex justify-content-center align-items-center">
                            <div class="m-5">
                              <button class="btn btn-outline-dark" type="button" data-bs-dismiss="modal">Annuler</button>
                            </div>  
                            <div class="m-5">
                              <button class="btn btn-outline-dark" type="submit" name="insertion_note">Inserer</button>
                            </div>
                            </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                </div>
                    <!-- Modal Modification -->
                <div class="modal" id="modification<?php echo $res['num_etudiant']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="">
                              <input type="hidden" name="num" value="<?php echo $res['num_etudiant']; ?>">
                                <h1 class="text-center mt-3 mb-4">Modification d'un etudiant</h1>
                                <div class="bd-example">
                                  <div class="m-2" >
                                    <label for="Numero" class="form-label ">Numero</label>
                                    <input name="numero" class="form-control form-control-sm" type="text" value="<?php echo $res['num_etudiant'];?>" aria-label=".form-control-sm مثال" required>
                                  </div>
                                  <div class="m-2">
                                    <label for="name" class="form-label ">Nom</label> 
                                    <input name="nom" class="form-control form-control-sm" type="text" value="<?php echo $res['nom'];?>" aria-label=".form-control-sm مثال" required>
                                  </div>
                                  <div class="m-2"> 
                                    <label for="lastname" class="form-label ">Prenom</label>
                                    <input name="prenom" class="form-control form-control-sm" type="text" value="<?php echo $res['prenom'];?>" aria-label=".form-control-sm مثال" required>
                                  </div>
                                  <div class="m-2">
                                    <label for="niveau" class="form-label ">Niveau</label>
                                    <select name="niveau" class="form-select form-select-sm" aria-label=".form-select-sm مثال">
                                      <option selected=""><?php echo $res['niveau'];?></option>
                                      <option valueL="L1">L1</option>
                                      <option value="L2">L2</option>
                                      <option value="L3">L3</option>
                                      <option value="M1">M1</option>
                                      <option value="M2">M2</option>
                                    </select>
                                  </div>
                                  <div class="m-2"> 
                                    <label for="email_etudiant" class="form-label ">Email address</label>
                                    <input name="email" type="email" class="form-control" id="email" value="<?php echo $res['email'];?>" required>
                                  </div>
                              </div>
                              
                            <div class="bd-example d-flex justify-content-center align-items-center">
                            <div class="m-5">
                              <button class="btn btn-outline-dark" type="button" data-bs-dismiss="modal">Annuler</button>
                            </div>  
                            <div class="m-5">
                              <button class="btn btn-outline-dark" type="submit" name="modifier_etudiant">Modifier</button>
                              </div>
                            </div>
                          </div>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>


                <?php
                if ($i==0) {
                ?>
                  <h3 class="text-center">Effectif: <?php echo $res1['effectif'];?></h3>
                <?php $i++;}?>
                <?php
                
              }
            }
            
          elseif ($titre=='<h1 class="text-center mb-5 mt-5">Resultat du recherche</h1>')
          {
            
              while ($res=mysqli_fetch_array($inscrits)) {
                ?><tr>
                  <td><?php echo $res['num_etudiant'];?></td>
                  <td><?php echo $res['nom'];?></td>
                  <td><?php echo $res['prenom'];?></td>
                  <td><?php echo $res['niveau'];?></td>
                  <td><?php echo $res['email'];?></td>
                  <td><button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modification<?php echo $res['num_etudiant']; ?>">Modifier</button></td>
                  <td><a href="supprimer.php?num_etudiant=<?php echo $res['num_etudiant'];?>" class="btn btn-danger" onclick="confirmDeletion(event)">Supprimer</a></td>
                </tr>

                    <!-- Modal Modification -->
                    <div class="modal" id="modification<?php echo $res['num_etudiant']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="">
                              <input type="hidden" name="num" value="<?php echo $res['num_etudiant']; ?>">
                                <h1 class="text-center mt-3 mb-4">Modification d'un etudiant</h1>
                                <div class="bd-example">
                                  <div class="m-2" >
                                    <label for="Numero" class="form-label ">Numero</label>
                                    <input name="numero" class="form-control form-control-sm" type="text" value="<?php echo $res['num_etudiant'];?>" aria-label=".form-control-sm مثال" required>
                                  </div>
                                  <div class="m-2">
                                    <label for="name" class="form-label ">Nom</label> 
                                    <input name="nom" class="form-control form-control-sm" type="text" value="<?php echo $res['nom'];?>" aria-label=".form-control-sm مثال" required>
                                  </div>
                                  <div class="m-2"> 
                                    <label for="lastname" class="form-label ">Prenom</label>
                                    <input name="prenom" class="form-control form-control-sm" type="text" value="<?php echo $res['prenom'];?>" aria-label=".form-control-sm مثال" required>
                                  </div>
                                  <div class="m-2">
                                    <label for="niveau" class="form-label ">Niveau</label>
                                    <select name="niveau" class="form-select form-select-sm" aria-label=".form-select-sm مثال">
                                      <option selected=""><?php echo $res['niveau'];?></option>
                                      <option valueL="L1">L1</option>
                                      <option value="L2">L2</option>
                                      <option value="L3">L3</option>
                                      <option value="M1">M1</option>
                                      <option value="M2">M2</option>
                                    </select>
                                  </div>
                                  <div class="m-2"> 
                                    <label for="email_etudiant" class="form-label ">Email address</label>
                                    <input name="email" type="email" class="form-control" id="email" value="<?php echo $res['email'];?>" required>
                                  </div>
                              </div>
                              
                            <div class="bd-example d-flex justify-content-center align-items-center">
                            <div class="m-5">
                              <button class="btn btn-outline-dark" type="button" data-bs-dismiss="modal">Annuler</button>
                            </div>  
                            <div class="m-5">
                              <button class="btn btn-outline-dark" type="submit" name="modifier_etudiant">Modifier</button>
                              </div>
                            </div>
                          </div>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>

                <?php
                
              }
            }
            elseif ($titre=='<h1 class="text-center mb-5 mt-5">Resultat des notes</h1>') {
              while ($res=mysqli_fetch_array($inscrits)) {
                ?><tr>
                  <td><?php echo $res['num_etudiant'];?></td>
                  <td><?php echo $res['nom'];?></td>
                  <td><?php echo $res['prenom'];?></td>
                  <td><?php echo $res['niveau'];?></td>
                  <td><?php echo $res['matiere'];?></td>
                  <td><?php echo $res['note'];?></td>
                  <td><button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modification<?php echo $res['id_note']; ?>">Modifier</button></td>
                  <td><a href="supprimer.php?id_note=<?php echo $res['id_note'];?>" class="btn btn-danger" onclick="confirmDeletion(event)">Supprimer</a></td>
                
                <!-- Modal Modification -->
                <div class="modal" id="modification<?php echo $res['id_note']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <form method="post" action="">
                              <input type="hidden" name="id_note" value="<?php echo $res['id_note']; ?>">
                              <input type="hidden" name="niveau" value="<?php echo $res['niveau']; ?>">
                                <h1 class="text-center mt-3 mb-4">Modifier un note</h1>
                                <div class="bd-example">
                                  <div class="m-2" >
                                    <label for="matiere" class="form-label ">Matière</label>
                                    <input name="matiere" class="form-control form-control-sm" type="text" value="<?php echo $res['matiere']; ?>" aria-label=".form-control-sm مثال" readonly>
                                  </div>
                                  <div class="m-2">
                                    <label for="note" class="form-label ">Note</label> 
                                    <input name="note" class="form-control form-control-sm" type="number" step="any" value="<?php echo $res['note']; ?>" aria-label=".form-control-sm مثال" required>
                                  </div>
                              
                            <div class="bd-example d-flex justify-content-center align-items-center">
                            <div class="m-5">
                              <button class="btn btn-outline-dark" type="button" data-bs-dismiss="modal">Annuler</button>
                            </div>  
                            <div class="m-5">
                              <button class="btn btn-outline-dark" type="submit" name="modifier_note">Modifier</button>
                              </div>
                            </div>
                          </div>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
                </tr>
                <?php
              }
            }
            
            elseif($titre=='<h1 class="text-center mb-5 mt-5">Resultat des classements</h1>'){
              $classement=1;
              while ($res=mysqli_fetch_array($inscrits)) {
                ?><tr>
                  <td><?php echo $classement;?></td>
                  <td><?php echo $res['num_etudiant'];?></td>
                  <td><?php echo $res['nom'];?></td>
                  <td><?php echo $res['prenom'];?></td>
                  <td><?php echo $res['niveau'];?></td>
                  <td><?php echo $res['moyenne'];?></td>
                </tr>
                <?php
                $classement++;
              }
            }
            ?>
        </tbody>
      </table>
</div> 


<script>
        function confirmDeletion(event) {
            if (!confirm("Etes-vous sûr de vouloir supprimer cet emploi du temps?")) {
                event.preventDefault();
            }
        }
</script>

<!-- Modal pour afficher les messages d'alerte -->
<div class="modal" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Message d'alerte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $alert; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
<script>
    // Afficher automatiquement le modal d'alerte si $alert n'est pas vide
    <?php if (!empty($alert)) { ?>
    var alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
    alertModal.show();
    <?php } ?>
</script>

</body>
</html>

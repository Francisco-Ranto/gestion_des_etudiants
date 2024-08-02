<?php

include_once 'connxion_db.php';

// Des initiations
$alert='';
$error='';
$numero= '';
$nom= '';
$prenom= '';
$niveau= '';
$email_etu= '';
$mtp= '';

if(isset($_GET['error'])){
  $error=$_GET['error'];
}

// Insertion des etudiants
if (isset($_POST['inserer_etu'])) {
    $numero= $_POST["numero"];
    $nom= $_POST["nom"];
    $prenom= $_POST["prenom"];
    $niveau= $_POST["niveau"];
    $email_etu= $_POST["email"];
    $mtp= $_POST["mtp"];

    if (empty($numero) || empty($nom) || $niveau=="Niveau" || empty($email_etu) || empty($mtp)) {
        
        $alert='<h4 class="text-center mt-5 text-uppercase text-danger">veiller remplir le champ</h4>';
        
    }
    else {
        $sql="SELECT * FROM etudiant WHERE num_etudiant='$numero' OR email='$email_etu'";
        $insertion= mysqli_query($db,$sql);
        $ver = mysqli_fetch_array($insertion);
        if (!empty($ver['nom'])) {
                    
          $error='';
          $alert='<h4 class="text-center mt-5 text-uppercase text-danger">Déjà inscrit</h4>';
        }
        else {
          
        $sql="INSERT INTO  etudiant VALUES ('$numero', '$nom', '$prenom', '$niveau', '$email_etu', '$mtp')";
        $insertion= mysqli_query($db,$sql);
        session_start();
        $_SESSION['nom']=$nom;
        $_SESSION['prenom']=$prenom;
        $_SESSION['email']=$email_etu;
        $_SESSION['num_etudiant']=$numero;
        $_SESSION['niveau']=$niveau;
        header('Location: user.php');
                
        $error='';
        $alert= '<h4 class="text-center mt-5 text-uppercase text-success">Insertion a été effectué</h4>';
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des Questionnaires</title>
    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-md-8 col-lg-6">
            <div class="card bg-white">
              <div class="card-body p-5">
                <form class="mb-3 mt-md-4" action="connxion_db.php" method="post">
                  <h2 class="fw-bold mb-5 text-uppercase ">Gestion de Questionnaires</h2>
                  <div class="mb-3">
                    <label for="email" class="form-label ">Adresse email</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com" required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label ">Mot de passe</label>
                    <input name="pwd" type="password" class="form-control" id="password" placeholder="*******" required>
                  </div>
                  <p class="small"><a class="text-primary" href="#">Mot de passe oublié?</a></p>
                  <div class="d-grid">
                    <button class="btn btn-outline-dark" type="submit">connexion</button>
                  </div>
                </form>
                <div>
                  <p class="mb-0  text-center">Pas encore dans base de donnée? <a href="" data-bs-toggle="modal" data-bs-target="#insertion" class="text-primary fw-bold">Inscrir</a></p>
                </div>
                <div class="bd-example text-center mt-4">
        
                        <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">جار التحميل...</span>
                        </div>
                        <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">جار التحميل...</span>
                        </div>
                        <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">جار التحميل...</span>
                        </div>
                        <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">جار التحميل...</span>
                        </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Modal Insertion -->
<div class="modal" id="insertion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
            <h1 class="text-center m-3">Inscription</h1>
            <div class="bd-example">
                  <div class="m-2" >
                    <label for="Numero" class="form-label ">Numero</label>
                    <input name="numero" class="form-control form-control-sm" type="text" placeholder="Entrer le numero" aria-label=".form-control-sm مثال" required>
                  </div>
                  <div class="m-2">
                    <label for="name" class="form-label ">Nom</label> 
                    <input name="nom" class="form-control form-control-sm" type="text" placeholder="Entrer le nom" aria-label=".form-control-sm مثال" required>
                  </div>
                  <div class="m-2"> 
                    <label for="lastname" class="form-label ">Prenom</label>
                    <input name="prenom" class="form-control form-control-sm" type="text" placeholder="Entrer le prenom" aria-label=".form-control-sm مثال">
                  </div>
                  <div class="m-2">
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
                  <div class="m-2"> 
                    <label for="email_etudiant" class="form-label ">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com" required>
                  </div>
                  <div class="m-2">                     
                    <label for="password" class="form-label ">Mot de passe</label>
                    <input name="mtp" type="password" class="form-control" id="password" placeholder="*******" required>
                  </div>
              </div>
              
            <div class="bd-example d-flex justify-content-center align-items-center">
            <div class="m-5">
              <button class="btn btn-outline-dark" type="button" data-bs-dismiss="modal">Annuler</button>
            </div>  
            <div class="m-5">
                <button class="btn btn-outline-dark" type="submit" name="inserer_etu">Inserer</button>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>

<?php if(isset($_GET['error'])){ ?>
  <p class="fw-bold mb-2 text-uppercase text-danger"><?php echo $_GET['error']?></p>
<?php } ?>

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
                <h4 class="text-center mt-5 text-uppercase text-danger"><?php echo $error ?></h4>
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
    <?php if (!empty($alert) || isset($_GET['error'])) { ?>
    var alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
    alertModal.show();
    <?php } ?>
</script>

</body>
</html>

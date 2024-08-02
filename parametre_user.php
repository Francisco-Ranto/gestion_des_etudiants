<?php
session_start();
include_once 'connxion_db.php';

// Vérification si l'utilisateur n'est pas connecté
if (empty($_SESSION['nom'])) {
    header('Location: login.php');
    exit;
}

$alert = '';

// Affichage des informations de l'étudiant
$numero = $_SESSION['num_etudiant'];
$sql = "SELECT * FROM etudiant WHERE num_etudiant = '$numero'";
$req = mysqli_query($db, $sql);
$res = mysqli_fetch_array($req);

// Modification des informations de l'étudiant
if (isset($_POST['modifier_etudiant'])) {
    $num = $_POST["num"];
    $pwd = $_POST["mdp"];
    $num_etu = $_POST["numero"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email_etudiant = $_POST["email_etudiant"];
    $image = $_FILES["image"]["tmp_name"];
    $image_type = $_FILES["image"]["type"];
    $image_data = $image ? file_get_contents($image) : null;
    $escaped_image_data = $image_data ? mysqli_real_escape_string($db, $image_data) : null;

    if (empty($num_etu) || empty($nom) || empty($prenom) || empty($email_etudiant)) {
        $alert = '<h4 class="text-center mt-5 text-uppercase text-danger">Veuillez remplir tous les champs</h4>';
    } else {
        $req = "SELECT * FROM etudiant WHERE num_etudiant <> $num AND num_etudiant = $num_etu";
        $sql = mysqli_query($db, $req);
        $ver = mysqli_fetch_array($sql);
        if (!empty($ver['num_etudiant'])) {
            $alert = '<h4 class="text-center mt-5 text-uppercase text-danger">Numéro ou email déjà existant</h4>';
        } else {
            $update_query = "UPDATE etudiant SET num_etudiant = '$num_etu', nom = '$nom', prenom = '$prenom', email = '$email_etudiant', pwd = '$pwd'";
            if ($escaped_image_data) {
                $update_query .= ", image = '$escaped_image_data', image_type = '$image_type'";
            }
            $update_query .= " WHERE num_etudiant = '$num'";
            $insertion = mysqli_query($db, $update_query);
            if ($insertion) {
                $alert = '<h4 class="text-center mt-5 text-uppercase text-success">Modification effectuée avec succès !</h4>';
            } else {
                $alert = '<h4 class="text-center mt-5 text-uppercase text-danger">Erreur lors de la modification</h4>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des Questionnaires</title>
    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top" aria-label="First navbar example">
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
                    <a class="nav-link" href="affichage_note.php">Mes notes</li>
                <li class="nav-item">
                    <a class="nav-link active" href="parametre_user.php">Paramètres</a>
                </li>
            </ul>
            <a href="deconnexion.php" class="btn btn-secondary mt-2">Déconnecter</a>
        </div>
    </div>
</nav>

<div class="vh-100 mt-5 pt-5 d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card bg-white">
                    <div class="card-body p-5">
                        <form method="post" action="" enctype="multipart/form-data">
                            <input type="hidden" name="num" value="<?php echo $res['num_etudiant']; ?>">
                            <h1 class="text-center mt-3 mb-4">Modification d'un étudiant</h1>
                            <div class="bd-example">
                                <div class="m-2">
                                    <label for="numero" class="form-label">Numéro</label>
                                    <input name="numero" class="form-control form-control-sm" type="text" value="<?php echo $res['num_etudiant'];?>" aria-label=".form-control-sm مثال" required>
                                </div>
                                 <div class="m-2">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input name="nom" class="form-control form-control-sm" type="text" value="<?php echo $res['nom'];?>" aria-label=".form-control-sm مثال" required>
                                </div>
                                <div class="m-2">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input name="prenom" class="form-control form-control-sm" type="text" value="<?php echo $res['prenom'];?>" aria-label=".form-control-sm مثال" required>
                                </div>
                                <div class="m-2">
                                    <label for="email_etudiant" class="form-label">Email</label>
                                    <input name="email_etudiant" type="email" class="form-control" id="email" value="<?php echo $res['email'];?>" required>
                                </div>
                                <div class="m-2">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input name="mdp" type="password" class="form-control" id="password" placeholder="*******" value="<?php echo $res['pwd'];?>" required>
                                </div>
                                <div class="m-2">
                                    <label class="form-label" for="customFile">Image</label>
                                    <input type="file" class="form-control" id="customFile" name="image">
                                </div>
                            </div>
                            <div class="bd-example d-flex justify-content-center align-items-center">
                                <div class="m-5">
                                    <button class="btn btn-outline-dark" type="button">Annuler</button>
                                </div>
                                <div class="m-5">
                                    <button class="btn btn-outline-dark" type="submit" name="modifier_etudiant">Modifier</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

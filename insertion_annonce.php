<?php
include_once 'connxion_db.php';

// Vérification si l'utilisateur n'est pas admin
if (empty($_SESSION['nom']) || $_SESSION['num_etudiant'] != 1) {
    header('location:login.php');
    exit();
}

$alert = '';

// Insertion des données annonces
if (isset($_POST['inserer_annonce'])) {
    $date = $_POST["date"];
    $niveau = $_POST["niveau"];
    $description = $_POST["description"];

    if (empty($niveau) || empty($description)) {
        $alert = '<h4 class="text-center mt-5 text-uppercase text-danger">Veuillez remplir le champ !!</h4>';
    } else {
        $req = "INSERT INTO annonce(`description`, `niveau`) VALUES ('$description', '$niveau')";
        $insertion = mysqli_query($db, $req);
        $alert = '<h4 class="text-center mt-5 text-uppercase text-success">Insertion a été effectuée !!</h4>';
    }
}

// Mise à jour des annonces
if (isset($_POST['modifier_annonce'])) {
    $id_annonce = $_POST["id_annonce"];
    $niveau = $_POST["niveau"];
    $description = $_POST["description"];

    if (empty($niveau) || empty($description)) {
        $alert = '<h4 class="text-center mt-5 text-uppercase text-danger">Veuillez remplir le champ !!</h4>';
    } else {
        $req = "UPDATE annonce SET description='$description', niveau='$niveau' WHERE id_annonce='$id_annonce'";
        $modification = mysqli_query($db, $req);
        $alert = '<h4 class="text-center mt-5 text-uppercase text-success">Modification a été effectuée !!</h4>';
    }
}

// Récupérer les informations de l'annonce à modifier
$modAnnonce = null;
if (isset($_GET['id_annonce'])) {
    $id_annonce = $_GET['id_annonce'];
    $sql = "SELECT * FROM annonce WHERE id_annonce='$id_annonce'";
    $result = mysqli_query($db, $sql);
    $modAnnonce = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des étudiants</title>
    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top" aria-label="First navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Gestion des étudiants</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExample01">
            <ul class="navbar-nav me-auto mb-2">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="admin.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="insertion_edt.php">Mise à jour des EDT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="insertion_annonce.php">Mise à jour des annonces</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="liste_etudiant.php">Liste des inscrits par niveau, des notes, des classements des étudiants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="parametre_admin.php">Paramètres</a>
                </li>
            </ul>
            <form id="error" action="affichage_inscrits.php" method="post">
                <?php echo $_SESSION['alert'] ?>
                <input class="form-control" type="text" name="recherche" placeholder="Rechercher le nom ou le prénom d'un étudiant" aria-label="Search">
                <button class="btn btn-secondary mt-1" type="submit" name="rch">Rechercher</button>
            </form>
            <a href="deconnexion.php" class="btn btn-secondary mt-2">Déconnexion</a>
        </div>
    </div>
</nav>

<div id="affichage" class="table-responsive p-5">
    <div class="">
        <h1 class="text-center mt-5">Liste des annonces</h1>
        <button class="btn btn-outline-dark m-4" type="button" data-bs-toggle="modal" data-bs-target="#insertion">Ajouter une annonce</button>
    </div>
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Niveau</th>
            <th scope="col">Description</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM annonce ORDER BY date DESC";
        $inscrits = mysqli_query($db, $sql);
        while ($res = mysqli_fetch_array($inscrits)) {
            ?>
            <tr>
                <td><?php echo $res['date']; ?></td>
                <td><?php echo $res['niveau']; ?></td>
                <td><?php echo $res['description']; ?></td>
                <td>
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modification<?php echo $res['id_annonce']; ?>">Modifier</button>
                </td>
                <td>
                    <a href="supprimer.php?id_annonce=<?php echo $res['id_annonce']; ?>" class="btn btn-danger" onclick="return confirm('Etes-vous sûr de vouloir supprimer cette annonce ?')">Supprimer</a>
                </td>
            </tr>
            <!-- Modal Modification -->
            <div class="modal" id="modification<?php echo $res['id_annonce']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="">
                            <input type="hidden" name="id_annonce" value="<?php echo $res['id_annonce']; ?>">
                            <h1 class="text-center mt-3 mb-5">Modification des annonces</h1>
                            <div class="bd-example">
                                <div class="m-3">
                                    <label for="niveau" class="form-label">Niveau</label>
                                    <select name="niveau" class="form-select form-select-sm" aria-label=".form-select-sm exemple">
                                        <option value="L1" <?php if ($res['niveau'] == 'L1') echo 'selected'; ?>>L1</option>
                                        <option value="L2" <?php if ($res['niveau'] == 'L2') echo 'selected'; ?>>L2</option>
                                        <option value="L3" <?php if ($res['niveau'] == 'L3') echo 'selected'; ?>>L3</option>
                                        <option value="M1" <?php if ($res['niveau'] == 'M1') echo 'selected'; ?>>M1</option>
                                        <option value="M2" <?php if ($res['niveau'] == 'M2') echo 'selected'; ?>>M2</option>
                                        <option value="Tous le niveau" <?php if ($res['niveau'] == 'Tous le niveau') echo 'selected'; ?>>Tous le niveau</option>
                                    </select>
                                </div>
                                <div class="m-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control form-control-sm" data-type="CHAR" rows="5" placeholder="Entrer la description" required><?php echo $res['description']; ?></textarea>
                                </div>
                            </div>
                            <div class="bd-example d-flex justify-content-center align-items-center">
                                <div class="m-5">
                                    <button class="btn btn-outline-dark" type="button" data-bs-dismiss="modal">Annuler</button>
                                </div>
                                <div class="m-5">
                                    <button class="btn btn-outline-dark" type="submit" name="modifier_annonce">Modifier</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        } ?>
        </tbody>
    </table>
</div>

<!-- Modal Insertion -->
<div class="modal" id="insertion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <h1 class="text-center mt-3 mb-5">Insertion des annonces</h1>
                <div class="bd-example">
                    <div class="m-3">
                        <label for="niveau" class="form-label">Niveau</label>
                        <select name="niveau" class="form-select form-select-sm" aria-label=".form-select-sm exemple">
                            <option selected="">Niveau</option>
                            <option value="L1">L1</option>
                            <option value="L2">L2</option>
                            <option value="L3">L3</option>
                            <option value="M1">M1</option>
                            <option value="M2">M2</option>
                            <option value="Tous le niveau">Tous le niveau</option>
                        </select>
                    </div>
                    <div class="m-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control form-control-sm" data-type="CHAR" rows="5" placeholder="Entrer la description" required></textarea>
                    </div>
                </div>
                <div class="bd-example d-flex justify-content-center align-items-center">
                    <div class="m-5">
                        <button class="btn btn-outline-dark" type="button" data-bs-dismiss="modal">Annuler</button>
                    </div>
                    <div class="m-5">
                        <button class="btn btn-outline-dark" type="submit" name="inserer_annonce">Insérer</button>
                    </div>
                </div>
            </form>
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

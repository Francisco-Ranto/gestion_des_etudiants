<?php
include_once 'connxion_db.php';

// verification si n'est pas admin
if(empty($_SESSION['nom']) &&  $_SESSION['num_etudiant'] != 1) {
    header('location:login.php');
    exit();
}

$alert = '';

// Insertion des données edt
if (isset($_POST['inserer_edt'])) {
    $heure1 = $_POST["heure1"];
    $heure2 = $_POST["heure2"];
    $heure3 = $_POST["heure3"];
    $heure4 = $_POST["heure4"];
    $niveau = $_POST["niveau"];
    $semaine = $_POST["semaine"];
    $lundi1 = $_POST["lundi1"];
    $lundi2 = $_POST["lundi2"];
    $lundi3 = $_POST["lundi3"];
    $lundi4 = $_POST["lundi4"];
    $mardi1 = $_POST["mardi1"];
    $mardi2 = $_POST["mardi2"];
    $mardi3 = $_POST["mardi3"];
    $mardi4 = $_POST["mardi4"];
    $mercredi1 = $_POST["mercredi1"];
    $mercredi2 = $_POST["mercredi2"];
    $mercredi3 = $_POST["mercredi3"];
    $mercredi4 = $_POST["mercredi4"];
    $jeudi1 = $_POST["jeudi1"];
    $jeudi2 = $_POST["jeudi2"];
    $jeudi3 = $_POST["jeudi3"];
    $jeudi4 = $_POST["jeudi4"];
    $vendredi1 = $_POST["vendredi1"];
    $vendredi2 = $_POST["vendredi2"];
    $vendredi3 = $_POST["vendredi3"];
    $vendredi4 = $_POST["vendredi4"];

    if (empty($semaine) || empty($niveau) || empty($heure1) || empty($heure2) || empty($heure3) || empty($heure4)) {
        $alert = '<h4 class="text-center mt-5 text-uppercase text-danger">Veuillez remplir tous les champs!</h4>';
    } else {
        $req = "INSERT INTO edt(`niveau`, `semaine`, `heure1`, `heure2`, `heure3`, `heure4`,
         `lundi1`, `lundi2`, `lundi3`, `lundi4`,
         `mardi1`, `mardi2`, `mardi3`, `mardi4`,
         `mercredi1`, `mercredi2`, `mercredi3`, `mercredi4`,
         `jeudi1`, `jeudi2`, `jeudi3`, `jeudi4`,
         `vendredi1`, `vendredi2`, `vendredi3`, `vendredi4`) 
         VALUES ('$niveau', '$semaine', '$heure1', '$heure2', '$heure3', '$heure4',
         '$lundi1','$lundi2','$lundi3','$lundi4',
         '$mardi1','$mardi2','$mardi3','$mardi4',
         '$mercredi1','$mercredi2','$mercredi3','$mercredi4',
         '$jeudi1','$jeudi2','$jeudi3','$jeudi4',
         '$vendredi1','$vendredi2','$vendredi3','$vendredi4'
         ) ";
        $insertion = mysqli_query($db, $req);
        if ($insertion) {
            $alert = '<h4 class="text-center mt-5 text-uppercase text-success">Insertion a été effectuée avec succès!</h4>';
        } else {
            $alert = '<h4 class="text-center mt-5 text-uppercase text-danger">Erreur lors de l\'insertion!</h4>';
        }
    }
}

// Mise à jours edt
if (isset($_POST['modifier_edt'])) {
    $id_edt = $_POST["id_edt"];
    $heure1 = $_POST["heure1"];
    $heure2 = $_POST["heure2"];
    $heure3 = $_POST["heure3"];
    $heure4 = $_POST["heure4"];
    $niveau = $_POST["niveau"];
    $semaine = $_POST["semaine"];
    $lundi1 = $_POST["lundi1"];
    $lundi2 = $_POST["lundi2"];
    $lundi3 = $_POST["lundi3"];
    $lundi4 = $_POST["lundi4"];
    $mardi1 = $_POST["mardi1"];
    $mardi2 = $_POST["mardi2"];
    $mardi3 = $_POST["mardi3"];
    $mardi4 = $_POST["mardi4"];
    $mercredi1 = $_POST["mercredi1"];
    $mercredi2 = $_POST["mercredi2"];
    $mercredi3 = $_POST["mercredi3"];
    $mercredi4 = $_POST["mercredi4"];
    $jeudi1 = $_POST["jeudi1"];
    $jeudi2 = $_POST["jeudi2"];
    $jeudi3 = $_POST["jeudi3"];
    $jeudi4 = $_POST["jeudi4"];
    $vendredi1 = $_POST["vendredi1"];
    $vendredi2 = $_POST["vendredi2"];
    $vendredi3 = $_POST["vendredi3"];
    $vendredi4 = $_POST["vendredi4"];

    if (empty($semaine) || empty($niveau) || empty($heure1) || empty($heure2) || empty($heure3) || empty($heure4)) {
        $alert = '<h4 class="text-center mt-5 text-uppercase text-danger">Veuillez remplir tous les champs!</h4>';
    } else {
        $req = "UPDATE edt SET niveau = '$niveau', semaine = '$semaine',
         heure1='$heure1', heure2='$heure2', heure3='$heure3', heure4='$heure4',
         lundi1='$lundi1', lundi2='$lundi2', lundi3='$lundi3', lundi4='$lundi4',
         mardi1='$mardi1', mardi2='$mardi2', mardi3='$mardi3', mardi4='$mardi4',
         mercredi1='$mercredi1', mercredi2='$mercredi2', mercredi3='$mercredi3', mercredi4='$mercredi4',
         jeudi1='$jeudi1', jeudi2='$jeudi2', jeudi3='$jeudi3', jeudi4='$jeudi4',
         vendredi1='$vendredi1', vendredi2='$vendredi2', vendredi3='$vendredi3', vendredi4='$vendredi4' 
         WHERE id_edt='$id_edt'";
        $modification = mysqli_query($db, $req);
        if ($modification) {
            $alert = '<h4 class="text-center mt-5 text-uppercase text-success">Modification a été effectuée avec succès!</h4>';
        } else {
            $alert = '<h4 class="text-center mt-5 text-uppercase text-danger">Erreur lors du modification!</h4>';
        }
    }
}

// Récupérer les informations de l'edt à modifier
$modEdt = null;
if (isset($_GET['id_edt'])) {
    $id_edt = $_GET['id_edt'];
    $sql = "SELECT * FROM edt WHERE id_edt='$id_edt'";
    $result = mysqli_query($db, $sql);
    $modEdt = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des étudiants</title>
    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark fixed-top" aria-label="First navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Gestion des étudiants</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01"
                aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExample01">
            <ul class="navbar-nav me-auto mb-2">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="admin.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="insertion_edt.php">Mise à jour des EDT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="insertion_annonce.php">Mise à jour des annonces</a>
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
                <input class="form-control" type="text" name="recherche" placeholder="Rechercher le nom ou le prénom d'un étudiant"
                       aria-label="Search">
                <button class="btn btn-secondary mt-1" type="submit" name="rch">Rechercher</button>
            </form>
            <a href="deconnexion.php" class="btn btn-secondary mt-2">Déconnexion</a>
        </div>
    </div>
</nav>

<div id="affichage" class=" table-responsive p-5">
    <div class="">
        <h1 class="text-center mt-4">Liste des emplois du temps</h1>
        <button class="btn btn-outline-dark m-4" type="button" data-bs-toggle="modal" data-bs-target="#insertion">Ajouter un emploi du temps</button>
    </div>
    <div class="bd-example mt-4">
        <?php
        $sql = "SELECT * FROM edt ORDER BY id_edt DESC";
        $inscrits = mysqli_query($db, $sql);
        while ($res = mysqli_fetch_array($inscrits)) {
            ?>
            <div class="">
                <h4 class="text-center">EMPLOI DU TEMPS</h4>
                <div class="bd-example d-flex m-3">
                    <div class="col-md-8">
                        <h6>SEMAINE: <?php echo $res['semaine']; ?></h6>
                    </div>
                    <div class="col-md-4">
                        <h6>NIVEAU: <?php echo $res['niveau']; ?></h6>
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
                        <th scope="row"><?php echo $res['heure1']; ?></th>
                        <td><?php echo $res['lundi1']; ?></td>
                        <td><?php echo $res['mardi1']; ?></td>
                        <td><?php echo $res['mercredi1']; ?></td>
                        <td><?php echo $res['jeudi1']; ?></td>
                        <td><?php echo $res['vendredi1']; ?></td>
                    </tr>

                    <tr>
                        <th scope="row"><?php echo $res['heure2']; ?></th>
                        <td><?php echo $res['lundi2']; ?></td>
                        <td><?php echo $res['mardi2']; ?></td>
                        <td><?php echo $res['mercredi2']; ?></td>
                        <td><?php echo $res['jeudi2']; ?></td>
                        <td><?php echo $res['vendredi2']; ?></td>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-center">APRÈS-MIDI</th>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo $res['heure3']; ?></th>
                        <td><?php echo $res['lundi3']; ?></td>
                        <td><?php echo $res['mardi3']; ?></td>
                        <td><?php echo $res['mercredi3']; ?></td>
                        <td><?php echo $res['jeudi3']; ?></td>
                        <td><?php echo $res['vendredi3']; ?></td>

                    </tr>
                    <tr>
                        <th scope="row"><?php echo $res['heure4']; ?></th>
                        <td><?php echo $res['lundi4']; ?></td>
                        <td><?php echo $res['mardi4']; ?></td>
                        <td><?php echo $res['mercredi4']; ?></td>
                        <td><?php echo $res['jeudi4']; ?></td>
                        <td><?php echo $res['vendredi4']; ?></td>

                    </tr>
                    </tbody>
                </table>

                <div class="bd-example d-flex justify-content-center align-items-center mb-5">
                    <div class="m-4">
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modification<?php echo $res['id_edt']; ?>">Modifier</button>
                    </div>
                    <div class="m-4">
                        <a href="supprimer.php?id_edt=<?php echo $res['id_edt']; ?>" class="btn btn-danger"
                           onclick="confirmDeletion(event)">Supprimer</a>
                    </div>
                </div>

                <div class="modal mt-5" id="modification<?php echo $res['id_edt']; ?>">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form method="post" action="" class="">
                            <input type="hidden" name="id_edt" value="<?php echo $res['id_edt']; ?>">
                            
                                <div class="bd-example mt-5">
                                    <div class="">
                                        <h4 class="text-center">EMPLOI DU TEMPS</h4>
                                        <div class="bd-example d-flex m-3">
                                            <div class="col-md-8">
                                                <h6>SEMAINE: <input name="semaine" type="text" class="" value="<?php echo $res['semaine']; ?>" 
                                                                    placeholder="Entrer la semaine"
                                                                    aria-label=".form-control-sm مثال" required></h6>
                                            </div>
                                            <div class="col-md-4">
                                                <h6>NIVEAU: 
                                                    <select name="niveau" class="form-select form-select-sm" aria-label=".form-select-sm exemple" required>
                                                        <option value="L1" <?php if ($res['niveau'] == 'L1') echo 'selected'; ?>>L1</option>
                                                        <option value="L2" <?php if ($res['niveau'] == 'L2') echo 'selected'; ?>>L2</option>
                                                        <option value="L3" <?php if ($res['niveau'] == 'L3') echo 'selected'; ?>>L3</option>
                                                        <option value="M1" <?php if ($res['niveau'] == 'M1') echo 'selected'; ?>>M1</option>
                                                        <option value="M2" <?php if ($res['niveau'] == 'M2') echo 'selected'; ?>>M2</option>
                                                    </select>
                                                </h6>
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
                                                <th scope="row"><input name="heure1" class="form-control" type="text"
                                                                    placeholder="xxh-xxh" value="<?php echo $res['heure1']; ?>"
                                                                    aria-label=".form-control-sm مثال" required></th>
                                                <td><input name="lundi1" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['lundi1']; ?>"
                                                        aria-label=".form-control-sm مثال" ></td>
                                                <td><input name="mardi1" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['mardi1']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="mercredi1" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['mercredi1']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="jeudi1" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['jeudi1']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="vendredi1" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['vendredi1']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                            </tr>

                                            <tr>
                                                <th scope="row"><input name="heure2" class="form-control" type="text"
                                                                    placeholder="xxh-xxh" value="<?php echo $res['heure2']; ?>"
                                                                    aria-label=".form-control-sm مثال" required></th>
                                                <td><input name="lundi2" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['lundi2']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="mardi2" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['mardi2']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="mercredi2" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['mercredi2']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="jeudi2" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['jeudi2']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="vendredi2" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['vendredi2']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                            </tr>
                                            <tr>
                                                <th colspan="6" class="text-center">APRÈS-MIDI</th>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input name="heure3" class="form-control" type="text"
                                                                    placeholder="xxh-xxh" value="<?php echo $res['heure3']; ?>"
                                                                    aria-label=".form-control-sm مثال" required></th>
                                                <td><input name="lundi3" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['lundi3']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="mardi3" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['mardi3']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="mercredi3" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['mercredi3']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="jeudi3" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['jeudi3']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="vendredi3" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['vendredi3']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input name="heure4" class="form-control" type="text"
                                                                    placeholder="xxh-xxh" value="<?php echo $res['heure4']; ?>"
                                                                    aria-label=".form-control-sm مثال" required></th>
                                                <td><input name="lundi4" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['lundi4']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="mardi4" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['mardi4']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="mercredi4" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['mercredi4']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="jeudi4" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['jeudi4']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                                <td><input name="vendredi4" type="text" class="form-control"
                                                        placeholder="le matière avec la salle" value="<?php echo $res['vendredi4']; ?>"
                                                        aria-label=".form-control-sm مثال"></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <div class="bd-example d-flex justify-content-center align-items-center">
                                            <div class="m-4">
                                                <button class="btn btn-outline-dark" type="button" data-bs-dismiss="modal">Annuler</button>
                                            </div>
                                            <div class="m-4">
                                                <button class="btn btn-outline-dark" type="submit" name="modifier_edt">Modifier</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
            }?>
    </div>
</div>

<div class="modal mt-5" id="insertion">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" action="" class="">

                <div class="bd-example mt-5">
                    <div class="">
                        <h4 class="text-center">EMPLOI DU TEMPS</h4>
                        <div class="bd-example d-flex m-3">
                            <div class="col-md-8">
                                <h6>SEMAINE: <input name="semaine" type="text" class=""
                                                    placeholder="Entrer la semaine"
                                                    aria-label=".form-control-sm مثال" required></h6>
                            </div>
                            <div class="col-md-4">
                                <h6>NIVEAU: 
                                  <select name="niveau" class="" required>
                                        <option selected="">Niveau</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="L3">L3</option>
                                        <option value="M1">M1</option>
                                        <option value="M2">M2</option>
                                    </select>
                                </h6>
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
                                <th scope="row"><input name="heure1" class="form-control" type="text"
                                                       placeholder="xxh-xxh"
                                                       aria-label=".form-control-sm مثال" required></th>
                                <td><input name="lundi1" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال" ></td>
                                <td><input name="mardi1" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="mercredi1" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="jeudi1" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="vendredi1" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                            </tr>

                            <tr>
                                <th scope="row"><input name="heure2" class="form-control" type="text"
                                                       placeholder="xxh-xxh"
                                                       aria-label=".form-control-sm مثال" required></th>
                                <td><input name="lundi2" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="mardi2" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="mercredi2" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="jeudi2" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="vendredi2" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                            </tr>
                            <tr>
                                <th colspan="6" class="text-center">APRÈS-MIDI</th>
                            </tr>
                            <tr>
                                <th scope="row"><input name="heure3" class="form-control" type="text"
                                                       placeholder="xxh-xxh"
                                                       aria-label=".form-control-sm مثال" required></th>
                                <td><input name="lundi3" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="mardi3" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="mercredi3" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="jeudi3" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="vendredi3" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                            </tr>
                            <tr>
                                <th scope="row"><input name="heure4" class="form-control" type="text"
                                                       placeholder="xxh-xxh"
                                                       aria-label=".form-control-sm مثال" required></th>
                                <td><input name="lundi4" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="mardi4" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="mercredi4" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="jeudi4" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                                <td><input name="vendredi4" type="text" class="form-control"
                                           placeholder="le matière avec la salle"
                                           aria-label=".form-control-sm مثال"></td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="bd-example d-flex justify-content-center align-items-center">
                            <div class="m-4">
                                <button class="btn btn-outline-dark" type="button" data-bs-dismiss="modal">Annuler</button>
                            </div>
                            <div class="m-4">
                                <button class="btn btn-outline-dark" type="submit" name="inserer_edt">Insérer</button>
                            </div>
                        </div>
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

<script>
    function confirmDeletion(event) {
        if (!confirm("Êtes-vous sûr de vouloir supprimer cet emploi du temps?")) {
            event.preventDefault();
        }
    }
</script>

<script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Afficher automatiquement le modal d'alerte si $alert n'est pas vide
    <?php if (!empty($alert)) { ?>
    var alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
    alertModal.show();
    <?php } ?>
</script>
</body>
</html>

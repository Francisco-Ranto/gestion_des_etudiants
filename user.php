<?php
session_start();
include_once 'connxion_db.php';

// Vérification de l'utilisateur
if (empty($_SESSION['nom'])) {
    header('Location: login.php');
    exit;
}

$numero = $_SESSION['num_etudiant'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des étudiants</title>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link active" aria-current="page" href="user.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="affichage_annoce.php">Les annonces</a>
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
                <a href="deconnexion.php" class="btn btn-secondary mt-2">Déconnecté</a>
            </div>
        </div>
    </nav>

    <div class="cover-container d-flex w-100 h-50 p-3 mx-auto flex-column d-flex h-80 text-center">
        <main class="px-3 mt-5">
            <?php
                // Requête pour récupérer les informations des étudiants
                $sql = "SELECT num_etudiant, nom, image, image_type FROM etudiant WHERE num_etudiant='$numero'";
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
            <p class="lead">Vos emplois du temps et vos notes seront publiés dans ce site. <br> Bonne journée et restez toujours connecté : <?php echo $_SESSION['nom']; ?>.</p>
            <p class="lead">
                <a href="affichage_edt.php" class="btn btn-lg btn-secondary fw-bold border-white bg-black mt-5">Continuer</a>
            </p>
        </main>
    </div>

    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>
</html>

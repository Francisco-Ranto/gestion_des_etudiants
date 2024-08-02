<?php
session_start();
include_once 'connxion_db.php';

// Vérification de l'utilisateur
if (empty($_SESSION['nom'])) {
    header('Location: login.php');
    exit;
}

// Récupération du numéro d'étudiant
$numero = $_SESSION['num_etudiant'];

// Requête pour récupérer l'image et son type MIME de l'étudiant
$sql = "SELECT `image`, `image_type` FROM etudiant WHERE num_etudiant = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param('s', $numero);
$stmt->execute();
$stmt->bind_result($image_data, $image_type);
$stmt->fetch();
$stmt->close();

if ($image_data) {
    // Envoi de l'en-tête approprié pour l'image
    header("Content-Type: $image_type");
    echo $image_data;
} else {
    echo 'Image non trouvée.';
}
?>

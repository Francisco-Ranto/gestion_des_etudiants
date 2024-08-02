<?php
include_once 'connxion_db.php';

// Verifisation si n'est pas admin
if(empty($_SESSION['nom']) &&  $_SESSION['num_etudiant']!=1)
header('location:login.php');

$num_etudiant=0;
$num_qcm=0;
$id_annonce=0;
$id_edt=0;
$id_note=0;
$id_edt=$_GET['id_edt'];
$id_note=$_GET['id_note'];
$num_qcm=$_GET['num_qcm'];
$id_annonce=$_GET['id_annonce'];
$num_etudiant=$_GET['num_etudiant'];

// suppression de qcm
if($num_qcm!=0) {
    $sql="DELETE FROM qcm WHERE num_qcm='$num_qcm'";
    $req=mysqli_query($db,$sql);
    header('location: affichage_qcm.php');
}

// Suppression des etudiants
if($num_etudiant!=0) {
    $sql="DELETE FROM etudiant WHERE num_etudiant='$num_etudiant'";
    $req=mysqli_query($db,$sql);
    header('location: liste_etudiant.php');
}

// Suppression des annoncees
if($id_annonce!=0) {
    $sql="DELETE FROM annonce WHERE id_annonce='$id_annonce'";
    $req=mysqli_query($db,$sql);
    header('location: insertion_annonce.php');
}

// Suppression des edt
if($id_edt!=0) {
    $sql="DELETE FROM edt WHERE id_edt='$id_edt'";
    $req=mysqli_query($db,$sql);
    header('location: insertion_edt.php');
}

// Suppression des edt
if($id_note!=0) {
    $sql="DELETE FROM note WHERE id_note='$id_note'";
    $req=mysqli_query($db,$sql);
    header('location: affichage_inscrits.php');
}
?>
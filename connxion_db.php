<?php 

// connexion avec mysql
$db = mysqli_connect("localhost","root","","db") or die("database error");
session_start();
$_SESSION['alert']="";

// Redirection des uilisateurs depuis login
if(isset($_POST['email']) && isset($_POST['pwd'])){
    
    $email=$_POST["email"];
    $pwd=$_POST["pwd"];

    if(empty($email) || empty($pwd)){
        header("location: login.php?error=veiller remplir le champ!!");
    }
    else{
        $req = "SELECT * FROM etudiant WHERE email='$email' AND pwd='$pwd'";
        $verif=mysqli_query($db,$req);
        
        if(mysqli_num_rows($verif)==1){
            $ad="ad";
            $row= mysqli_fetch_assoc($verif);
            if($row['email']==$email && $row['pwd']==$pwd && $row['num_etudiant']==1){
                session_start();
                $_SESSION['nom']=$row['nom'];
                $_SESSION['prenom']=$row['prenom'];
                $_SESSION['num_etudiant']=$row['num_etudiant'];

                header('Location: admin.php');
            }
            elseif($row['email']==$email && $row['pwd']==$pwd && $row['num_etudiant']!=1){
                session_start();
                $_SESSION['nom']=$row['nom'];
                $_SESSION['prenom']=$row['prenom'];
                $_SESSION['email']=$row['email'];
                $_SESSION['num_etudiant']=$row['num_etudiant'];
                $_SESSION['niveau']=$row['niveau'];
                header('Location: user.php');
                }
        }
            
        else{
            header("location: login.php?error=Mail ou mot de passe incorrect!");
        }
        }
    }
?>
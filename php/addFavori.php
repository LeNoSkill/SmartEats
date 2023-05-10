<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smarteats";

// Création de l'objet PDO et connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configure PDO pour générer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


if(isset($_GET['id'],$_SESSION['user_id']) AND !empty($_GET['id'])){
    //echo('ok');
    $getid=(int)$_GET['id'];
    $sessionid = $_SESSION['user_id'] ;

    
    $check = $pdo->prepare('SELECT id from recettes WHERE ID = ? ');
    $check->execute(array($getid));

    if($check->rowCount()==1){
        
        $ins = $pdo->prepare('INSERT into favoris (ID_utilisateur, ID_recette) VALUES (?,?)');
        $ins->execute(array($sessionid, $getid));
        //echo((int)$_GET['id']." reussite");
        
    }
    else{
        echo('erreur');
        echo((int)$_GET['id']);
    }
}
else{
    echo('erreur');
}


?>
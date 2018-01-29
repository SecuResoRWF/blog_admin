<?php

session_start();

include('functions/functions.php');
    
require('config/bdd.php');

$responseA = isAdmin($_SESSION['auth'], $bdd);
$responseM = isMember($_SESSION['auth'], $bdd);

if(!isset($_SESSION['auth']) OR $responseA === false){
    header('Location: index.php');
}
if($_POST){
    $titre = htmlentities($_POST['titre']);
    $content = htmlentities($_POST['content']);
    $img = htmlentities($_POST['img']);
    $autor = htmlentities($_POST['autor']);
    $section = htmlentities($_POST['section']);
    $validation = htmlentities($_POST['validation']);
    
    
    if(!empty($titre)  && !empty($content) && !empty($autor)){
        
        $req = $bdd->prepare("INSERT INTO articles SET titre = :titre, content = :content,img = :img,autor = :autor, section = :section, created_at = NOW(), validation = :validation");
        $req->execute([
            'titre' => $titre,
            'content'=> $content,
            'img'=> $img,
            'autor'=> $autor,
            'section'=> $section,
            'validation'=> $validation
            
        ]);
        echo 'article crée';
    }
    else{ 
        echo 'Variables vides';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link rel="stylsheet" type="text/css" href="style.css">
    <title>site</title>
</head>
<body>
    <div class="container">
        <h1>ajouter un article</h1>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <div class="form-group">
                <input type="text" name="titre" class="form-control" placeholder="titre">
                <textarea type="text" name="content" class="form-control" placeholder="article"></textarea>
                <input type="text" name="img" class="form-control" placeholder="image">
                <input type="text" name="autor" class="form-control" placeholder="auteur">
                <input type="text" name="section" class="form-control" placeholder="section">
                <input type="text" name="validation" class="form-control" placeholder="validation">
                
                
            </div>
            <br />
            <button class="btn btn-default" type="submit">Poster l'article</button>
        </form>
    </div>
</body>
</html>
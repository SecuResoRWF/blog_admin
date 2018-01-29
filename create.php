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
    $title = htmlentities($_POST['title']);
    $author = htmlentities($_POST['author']);
    $content = htmlentities($_POST['content']);
    
    if(!empty($title) && !empty($author) && !empty($content)){
        
        $req = $bdd->prepare("INSERT INTO articles SET titre = :titre, content = :content,img = :img,autor = :autor, section = :section, created_at = NOW(), validation = :validation");
        $req->execute([
            'title' => $title,
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
                <input type="text" name="title" class="form-control">
                <input type="text" name="author" class="form-control">
                <textarea type="text" name="content" class="form-control"></textarea>
            </div>
            <br />
            <button class="btn btn-default" type="submit">Poster l'article</button>
        </form>
    </div>
</body>
</html>
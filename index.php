<?php
session_start();

include('functions/functions.php');

require('config/bdd.php');

$responseM = false;
$responseA = false;

if(isset($_SESSION['auth'])){
    $responseA = isAdmin($_SESSION['auth'], $bdd);
}
if(isset($_SESSION['auth'])){
    $responseM = isMember($_SESSION['auth'], $bdd);
}

$req = $bdd->query('SELECT * FROM articles');

$posts = $req->fetchAll(PDO::FETCH_OBJ);
//var_dump ($responseA);
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
   <div>
    <?php if(isset($_SESSION['auth'])): ?>
    <a href="deco.php"><button class="btn btn-danger">Log out</button></a>
    <?php endif; ?>
    <?php if(!isset($_SESSION['auth'])): ?>
    <a href="login.php"><button class="btn btn-default">Log in</button></a>
    <?php endif; ?>
   </div>
   <div>
       <?php if(($responseM === true)OR($responseA === true)): ?>
       <a href="create.php"><button class="btn btn-default">Créer un article</button></a>
       <?php endif; ?>
   </div>
    <div class="container">
        <h1>bienvenu sur le site</h1>
        <select><option>été actif</option><option>popote et papote</option><option>sectio 3</option><option>section4</option></select>
        <?php foreach($posts as $post): ?>
        <h3><?=  $post->titre ?></h3>
        <small>Crée par <?= $post->autor ?></small>
        <p><?=  $post->content ?></p>
        <a href="post.php?id=<?= $post->id ?>"><button class="btn btn-default">Lire plus</button></a>
        <?php endforeach; ?>
    </div>
</body>
</html>
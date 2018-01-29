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


if(isset($_POST['delete'])){
    $delete_id = $_POST['delete_id'];
    
    $req = $bdd->prepare("DELETE FROM articles WHERE id = ?");
    
    $suppr = $req->execute([$delete_id]);
    if($suppr){
        header('Location:index.php');
    }
}

$id = $_GET['id'];

$req = $bdd->query("SELECT * FROM articles WHERE id = $id");

$post = $req->fetch(PDO::FETCH_OBJ);


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
        <h1>bienvenu sur le site</h1>
        <h3><?= $post->titre ?></h3>
        <small>Crée par <?= $post->autor ?></small>
        <p><?= $post->content ?></p>
        <hr>
        <?php if($responseA === true): ?>
            <a href="edit.php?id=<?= $post->id ?>"><button class="btn btn-default">Editer</button></a>
            <div class="float-right">
                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                   <input type="hidden" name="delete_id" value="<?= $post->id ?>">
                    <button class="btn btn-danger" name="delete">Supprimer</button>
                </form>
            </div>
        <?php endif; ?>
        <?php if($responseM === true): ?>
            <a href="edit.php?id=<?= $post->id ?>"><button class="btn btn-default">Editer</button></a>
            <div class="float-right">
                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">                    
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
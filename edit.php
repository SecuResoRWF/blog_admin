<?php

include('functions/functions.php');

require('config/bdd.php');


if(intval($_GET['id'])){
    $post_id = $_GET['id'];
    $req = $bdd->query("SELECT * FROM articles WHERE id = $post_id ");
    $post = $req->fetch(PDO::FETCH_OBJ);
}else{
    echo 'Attention l\'id doit être un entier';
}

if($_POST){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $id = $_POST['id'];
    
    $req = $bdd->prepare("UPDATE post SET titre = :titre, content = :content,img = :img,autor = :autor, section = :section validation = :validation WHERE id = :id");
    $post = $req->execute([
        'title' => $title,
        'content'=> $content,
        'img'=> $img,
        'autor'=> $autor,
        'section'=> $section,
        'validation'=> $validation,
        'id' => $id,
    ]);
    if($post){
        header('Location:index.php');
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
            <h1>Editer un article</h1>
            <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" value="<?= $post->title ?? ''; ?>">
                    <textarea type="text" name="content" class="form-control"><?= $post->content ?? ''; ?></textarea>
                    <input type="text" name="img" class="form-control"value="<?= $post->img ?? ''; ?>">
                    <input type="text" name="author" class="form-control" value="<?= $post->author ?? ''; ?>">
                    <textarea type="text" name="section" class="form-control"><?= $post->section ?? ''; ?></textarea>
                    <textarea type="text" name="validation" class="form-control"><?= $post->validation ?? ''; ?></textarea>
                    <input type="hidden" name="id" value="<?= $post->id ?>">
                </div>
                <br />
                <button class="btn btn-default" type="submit">Editer l'article</button>
            </form>
        </div>
    </body>

    </html>
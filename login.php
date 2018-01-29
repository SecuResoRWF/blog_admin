<?php
require('config/bdd.php');

if($_POST){
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    
    $req = $bdd->prepare('SELECT * FROM user WHERE username = ?');
    
    $req->execute([$username]);
    
    $user = $req->fetch(PDO::FETCH_OBJ);
    
    if(password_verify($password, $user->password)){
        session_start();
        $_SESSION['auth'] = $user->id;
        header('Location:index.php');
    }else{
        echo 'Mauvais identifiant/mot de passe';
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
        <h1>Se connecter</h1>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <div class="form-group">
                <input type="text" name="username" class="form-control">
                <input type="password" name="password" class="form-control">
            </div>
            <br />
            <button class="btn btn-default" type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
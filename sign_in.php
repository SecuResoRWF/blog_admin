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

if(($responseA === true) OR ($responseM === true)){
    header("Location: index.php");
}

if(!empty($username) && !empty($password)){
        
        $req = $bdd->prepare("INSERT INTO user SET username = :username, password = :password");
        $req->execute([
            'username' => $username,
            'password'=> $password
        ]);
        echo 'compte crée';
    }
    else{ 
        echo 'Champ non renseigné';
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
        <h1>Inscription</h1>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <div class="form-group">
                <input type="text" name="username" class="form-control">
                <input type="password" name="password1" class="form-control" pattern=".{8,}"   required title="8 caracteres minimum">
                <input type="password" name="password2" class="form-control" pattern=".{8,}"   required title="8 caracteres minimum">
            </div>
            <br />
            <button class="btn btn-default" type="submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>

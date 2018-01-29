<?php
function isAdmin($session_id, $bdd){
    $req = $bdd->prepare('SELECT * FROM user WHERE id = :id');
    $req->execute([
        'id' => $session_id
    ]);
    
    $user = $req->fetch(PDO::FETCH_OBJ);
    
    if($user->status === 'admin'){
        return true;
    }else{
        return false;
    }
}



function isMember($session_id, $bdd){
    $req = $bdd->prepare('Select * FROM user WHERE id = :id');
    $req->execute([
        'id' => $session_id
    ]);
    $user = $req->fetch(PDO::FETCH_OBJ);
    
    if($user->status === 'member'){
        return true;
    }else{
        return false;
    }
}
?>
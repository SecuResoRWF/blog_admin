<?php

$password = $_POST['mdp'];


$longueur = strlen($password1);
if ($longueur < 8) {
    echo "Mot de passe trop court !";
}
/* = utiliser 'pattern=".{8,}"' et  'required title="8 caracteres minimum"' en tant que parametre des inputs html dont l'on veux controler la longueur  */
}
if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $password)) {
        echo 'Mot de passe conforme';
	}
	
    else {
        echo 'Mot de passe non conforme';
	}
/* Permet de verifier si le champ renseigné contient les caractères listé + les caractères spéciaux ((?=.*\W)=ne correspond pas a un mot) */


/* vérif longueur + caractère = */
if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $password)) {
        echo 'Mot de passe conforme';
	}
	
    else {
        echo 'Mot de passe non conforme';
	}
/* on véifie ici que la chaine entrée dans $password contient soit des lettres de a à z en minuscule ou majuscule,des chiffres ou des caractères spéciaux et fait minimum 8 caractères */
?>
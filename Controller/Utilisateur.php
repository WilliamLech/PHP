<?php
include_once("../Model/Connexion.php");

class Utilisateur{

    function connexion($pass,$nameUser){
        try {
            if (infoUser($nameUser, $pass)) {
                session_start();
                $formUser = filter_var($nameUser);
                $formPass = filter_var($pass);
                $_SESSION["config_pass"] = $formPass;
                $_SESSION["config_user"] = $formUser;
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
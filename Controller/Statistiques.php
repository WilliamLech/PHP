<?php
include_once("../Model/db_info.php");
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);

class Statistiques
{
    private $page;
    private $db;

    public function __construct(){
        $this->page = $_SERVER['PHP_SELF'];
        $this->db = $GLOBALS['dbh'];
        $sql = "INSERT INTO Statistiques (uri) VALUES ('$this->page')";
        $this->db->exec($sql);
    }

    public function showPageAccess(){
        $sql = "SELECT COUNT(stamp) AS nb FROM Statistiques WHERE uri = '$this->page'";
        $st = $this->db->query($sql);
        if ($ligne = $st->fetch()) {
            return $ligne['nb'];
        } else return 0;
    }
}
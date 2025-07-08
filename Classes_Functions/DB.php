<?php 
include_once "selection.php";

class Database {
    // Properties
    private $myPDO;

    private $servername;
    private $username;
    private $password;

    // Constructor
    public function __construct($server, $user, $pass) {
        $this->myPDO = new PDO("mysql:host=$server;dbname=booknook", $user, $pass);
        $this->servername = $server;
        $this->username = $user;
        $this->password = $pass;
    }

    public function get_genres() {
            $genreArr = [];
            try {
                $this->myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $this->myPDO->prepare("SELECT * FROM genre");
                $stmt->execute();
    
                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                
                foreach($stmt->fetchAll() AS $genre) {
                    $genreArr[] = new Genre($genre["gID"], $genre["genreTitle"]);
                }
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                }  
            var_dump($genreArr);
            return $genreArr;  
        }
}

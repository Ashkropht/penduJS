<?php

    Class Controller {

        // Déclaration des attributs
        private $db = "mysql:host=localhost;dbname=pendu;charset=UTF8";
        private $name = "root";
        private $pass = "muda94muda";
        public $connex;
        
        public function __construct() {
            try {
                $this->connex = new PDO($this->db, $this->name, $this->pass);
            }	catch(PDOException $e) {
                    echo "Connexion à la base de données impossible";
                    die();
                }
        }
    }
?>
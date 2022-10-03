<?php
    class homeModel{
        private $PDO;
        public function __construct()
        {
            require_once("c://xampp/htdocs/login/config/db.php");
            $pdo = new db();
            $this->PDO = $pdo->conexion();
        }
        public function agregarNuevoUsuario($correo,$password){
            $statement = $this->PDO->prepare("INSERT INTO usuarios values(null,:correo, :password)");
            $statement->bindParam(":correo",$correo);
            $statement->bindParam(":password",$password);
            try {
                $statement->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
        public function obtenerclave($correo){
            $statement = $this->PDO->prepare("SELECT password FROM usuarios WHERE correo = :correo");
            $statement->bindParam(":correo",$correo);
            return ($statement->execute()) ? $statement->fetch()['password'] : false;
        }
    }

?>
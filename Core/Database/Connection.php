<?php

namespace Core\Database;
Use Core\SingletonTrait;
Use \PDO;

Class Connection {
    
    use SingletonTrait;
    private $pdo;

    private function __construct() {
        $host = get_config("main.database.host");
        $db_name = get_config("main.database.db_name");
        $username = get_config("main.database.username");
        $password = get_config("main.database.password");
        $this->pdo = new PDO("mysql:$host=localhost;dbname=$db_name", $username, $password);
    }

    public function query($sql) {
        $statment = $this->pdo->query($sql);
        if($statment) {
            return $statment->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }
}
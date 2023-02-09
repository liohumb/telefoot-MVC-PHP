<?php

class Database
{
    private string $host = 'localhost';
    private string $port = '3306';
    private string $user = 'root';
    private string $pass = 'rootroot';
    private string $dbname = 'telefoot';

    private PDO $dbh;
    private $stmt;
    private string $error;

    public function __construct()
    {
        // Mise en place du DSN
        $dsn = 'mysql:host=' . $this->host . ':' . $this->port . ';dbname=' . $this->dbname;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        // Création des instances PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * @param $sql
     * @return void
     * Préparation pour le query
     */
    public function query($sql): void
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * @param $param
     * @param $value
     * @param $type
     * @return void
     * Liaisons des valeurs à une instruction préparée aves des paramètres nommés
     */
    public function bind($param, $value, $type = null): void
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * @return mixed
     * Execution de la préparation
     */
    public function execute(): mixed
    {
        return $this->stmt->execute();
    }

    /**
     * @return mixed
     * Retour de multiple enregistrement
     */
    public function resultSet(): mixed
    {
        $this->execute();

        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     * Retour d'un seul enregistrement
     */
    public function single(): mixed
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     * Obtenir le nombre de lignes
     */
    public function rowCount(): mixed
    {
        return $this->stmt->rowCount();
    }
}
<?php
namespace App\Core;

abstract class Sql{

    private $pdo;
    private $table;

    public function __construct(){
        //Mettre en place un SINGLETON
        try{
            $this->pdo = new \PDO("pgsql:host=database;port=5432;dbname=esgi_s2_bdd" , "nimda" , "nimdaesgi" );
        }catch(\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = end($classExploded);
        $this->table = "esgi_".$this->table;
    }

    public function save(): void
    {
        $columns = get_object_vars($this);
        $columnsToDeleted =get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToDeleted);
        unset($columns["id"]);
        if(is_numeric($this->getId()) && $this->getId()>0)
        {
            $columnsUpdate = [];
            foreach ($columns as $key=>$value)
            {
                $columnsUpdate[]= $key."=:".$key;
            }
            $queryPrepared = $this->pdo->prepare("UPDATE ".$this->table." SET ".implode(",",$columnsUpdate)." WHERE id=".$this->getId());
        }else{
            $queryPrepared = $this->pdo->prepare("INSERT INTO ".$this->table." (".implode(",", array_keys($columns)).") 
                            VALUES (:".implode(",:", array_keys($columns)).")");
        }
        $queryPrepared->execute($columns);
    }

    public function search(array $element)
    {
        $toSelect = [];
        $params = [];
        foreach ($element as $key => $value) {
            $toSelect[] = $key . "=:" . $key;
            $params[':' . $key] = $value;
        }
        $sql = "SELECT * FROM " . $this->table . " WHERE " . implode(' AND ', $toSelect);
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($params);
        return $queryPrepared->fetchObject(get_called_class());
    }

    public function getAll(): array
    {
       $sql = 'SELECT * FROM '. $this->table ;
       $queryPrepared = $this->pdo->prepare($sql);
       $queryPrepared->execute();
       $objects = array();
       while ($object = $queryPrepared->fetchObject(get_called_class()))
       {
           $objects[] = $object;
       }
       return $objects;
    }

    public function selectOrder(array $element, $order,$by)
    {
        $toSelect = [];
        $params = [];
        foreach ($element as $key => $value) {
            $toSelect[] = $key . "=:" . $key;
            $params[':' . $key] = $value;
        }
        $validOrders = ['ASC', 'DESC'];
        $by = strtoupper($by);
        if (!in_array($by, $validOrders)) {
            $by = 'ASC';
        }
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . implode(" AND ", $toSelect) . ' ORDER BY '.$order .' ' . $by;
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($params);
        return $queryPrepared->fetchObject(get_called_class());
    }

    public function delete(): void
    {
        $sql = "DELETE FROM ".$this->table." WHERE id = ".$this->getId();
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();
    }


    public function multipleSearch(array $element): array
    {
        $toSelect = [];
        $params = [];
        foreach ($element as $key => $value) {
            $toSelect[] = $key . "=:" . $key;
            $params[':' . $key] = $value;
        }
        $sql = "SELECT * FROM " . $this->table . " WHERE " . implode(' AND ', $toSelect);
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($params);
        $objects = array();
        while ($object = $queryPrepared->fetchObject(get_called_class()))
        {
            $objects[] = $object;
        }
        return $objects;
    }

    public function selectLimit(array $element, $limit): array
    {
        $toSelect = [];
        $params = [];

        foreach ($element as $key => $value) {
            $toSelect[] = $key . "=:" . $key;
            $params[':' . $key] = $value;
        }

        $sql = "SELECT * FROM " . $this->table . " WHERE " . implode(' AND ', $toSelect) . " ORDER BY created_at ASC LIMIT :limit";
        $queryPrepared = $this->pdo->prepare($sql);

        // Associer les valeurs des paramètres
        foreach ($params as $paramName => $paramValue) {
            $queryPrepared->bindValue($paramName, $paramValue);
        }
        $queryPrepared->bindValue(':limit', $limit, $this->pdo::PARAM_INT); // Limite en tant qu'entier

        $queryPrepared->execute();

        $objects = array();

        while ($object = $queryPrepared->fetchObject(get_called_class())) {
            $objects[] = $object;
        }

        return $objects;
    }


    public function recordView(): array
    {
        $sql = "SELECT COUNT(*) AS total_views FROM ". $this->table;
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();
        return $queryPrepared->fetchAll();
    }
    public function getCountByMonth(): bool|array
    {
        $sql = "SELECT
                    EXTRACT(MONTH FROM date_inserted) AS month,
                    COUNT(*) AS total_count
                FROM
                    ".$this->table."
                WHERE
                    date_inserted >= DATE_TRUNC('year', CURRENT_DATE)
                GROUP BY
                    EXTRACT(MONTH FROM date_inserted)
                ORDER BY
                    EXTRACT(MONTH FROM date_inserted)";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();
        return $queryPrepared->fetchAll();
    }

    public function getCountByWeek(): bool|array
    {
        $sql = "SELECT
                DATE_TRUNC('week', date_inserted) AS week,
                COUNT(*) AS total_count
            FROM
               ".$this->table."
            WHERE
                date_inserted >= DATE_TRUNC('month', CURRENT_DATE) - INTERVAL '1 month'
            GROUP BY
                week
            ORDER BY
                week";

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();
        return $queryPrepared->fetchAll();


    }
    public function getCountByDay()
    {
        $sql = "SELECT
                DATE(date_inserted) AS day,
                COUNT(*) AS total_count
            FROM
               ".$this->table."
            WHERE
                DATE(date_inserted) = CURRENT_DATE
            GROUP BY
                DATE(date_inserted)
            ORDER BY
                DATE(date_inserted)";

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();
        return $queryPrepared->fetchAll();
    }


}
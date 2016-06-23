<?php


class recorder
{

    public function record(){
        
        if(!empty($_POST))
        foreach ($_POST as $key => $value)
            $_SESSION[$key] = $value;
    }

    public function push_to_db($dbName, $tableName, array $data){

        try {
            $dbo = $this->connect_to_db($dbName);
            $query = $dbo->prepare($this->create_query($tableName, $data));
            $data['id'] = null;
            $this->execute_query($query, $data);
        }
        catch (Exception $e){
            throw $e;
        }
    }
    
    public function fetch_from_db($dbName, $tableName, $id){

        $dbo = $this->connect_to_db($dbName);
        return $dbo
            ->query("select * from $tableName where id = $id")
            ->fetch(PDO::FETCH_ASSOC);
    }

    public function get_last_id($dbName, $tableName){

        $dbo = $this->connect_to_db($dbName);
        $res = $dbo->query("SHOW TABLE STATUS LIKE '$tableName'");
        if($row = $res->fetch(PDO::FETCH_ASSOC))
        return intval($row['Auto_increment']);
        return 1;
    }
    
    private function connect_to_db($dbName){

        $dsn = "mysql:dbname=$dbName;host=localhost;charset=utf8";
        return new PDO($dsn, 'root', 'savincov07');
    }

    private function create_query($tableName, array $data){
        
        $start = "insert into $tableName (";
        $mid = ") values (";
        $cols = "id, ";
        $values = ":id, ";

        foreach ($data as $key => $value)
        {
            $cols = $cols . $key . ", ";
            $values = $values . ':' . $key . ", ";
        }

        return $start . trim($cols, ", ") . $mid . trim($values, ", ") . ")";
    }

    private function execute_query(PDOStatement $query, array $session){

        if(!$query->execute($session))
            throw new Exception();
    }
}
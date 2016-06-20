<?php


class recorder
{

    public function record(){
        
        if(!empty($_POST))
        foreach ($_POST as $key => $value)
            $_SESSION[$key] = $value;
    }

    public function push_to_db(array $session)
    {
        $dsn = 'mysql:dbname=briefdb;host=localhost;charset=utf8';

        try {
            $dbo = new PDO($dsn, 'root', 'savincov07');
            $query = $dbo->prepare($this->create_query($session));
            $session['id'] = null;
            $this->execute_query($query, $session);
        }
        catch (Exception $e){
            throw $e;
        }
    }
    
    private function execute_query(PDOStatement $query, array $session){
        
        if(!$query->execute($session))
            throw new Exception();
    }

    private function create_query(array $session)
    {
        $start = "insert into brief (";
        $mid = ") values (";
        $cols = "id, ";
        $values = ":id, ";

        foreach ($session as $key => $value)
        {
            $cols = $cols . $key . ", ";
            $values = $values . ':' . $key . ", ";
        }

        return $start . trim($cols, ", ") . $mid . trim($values, ", ") . ")";

    }
}
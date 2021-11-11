<?php

class clientsModel extends mysql{

    public function __construct(){
        parent::__construct();
    }

    public function selectAllClients(){
            //EXTRAE PERSONAS
            $sql = "SELECT * FROM clients";
            $request = $this->select_all($sql);
            return $request;
            var_dump($request);
    }

}
?>

<?php

//Realiza el CRUD hacia nuestra BD
class mysql extends connectDB
{
    private $connect;
    private $strquery;
    private $arrValues;

    function __construct()
    {
        $this->connect = new connectDB();
        $this->connect = $this->connect->connect();
    }

    //Buscar un registro
    public function select(string $query)
    {
        $this->strquery = $query;
        $result = $this->connect->prepare($this->strquery);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    //Devolver todos los registros
    public function select_all(string $query)
    {
        $this->strquery = $query;
        $result = $this->connect->prepare($this->strquery);
        $result->execute();
        $data = $result->fetchall(PDO::FETCH_ASSOC);
        return $data;
    }

    //Insertar un registro
    public function insert(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;
        $insert = $this->connect->prepare($this->strquery);
        $resInsert = $insert->execute($this->arrValues);
        if ($resInsert) {
            $lastInsert = $this->connect->lastInsertId();
            $arrRequest = array($resInsert, $lastInsert);
        } else {
            $arrRequest = array($resInsert);
        }
        return $arrRequest;
    }

    //Actualizar registros
    public function update(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;
        $update = $this->connect->prepare($this->strquery);
        $resExecute = $update->execute($this->arrValues);
        return $resExecute;
    }

    //Eliminar un registro
    public function delete(string $query)
    {
        $this->strquery = $query;
        $result = $this->connect->prepare($this->strquery);
        $del = $result->execute();
        return $del;
    }
}

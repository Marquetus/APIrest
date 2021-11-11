<?php

class rolesModel extends Mysql{

    private $intIdrol;
    private $strName;
    private $strDescription;
    private $intStatus;

    public function __construct(){
        parent::__construct();
    }

    /* Getters */
    public function getIntIdrol()
    {
        return $this->intIdrol;
    }

    public function getStrName()
    {
        return $this->strName;
    }

    public function getStrDescription()
    {
        return $this->strDescription;
    }

    public function getIntStatus()
    {
        return $this->intStatus;
    }

    /* Setters */
    public function setIntIdrol($intIdrol)
    {
        $this->intIdrol = $intIdrol;

        return $this;
    }

    public function setStrName($strName)
    {
        $this->strName = $strName;

        return $this;
    }

    public function setStrDescription($strDescription)
    {
        $this->strDescription = $strDescription;

        return $this;
    }

    public function setIntStatus($intStatus)
    {
        $this->intStatus = $intStatus;

        return $this;
    }

    /* Functions */
    public function selectRoles(){
        //EXTRAE ROLES
        $sql = "SELECT * FROM roles WHERE status != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectRol(){
        //Buscar ROL
        $sql = "SELECT * FROM roles WHERE id = {$this->getIntIdrol()}";
        $request = $this->select($sql);
        return $request;
    }

    public function insertRol(){
        //Nuevo ROL
        $return = "";

        $sql = "SELECT * FROM roles WHERE name = '{$this->getStrName()}'";
        $request = $this->select_all($sql);

        if(empty($request)){
            $query_insert = "INSERT INTO roles(name, description, status, created_at, updated_at) VALUES (?,?,?,NOW(),NULL)";
            $arrData = array($this->getStrName(), $this->getStrDescription(), $this->getIntStatus());
            $request_insert = $this->insert($query_insert, $arrData);
            if($request_insert > 0){
                $return = array("okey", $request_insert);
            }
        }else{
            $return = array("exist");
        }
        return $return;
    }

    public function updateRol(){
        $sql = "SELECT * FROM roles WHERE name = '{$this->getStrName()}' AND id != {$this->getIntIdrol()}";
        $request = $this->select_all($sql);

        if(empty($request)){
            $query_update = "UPDATE roles SET name = ?, description = ?, status = ?, updated_at = NOW() WHERE id = {$this->getIntIdrol()}";
            $arrData = array($this->getStrName(), $this->getStrDescription(), $this->getIntStatus());
            $request_update = $this->update($query_update,$arrData);
            if($request_update){
                $return = "okey";
            }
        }else{
            $return = "exist";
        }
        return $return;
    }

    public function deleteRol(){
        $sql = "DELETE FROM roles WHERE id = {$this->getIntIdrol()} LIMIT 1 ";
        $request = $this->delete($sql);
        return $request;
    }

}

<?php

class rolesModel extends Mysql //Heredity
{

    private $intId;
    private $strName;
    private $strDescription;
    private $intStatus;

    /*Construct methop inherits from mysql library*/
    public function __construct()
    {
        parent::__construct();
    }

    /* Functions */
    public function selectAll()
    {
        //Pull out
        $sql = "SELECT * FROM roles WHERE status != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectOne()
    {
        //Search for
        $sql = "SELECT * FROM roles WHERE id = {$this->getIntId()}";
        $request = $this->select($sql);
        return $request;
    }

    public function insertOne()
    {
        //New
        $return = "";

        $sql = "SELECT * FROM roles WHERE name = '{$this->getStrName()}'";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query_insert = "INSERT INTO roles(name, description, status, created_at, updated_at) VALUES (?,?,?,NOW(),NULL)";
            $arrData = array($this->getStrName(), $this->getStrDescription(), $this->getIntStatus());
            $request_insert = $this->insert($query_insert, $arrData);
            if ($request_insert[0]) {
                $return = array("okey", $request_insert[1]);
            } else {
                $return = array("fail");
            }
        } else {
            $return = array("exist");
        }
        return $return;
    }

    public function updateOne()
    {
        //Update
        $sql = "SELECT * FROM roles WHERE name = '{$this->getStrName()}' AND id != {$this->getIntId()}";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query_update = "UPDATE roles SET name = ?, description = ?, status = ?, updated_at = NOW() WHERE id = {$this->getIntId()}";
            $arrData = array($this->getStrName(), $this->getStrDescription(), $this->getIntStatus());
            $request_update = $this->update($query_update, $arrData);
            if ($request_update) {
                $return = "okey";
            } else {
                $return = "fail";
            }
        } else {
            $return = "exist";
        }
        return $return;
    }

    public function changeStatus()
    {
        //Change Status
        $query_update = "UPDATE roles SET status = ?, updated_at = NOW() WHERE id = {$this->getIntId()}";
        $arrData = array($this->getIntStatus());
        $request_update = $this->update($query_update, $arrData);
        $return = $request_update;
        return $return;
    }

    public function deleteOne()
    {
        //Delete
        $sql = "DELETE FROM roles WHERE id = {$this->getIntId()} LIMIT 1 ";
        $request = $this->delete($sql);
        return $request;
    }

    /* Getters and Setters */
    public function getIntId()
    {
        return $this->intId;
    }
    public function setIntId($intId)
    {
        $this->intId = $intId;

        return $this;
    }

    public function getStrName()
    {
        return $this->strName;
    }
    public function setStrName($strName)
    {
        $this->strName = $strName;

        return $this;
    }

    public function getStrDescription()
    {
        return $this->strDescription;
    }
    public function setStrDescription($strDescription)
    {
        $this->strDescription = $strDescription;

        return $this;
    }


    public function getIntStatus()
    {
        return $this->intStatus;
    }
    public function setIntStatus($intStatus)
    {
        $this->intStatus = $intStatus;

        return $this;
    }
}

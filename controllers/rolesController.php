<?php
//Call to model
require_once("models/rolesModel.php");

class rolesController extends rolesModel //Heredity
{
    private $intId;
    private $strName;
    private $strDescription;
    private $intStatus;

    public function __construct()
    {
        parent::__construct();

        $dataJson = @file_get_contents('php://input');
        $arrayDatos = json_decode($dataJson, true);

        $this->intId = isset($arrayDatos['intId']) ? $arrayDatos['intId'] : null;
        $this->strName = isset($arrayDatos['strName']) ? $arrayDatos['strName'] : null;
        $this->strDescription = isset($arrayDatos['strDescription']) ? $arrayDatos['strDescription'] : null;
        $this->intStatus = isset($arrayDatos['intStatus']) ? $arrayDatos['intStatus'] : null;
    }


    public function roles() //This methop must be the same that controller name withou ___Controller
    {
        //Controller Data
        $data['page_id'] = 3;
        $data['page_tag'] = "users roles";
        $data['page_title'] = "Users Roles";
        $data['page_name'] = "users_roles";

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function getAll()
    {
        //GET All
        $arrData = $this->selectAll();
        
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }

    public function getOne(int $intId)
    {
        //GET ONE
        $this->setIntId($intId);
        $data = $this->selectOne();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function add()
    {
        $this->setStrName($this->strName);
        $this->setStrDescription($this->strDescription);
        $this->setIntStatus($this->intStatus);
        $request_array = $this->insertOne();
        $request = $request_array[0];

        //Messages 
        if ($request == 'okey') {
            $arrResponse = array('status' => true, 'msg' => 'Data saved successfully.', 'id' => $request_array[1]);
        } else if ($request == 'exist') {
            $arrResponse = array('status' => false, 'msg' => 'Attention! The dato already exists.');
        } else if ($request == 'fail') {
            $arrResponse = array('status' => false, 'msg' => 'Data cannot be stored.');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }

    public function alter()
    {
        $this->setIntId($this->intId);
        $this->setStrName($this->strName);
        $this->setStrDescription($this->strDescription);
        $this->setIntStatus($this->intStatus);
        $request = $this->updateOne();

        //Messages 
        if ($request == 'okey') {
            $arrResponse = array('status' => true, 'msg' => 'Data updated successfully.');
        } else if ($request == 'exist') {
            $arrResponse = array('status' => false, 'msg' => 'Attention! The dato already exists.');
        } else if ($request == 'fail') {
            $arrResponse = array('status' => false, 'msg' => 'Data cannot be stored.');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }

    public function remove(int $intId)
    {
        //DELETE
        $intId = $intId;
        $this->setIntId($intId);
        $request = $this->deleteOne();
        //Messages 
        if ($request) {
            $arrResponse = array('status' => true, 'msg' => 'Data deleted successfully.');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Data cannot be remove.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }
}

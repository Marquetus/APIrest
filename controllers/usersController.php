<?php
//Call to model
require_once("models/usersModel.php");

class usersController extends usersModel //Heredity
{
    private $strId;
    private $intIdLocation;
    private $intIdDepartment;
    private $intIdRol;
    private $intIdUserCategory;
    private $strName;
    private $strSurname;
    private $strEmail;
    private $strPass;
    private $strDescription;
    private $strImage;
    private $fltHoursMonth;
    private $intStatus;

    public function __construct()
    {
        parent::__construct();

        $dataJson = @file_get_contents('php://input');
        $arrayDatos = json_decode($dataJson, true);

        $this->strId = isset($arrayDatos['strId']) ? $arrayDatos['strId'] : null;
        $this->intIdLocation = isset($arrayDatos['intIdLocation']) ? $arrayDatos['intIdLocation'] : null;
        $this->intIdDepartment = isset($arrayDatos['intIdDepartment']) ? $arrayDatos['intIdDepartment'] : null;
        $this->intIdRol = isset($arrayDatos['intIdRol']) ? $arrayDatos['intIdRol'] : null;
        $this->intIdUserCategory = isset($arrayDatos['intIdUserCategory']) ? $arrayDatos['intIdUserCategory'] : null;
        $this->strName = isset($arrayDatos['strName']) ? $arrayDatos['strName'] : null;
        $this->strSurname = isset($arrayDatos['strSurname']) ? $arrayDatos['strSurname'] : null;
        $this->strEmail = isset($arrayDatos['strEmail']) ? $arrayDatos['strEmail'] : null;
        $this->strPass = isset($arrayDatos['strPass']) ? $arrayDatos['strPass'] : null;
        $this->strDescription = isset($arrayDatos['strDescription']) ? $arrayDatos['strDescription'] : null;
        $this->strImage = isset($arrayDatos['strImage']) ? $arrayDatos['strImage'] : null;
        $this->fltHoursMonth = isset($arrayDatos['fltHoursMonth']) ? $arrayDatos['fltHoursMonth'] : null;
        $this->intStatus = isset($arrayDatos['intStatus']) ? $arrayDatos['intStatus'] : null;
    }

    public function users() //This methop must be the same that controller name withou ___Controller
    {
        //Controller Data
        $data['page_id'] = 4;
        $data['page_tag'] = "users";
        $data['page_title'] = "Users";
        $data['page_name'] = "users";

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function getAll()
    {
        //GET All
        $arrData = $this->selectAll();
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }

    public function getOne(int $strId)
    {
        //GET ONE
        $this->setStrId($strId);
        $data = $this->selectOne();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function add()
    {
        $this->setIntIdLocation($this->intIdLocation);
        $this->setIntIdDepartment($this->intIdDepartment);
        $this->setIntIdRol($this->intIdRol);
        $this->setIntIdUserCategory($this->intIdUserCategory);
        $this->setStrName($this->strName);
        $this->setStrSurname($this->strSurname);
        $this->setStrEmail($this->strEmail);
        $this->setStrPass($this->strPass);
        $this->setStrDescription($this->strDescription);
        $this->setStrImage($this->strImage);
        $this->setFltHoursMonth($this->fltHoursMonth);
        $this->setIntStatus($this->intStatus);
        $request_array = $this->insertOne();
        $request = $request_array[0];

        //Messages 
        if ($request == 'okey') {
            $arrResponse = array('status' => true, 'msg' => 'Data saved successfully.', 'id' => $request_array[1]);
        } else if ($request == 'exist') {
            $arrResponse = array('status' => false, 'msg' => 'Attention! The email already exists.');
        } else if ($request == 'fail') {
            $arrResponse = array('status' => false, 'msg' => 'Data cannot be stored.');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }

    public function alter()
    {
        $this->setStrId($this->strId);
        $this->setIntIdLocation($this->intIdLocation);
        $this->setIntIdDepartment($this->intIdDepartment);
        $this->setIntIdRol($this->intIdRol);
        $this->setIntIdUserCategory($this->intIdUserCategory);
        $this->setStrName($this->strName);
        $this->setStrSurname($this->strSurname);
        $this->setStrEmail($this->strEmail);
        $this->setStrPass($this->strPass);
        $this->setStrDescription($this->strDescription);
        $this->setStrImage($this->strImage);
        $this->setFltHoursMonth($this->fltHoursMonth);
        $this->setIntStatus($this->intStatus);
        $request = $this->updateOne();
        var_dump($request);

        //Messages 
        if ($request == 'okey') {
            $arrResponse = array('status' => true, 'msg' => 'Data updated successfully.');
        } else if ($request == 'exist') {
            $arrResponse = array('status' => false, 'msg' => 'Attention! The email already exists.');
        } else if ($request == 'fail') {
            $arrResponse = array('status' => false, 'msg' => 'Data cannot be stored.');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }

    public function remove(int $strId)
    {
        //DELETE
        $this->setStrId($strId);
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

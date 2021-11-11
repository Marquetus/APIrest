<?php
//Call to model
require_once("models/rolesModel.php");  

class rolesController{
    
    public function roles(){
        $data['page_id'] = 3;
        $data['page_tag'] = "Roles Usuario";
        $data['page_title'] = "Roles Usuario <small>Tienda Virtual</small>";
        $data['page_name'] = "users_roles";

        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    public function getRoles(){
        //GET All
        $model = new rolesModel;
        $arrData = $model->selectRoles();

        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
    }

    public function getRol(int $id){
        //GET ONE
        $idRol = $id;
        $model = new rolesModel;
        $model->setIntIdrol($idRol);
        $data = $model->selectRol();

        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    public function setRol(){
        //ADD and UPDATE
        $dataJson = @file_get_contents('php://input'); 
        $arrayDatos = json_decode($dataJson, true);

        if(isset($arrayDatos['id'])){
            $intIdrol = $arrayDatos['id'];
        }else{
            $intIdrol = 0;
        }
        $strName = $arrayDatos['name'];
        $strDescription = $arrayDatos['description'];
        $intStatus = $arrayDatos['status'];

        $model = new rolesModel;
        $model->setIntIdrol($intIdrol);
        $model->setStrName($strName);
        $model->setStrDescription($strDescription);
        $model->setIntStatus($intStatus);

        if($intIdrol == 0){
            //ADD
            $request_array = $model->insertRol();
            $request_rol = $request_array[0];
            $option = 1;
        }else{
            //UPDATE
            $request_rol = $model->updateRol();
            $option = 2;
        }
        //Messages 
        if($request_rol == 'okey'){
            if($option == 1){
                $arrResponse = array('status' => true, 'msg' => 'Data saved successfully.', 'id' => $request_array[1]);
            }else{
                $arrResponse = array('status' => true, 'msg' => 'Data updated successfully.');
            }
        }else if($request_rol == 'exist'){
            $arrResponse = array('status' => false, 'msg' => 'Attention! The role already exists.');
        }else{
            $arrResponse = array('status' => false, 'msg' => 'Data cannot be stored.');
        }

        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    }

    public function removeRol(int $id){
        //DELETE
        $idRol = $id;
        $model = new rolesModel;
        $model->setIntIdrol($idRol);
        $request = $model->deleteRol();
        //Messages 
        if($request){
            $arrResponse = array('status' => true, 'msg' => 'Data deleted successfully.');
        }else{
            $arrResponse = array('status' => false, 'msg' => 'Data cannot be remove.');
        }
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    }


}

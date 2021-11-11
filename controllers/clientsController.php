<?php
//Call to model
require_once("models/clientModel.php");

class clientsController{

    public function index(){
        $per=new clientModel();
        $datos= $per->selectAllClients();
        echo json_encode($datos);
    }
} 
?>

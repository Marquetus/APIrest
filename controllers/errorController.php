<?php

class errorController{
	
	public function error(){
		$error = "La página que buscas no existe";
		echo json_encode($error,JSON_UNESCAPED_UNICODE);
	}

	public function errorControll(){
		$error = "No existe el controlador";
		echo json_encode($error,JSON_UNESCAPED_UNICODE);
	}

	public function errorMethop(){
		$error = "No existe el metodo";
		echo json_encode($error,JSON_UNESCAPED_UNICODE);
	}
}
?>
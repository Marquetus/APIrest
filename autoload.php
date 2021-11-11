<?php

//$controller = ucwords($controller);//Convierte la primera letra de los controladores en mayuscula

$controllerFile = "controllers/".$controller."Controller.php";
if(file_exists($controllerFile)){
    require_once($controllerFile);
    $controller = $controller.'Controller';
    $controller = new $controller();

    if(method_exists($controller, $method)){
        $controller->{$method}($params);
    }else{
        require_once("controllers/errorController.php");
        $error = new errorController();
        $error->errorMethop();
    }

}else{
    require_once("controllers/errorController.php");
    $error = new errorController();
    $error->errorControll();
}

?>
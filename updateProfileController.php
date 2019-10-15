<?php
use \model\UserDAO;

function __autoload($class) {

    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) .".php";
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST["user_id"];
    $height = $_POST["height"];
    if(!is_numeric($height)){
        echo "height must be numeric";

    }
    else {
        try {
            $dao = new UserDAO();
            $dao->editUser($id, $height);
            echo "success";
        } catch (PDOException $e) {
            echo "error";
        }
    }
}
<?php


use \model\User;
use \model\UserDAO;

function __autoload($class) {

    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) .".php";
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $dao = new UserDAO();
    echo json_encode($dao->getAllUsers($_GET["page"], $_GET["entries"]));
}

if(isset($_POST["register"])){
    $username = $_POST["username"];
    $age = $_POST["age"];
    $city = $_POST["city"];
    $gender = $_POST["gender"];
    $height = $_POST["height"];
    //todo VALIDATE!
    $user = new User($username, $age, $city, $gender, $height);
    $dao = new UserDAO();
    try{
        $dao->saveUser($user);
        echo "done!";
    }
    catch (PDOException $e){
        include "../view/error.html";
    }
}
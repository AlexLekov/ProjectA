<?php
/**
 * Created by PhpStorm.
 * User: user-09
 * Date: 2.04.18
 * Time: 13:55
 */

use \model\UserDAO;

function __autoload($class) {

    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) .".php";
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $dao = new UserDAO();
    echo json_encode($dao->getGenders());
}
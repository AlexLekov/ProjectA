<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="view/js/app.js"></script>
    <title>Document</title>
</head>

<?php

function __autoload($class_name) {
    $class_name = str_replace("\\", "/", $class_name);
    require_once $class_name . '.php';
}

include "view/header.html";

if(isset($_GET["page"])){
    include "view/".$_GET["page"].".html";
}
else{
    include "view/register.html";
}
include "view/footer.html";
?>

</html>
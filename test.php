<?php
/**
 * Created by PhpStorm.
 * User: user-09
 * Date: 2.04.18
 * Time: 14:17
 */


echo $result . PHP_EOL;

require_once "../model/User.php";

$users = array();
for($i = 0; $i < 5; $i++){
    $users[] = new \model\User();
}

doSmth($users);

function doSmth($users){
    /* @var $user \model\User   */
    foreach ($users as $user) {
        $user->getAge();
        $user->machkai = function ($kogo) {
            echo "machkam " . $kogo . PHP_EOL;
        };
        call_user_func($user->machkai, "grishka");
        unset($user->machkai);
        $user->removeCity();
    }
}
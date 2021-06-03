<?php
include 'config.php';
include PATH_MODEL . 'Connection.php';
include 'utils/Utils.php';

function my_autoloader($class)
{
    // echo ($class . '<br>');
    // echo substr($class, -10);
    if (substr($class, 0, 5) == "Model") {
        include PATH_MODEL . $class . '.php';
    } else if (substr($class, -10) == "Controller") {
        include PATH_CTRL . '/' . $class . '.php';
    } else {
        include 'controller/entity/' . $class . '.php';
    }
}

spl_autoload_register('my_autoloader');

<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 3:18 PM
 */

include 'login.phtml';

/*
spl_autoload_register(function ($name) {
    echo "Want to load $name.<br>";
    throw new Exception("Unable to load $name.");
});

try {
    $obj = new user\Module();
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}*/

spl_autoload_register(function ($class_name) {
    include "modules/".$class_name . '.php';
});

try{
    $obj  = new email\Module();
}
catch (Exception $exception)
{
    echo $exception->getMessage();
}

?>

/*
require_once 'includes.inc';


if(isset($_GET['module']))
{
    $module = $_GET['module'];
    require_once "./modules/{$module}/Module.php";

    $mod = "{$module}\Module";

    $module = new $mod;

    print_r($module->getConfig());
    //$content = "test";
}

$content = "This is test content";

include 'view/template.phtml';*/
<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 3:18 PM
 */

require_once 'includes.inc';

if(isset($_GET['module']))
{
    $module = $_GET['module'];
    require_once "/./modules/{$module}/config.php";
}

$content = "This is test content";

include 'view/template.phtml';
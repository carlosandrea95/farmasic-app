<?php
$currentDir = dirname(__FILE__);
if (!defined('ADMIN_DIR')) {
    define('ADMIN_DIR', realpath($currentDir . '/.'));
    $path = explode(DIRECTORY_SEPARATOR, ADMIN_DIR);
    define('ADMIN_PATH', end($path));
}
if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', realpath(dirname('../../') . '/.'));
}
if (!defined('DEFAULT_CONTROLLER')) {
    define('DEFAULT_CONTROLLER', 'login');
}
$loadDir = realpath(dirname('../../'));
require_once $loadDir . '/server/config/autoload.php';
require_once $loadDir . '/server/vendor/autoload.php';
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Dispatcher::getInstanse()->dispatch();

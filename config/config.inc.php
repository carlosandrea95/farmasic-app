<?php
$currentDir = dirname('../');
if (!defined('ROOT_DIR')) {
   define('ROOT_DIR', realpath($currentDir . '/.'));
   $path = explode(DIRECTORY_SEPARATOR, ROOT_DIR);
   define('ROOT_PATH', end($path));
}
if (!defined('DEFAULT_CONTROLLER')) {
   define('DEFAULT_CONTROLLER', 'login');
}
require_once ROOT_DIR . '/server/config/autoload.php';
require_once ROOT_DIR . '/server/vendor/autoload.php';

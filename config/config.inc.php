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

require_once ROOT_DIR . '/vendor/autoload.php';


// require_once 'vendor/farmasic/core/src/config/define';
// $loadDir = realpath('../../');
// // Load defines initial
// require_once $loadDir . '/framework/config/defines.inc.php';
// // Running autoload
// require_once CONFIG_DIR . 'autoload.php';
// require_once $loadDir . '/config/bootstrings.php';

// require_once CONFIG_DIR . 'define_uri.inc.php';

<?php
if (!defined('ROOT_DIR')) {
   define('ROOT_DIR', realpath(dirname('../../') . '/.'));
}
// require_once ROOT_DIR . '/server/config/autoload.php';
require ROOT_DIR . '/server/vendor/autoload.php';
require ROOT_DIR . '/server/core/sockets/Notificaitons.php';

use Ratchet\Server\IoServer;


$server = IoServer::factory(
   new Notifications(),
   8080
);

$server->run();

<?php
require_once 'config/config.inc.php';
Dispatcher::getInstanse()->dispatch();
Dispatcher::getInstanse()->controller_type = 0;

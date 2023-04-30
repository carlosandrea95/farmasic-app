<?php
require_once 'config/config.inc.php';
// echo Storage::get('products', '1', '1ra.Acetaminofen-500mg-x-20-tabletas.jpg') . '<br />';
// exit;
Dispatcher::getInstanse()->dispatch();
Dispatcher::getInstanse()->controller_type = 0;

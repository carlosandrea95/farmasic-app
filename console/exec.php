<?php
if (!defined('ROOT_DIR')) {
   define('ROOT_DIR', realpath(dirname('../../') . '/.'));
}
require_once '../vendor/autoload.php';
Cron::init();

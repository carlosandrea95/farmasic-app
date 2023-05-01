
<?php
// echo ROOT_DIR . '/config/parameters.php';
// exit;

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();

$dotenv->load(CURRENT_DIR . '/.env');

$dotenv->loadEnv(CURRENT_DIR . '/.env');

// NEW ENVIRONMENT VARIABLES

define('_DB_HOST_',  $_ENV['DB_HOST']);
define('_DB_NAME_',  $_ENV['DB_NAME']);
define('_DB_PORT_',  $_ENV['DB_PORT']);
define('_DB_USER_',  $_ENV['DB_USER']);
define('_DB_PASSWD_', $_ENV['DB_PASSWD']);
define('_DB_ENGINE_', $_ENV['DB_ENGINE']);
define('_DB_PREFIX_', $_ENV['DB_PREFIX']);
define('_DB_CHARSET_', $_ENV['DB_CHARSET']);
define('_CACHING_SYSTEM_', $_ENV['CACHING_SYSTEM']);
define('_CACHE_LIFETIME_', $_ENV['CACHE_LIFETIME']);
define('_DB_FETCH_',  PDO::FETCH_ASSOC);

if (!defined('APP_VERSION')) {
  define('APP_VERSION', Configuration::get('APP_VERSION'));
}

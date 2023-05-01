
<?php

use Symfony\Component\Dotenv\Dotenv;

// if server name is localhost, then we are in development environment else don't load .env files and use the environment variables from the server
if ($_SERVER['SERVER_NAME'] == 'localhost' || 'app.drovazca.local') {
  $dotenv = new Dotenv();
  $dotenv->load(CURRENT_DIR . '/.env');
  $DB_HOST = $_ENV['DB_HOST'];
  $DB_NAME = $_ENV['DB_NAME'];
  $DB_PORT = $_ENV['DB_PORT'];
  $DB_USER = $_ENV['DB_USER'];
  $DB_PASSWD = $_ENV['DB_PASSWD'];
  $DB_ENGINE = $_ENV['DB_ENGINE'];
  $DB_PREFIX = $_ENV['DB_PREFIX'];
  $DB_CHARSET = $_ENV['DB_CHARSET'];
  $CACHING_SYSTEM = $_ENV['CACHING_SYSTEM'];
  $CACHE_LIFETIME = $_ENV['CACHE_LIFETIME'];
} else {
  $DB_HOST = getenv('DB_HOST');
  $DB_NAME = getenv('DB_NAME');
  $DB_PORT = getenv('DB_PORT');
  $DB_USER = getenv('DB_USER');
  $DB_PASSWD = getenv('DB_PASSWD');
  $DB_ENGINE = getenv('DB_ENGINE');
  $DB_PREFIX = getenv('DB_PREFIX');
  $DB_CHARSET = getenv('DB_CHARSET');
  $CACHING_SYSTEM = getenv('CACHING_SYSTEM');
  $CACHE_LIFETIME = getenv('CACHE_LIFETIME');
}
// NEW ENVIRONMENT VARIABLES

define('_DB_HOST_', $DB_HOST);
define('_DB_NAME_',  $DB_NAME);
define('_DB_PORT_',  $DB_PORT);
define('_DB_USER_',  $DB_USER);
define('_DB_PASSWD_', $DB_PASSWD);
define('_DB_ENGINE_', $DB_ENGINE);
define('_DB_PREFIX_', $DB_PREFIX);
define('_DB_CHARSET_', $DB_CHARSET);
define('_CACHING_SYSTEM_', $CACHING_SYSTEM);
define('_CACHE_LIFETIME_', $CACHE_LIFETIME);

define('_DB_FETCH_',  PDO::FETCH_ASSOC);

if (!defined('APP_VERSION')) {
  define('APP_VERSION', Configuration::get('APP_VERSION'));
}

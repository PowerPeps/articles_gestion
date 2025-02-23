<?php
$config = require 'config.php';

// user_config :
define("USER_DB_CONNECT", $config['user_conf']['db']['dsn']);
define("USER_DB_USER", $config['user_conf']['db']['user']);
define("USER_DB_PASSWORD", $config['user_conf']['db']['password']);

define("ROOT_LEVEL", $config['user_conf']['roles']['root_level']);
define("ADMIN_LEVEL", $config['user_conf']['roles']['admin_level']);
define("USER_LEVEL", $config['user_conf']['roles']['user_level']);
define("GUEST_LEVEL", $config['user_conf']['roles']['guest_level']);

// Release_config :
define("RELEASE_DB_CONNECT", $config['release_conf']['db']['dsn']);
define("RELEASE_DB_USER", $config['release_conf']['db']['user']);
define("RELEASE_DB_PASSWORD", $config['release_conf']['db']['password']);

define("RELEASE_LIMIT_LAST_ARTICLE", $config['release_conf']['limit_last_articles']);


// language config :
define("DEFAULT_LANGUAGE", $config['language_conf']['default_language']);


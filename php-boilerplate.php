<?php
/**
 * php-bolierplate | Milos Dakonovic @dknvc
 * A generic, minimalistic boilerplate for php applications.
**/

/**
 * I.
 * Define some useful constants, $conf global variable, get
 * app's configuration from a file.
 * 
 *  DS, eol, crlf - a shorter aliases
 *  APP_ROOT - points to base directory of application
 *  LOGDIR   - application logs directory
 *  DATADIR  - a various data directory
**/
define('DS',       DIRECTORY_SEPARATOR);
define('eol',      PHP_EOL);
define('crlf',     "\r\n");

define('APP_ROOT', __DIR__);
define('LOGDIR',  APP_ROOT . DS . 'log' );
define('DATADIR', APP_ROOT . DS . 'data');

$GLOBALS['conf'] = [];

if(file_exists(APP_ROOT . DS . 'conf' . DS . 'application.ini')){
    $GLOBALS['conf'] = parse_ini_file(APP_ROOT . DS . 'conf' . DS . 'application.ini');
}

// --------------------------------------------------------------------------------------------------------------------------------------

/**
 * II.
 * (re)set some very basic values, like memory limit, timeout, error logging, include path.
 */
#Memory limit, 128MB default
(!isset($GLOBALS['conf']['memory_limit'])) ? ini_set('memory_limit', '128M') : ini_set('memory_limit', $GLOBALS['conf']['memory_limit']);

#Time limit, 600 seconds default
(!isset($GLOBALS['conf']['time_limit'])) ? set_time_limit(600) : set_time_limit($GLOBALS['conf']['time_limit']);

#Log errors, to a certain place:
ini_set('log_errors', 1);
ini_set('error_log', APP_ROOT . DS . 'log' . DS . 'error.log');

#Miscellaneous assets to include path, i.e. require('awesomestuff.php'); includes/awesomestuff.php
set_include_path(get_include_path() . PATH_SEPARATOR . APP_ROOT . DS . 'includes');

// --------------------------------------------------------------------------------------------------------------------------------------

/**
 * III.
 * Determinate environment type and define additional constants:
 * 
 *  OS      - WIN  or *nix
 *  REQTYPE - web  or command line
 *  APPENV  - prod or devtest
**/
if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
    define('OS', 'win');
} else {
    define('OS', 'nix');
}

if(
    defined('STDIN') ||
    php_sapi_name() === 'cli' ||
    array_key_exists('SHELL', $_ENV) ||
    (empty($_SERVER['REMOTE_ADDR']) and !isset($_SERVER['HTTP_USER_AGENT']) and count($_SERVER['argv']) > 0) ||
    !array_key_exists('REQUEST_METHOD', $_SERVER)
){
    define('REQTYPE', 'cli');
} else {
    define('REQTYPE', 'web');
    ob_start();
}


if( isset($conf['prod']) && $conf['prod'] === '1'){
    define('APPENV', 'prod');
    error_reporting(E_ERROR|E_PARSE);
    ini_set('display_errors', 0);
} else {
    define('APPENV', 'devtest');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// --------------------------------------------------------------------------------------------------------------------------------------

/**
 * IV.
 * Set basic autoload to classes directory.
**/
spl_autoload_register(function($class){
    include 'classes' . DS . 'class_' . $class . '.php';
});

// --------------------------------------------------------------------------------------------------------------------------------------

/**
 * V.
 * There you go. Happy coding!
 * 
 * The recommended way is not to start from here/write to this file,
 * but to simply start with your own blank php script,
 * i.e.
 * put the:
 * require_once(__DIR__ . DIRECTORY_SEPARATOR . 'php-boilerplate.php');
 * at the very start of your script.
 * 
**/

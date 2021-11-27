<?php

if(!defined('APP_ROOT')){
    die('No direct access.' . PHP_EOL);
}

class CLI{

    public static $values = [];

    /**
     * Simple output with linebreak
    **/
    public static function writeln($str){
        echo $str . PHP_EOL;
        return true;
    }

    /**
     * Simple line to STDERR
    **/
    public static function stderrLn($str){
        return fwrite(STDERR, $str . PHP_EOL);
    }

    /**
     * Returns an [] with args processed
     * Example:
     *  php php-boilerplate.php d b=1 c --debug=1
     *  array(4) {
     *      [0]         => "d"
     *      ["b"]       => "1"
     *      [1]         => "c"
     *      ["--debug"] => "1"
     *  }
     * 
    **/
    public static function parseParams(){
        $forReturn = [];
        foreach($GLOBALS['argv'] as $key => $argument){
            if($key === 0) continue;

            if(strstr($argument, '=')){
                $kevalue = explode('=', $argument);
                $forReturn[$kevalue[0]] = $kevalue[1];
            } else {
                $forReturn[] = $argument;
            }
        }
        return $forReturn;
    }

    // Just a tiny stdin wrapper, usage CLI::stdin();
    public static function stdin(){
        return file_get_contents("php://stdin");
    }

    /**
     * Read user input
     * @argument $promptText | string | either prompt text when called with two arguments
     * or prompt value identifier
     * @argument $promptName | string | prompt value identifier
    **/
    public static function read($promptText=false, $promptName=false){
        if(!$promptName){
            return self::$values[$promptText];
        }
        self::writeln($promptText);
        $line = readline();
        readline_add_history($line);
        self::$values[$promptName] = $line;
    }

    /**
     * 
     * Simple wrapper around PHP's exec function
     * @argument $command   | string | a command to execute
     * @argument $arguments | array  | optional arguments (to be sanitized)
     * 
     * @return array 
     * [
     *  'output'
     *  'status'
     * ]
     * 
     * Usage:
     * CLI::exec('whoami');
     * CLI::exec('command', ['param1', 'param2']);
     * 
    **/
    public static function exec($command, $arguments = []){
        $ret = [];
        if(empty($arguments)){
            exec($command, $output, $retval);
        } else {
            foreach($arguments as $key => $arg){
                $arguments[$key] = escapeshellarg($arg);
            }
            $arguments = implode(' ', $arguments);
            exec($command . ' ' . $arguments, $output, $retval);
        }
        $ret['output'] = implode(eol, $output);
        $ret['status'] = $retval;        
        return $ret;
    }

}
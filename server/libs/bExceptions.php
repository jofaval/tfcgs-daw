<?php
class ExceptionUtils
{
    public static function tryCatch($class, $function)
    {
        try {
            if (method_exists($class, $function)) {
                return call_user_func([new $class, $function]);
            } else {
                header("Location: ./index.php?ctl=error");
            }
        } catch (Exception $exception) {
            writeToLog("Exception", "Exception happend at " . microtime() . " with message (" . $exception->getMessage() . ")." . PHP_EOL);
            header("Location: ./index.php?ctl=error");
            var_dump($e);
        } catch (Error $e) {
            writeToLog("Error", "Error with number " . ($errno) . " happend at " . microtime() . " with message (" . ($e->$errstr) . ") inside \"" . ($e->$errfile) . "\" file at line " . ($e . $errline) . "." . PHP_EOL);
            header("Location: ./index.php?ctl=error");
        }

        return null;
    }
}

function writeToLog($log, $message)
{
    $fw = fopen(__DIR__ . "/../server/logs/log$log.txt" . "a+");
    fwrite($fw, $message);
    fclose($fw);
}

if (!Config::$developmentMode) {
    set_error_handler("errorAction");
    set_exception_handler("expcetionHandler");
}

function expcetionHandler($exception)
{
    writeToLog("Exception", "Exception happend at " . microtime() . " with message (" . $exception->getMessage() . ")." . PHP_EOL);
    header("Location: ./index.php?ctl=error");
}

function errorAction($errno = -1, $errstr = "", $errfile = "", $errline = 0)
{
    writeToLog("Error", "Error with number " . ($errno) . " happend at " . microtime() . " with message (" . ($errstr) . ") inside \"" . ($errfile) . "\" file at line " . ($errline) . "." . PHP_EOL);
    header("Location: ./index.php?ctl=error");
}
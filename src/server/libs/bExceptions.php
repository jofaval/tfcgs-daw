<?php
class ExceptionUtils
{
    public static function tryCatch($class, $function)
    {
        try {
            if (method_exists($class, $function)) {
                return call_user_func([new $class, $function]);
            } else {
                header("Location: " . Config::$EXECUTION_HOME_PATH . "error/");
            }
        } catch (Exception $exception) {
            writeToLog("Exception", "Exception happend at " . microtime() . " with message (" . $exception->getMessage() . ")." . PHP_EOL);

            if (!Config::$developmentMode) {
                header("Location: " . Config::$EXECUTION_HOME_PATH . "error/");
            } else {
                echo "error";
                echo "<style>
                    * { color: #ccc !important; }
                    </style>";
                echo "<pre>";
                var_dump($exception);
                echo "</pre>";
            }
        } catch (Error $e) {
            writeToLog("Error", "Error with number " . ($errno) . " happend at " . microtime() . " with message (" . ($e->$errstr) . ") inside \"" . ($e->$errfile) . "\" file at line " . ($e . $errline) . "." . PHP_EOL);

            if (!Config::$developmentMode) {
                header("Location: " . Config::$EXECUTION_HOME_PATH . "error/");
            } else {
                echo "error";
                echo "<style>
                    * { color: #ccc !important; }
                    </style>";
                echo "<pre>";
                var_dump($e);
                echo "</pre>";
            }
        }

        return null;
    }
}

function writeToLog($log, $message)
{
    $fw = fopen(SystemPaths::SERVER_LOGS_PATH . "/log$log.txt" . "a+");
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

    if (!Config::$developmentMode) {
        header("Location: " . Config::$EXECUTION_HOME_PATH . "error/");
    } else {
        echo "error";
        echo "<style>
            * { color: #ccc !important; }
            </style>";
        echo "<pre>";
        var_dump($exception);
        echo "</pre>";
    }
}

function errorAction($errno = -1, $errstr = "", $errfile = "", $errline = 0)
{
    writeToLog("Error", "Error with number " . ($errno) . " happend at " . microtime() . " with message (" . ($errstr) . ") inside \"" . ($errfile) . "\" file at line " . ($errline) . "." . PHP_EOL);

    if (!Config::$developmentMode) {
        header("Location: " . Config::$EXECUTION_HOME_PATH . "error/");
    } else {
        echo "error";
        echo "<style>
            * { color: #ccc !important; }
            </style>";
        echo "<pre>";
        var_dump("Error with number " . ($errno) . " happend at " . microtime() . " with message (" . ($errstr) . ") inside \"" . ($errfile) . "\" file at line " . ($errline) . ".");
        echo "</pre>";
    }
}
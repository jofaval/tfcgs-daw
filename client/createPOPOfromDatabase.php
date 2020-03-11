<?php

//ENTER THE RELEVANT INFO BELOW
$mysqlUserName = "test";
$mysqlPassword = "";
$mysqlHostName = "localhost";
$DbName = "database_proyecto_daw_2020";
$backup_name = "mybackup.sql";
$tables = array("schedules", "specialDays", "nonWorkWeeklyDays", "users", "classrooms", "events");

//or add 5th parameter(array) of specific tables:    array("mytable1","mytable2","mytable3") for multiple tables

Export_Database($mysqlHostName, $mysqlUserName, $mysqlPassword, $DbName, $tables = false, $backup_name = false);

function Export_Database($host, $user, $pass, $name, $tables = false, $backup_name = false)
{
    $mysqli = new mysqli($host, $user, $pass, $name);
    $mysqli->select_db($name);
    $mysqli->query("SET NAMES 'utf8'");

    $queryTables = $mysqli->query('SHOW TABLES');
    while ($row = $queryTables->fetch_row()) {
        $target_tables[] = $row[0];
    }
    if ($tables !== false) {
        $target_tables = array_intersect($target_tables, $tables);
    }
    $filesContent = [];
    foreach ($target_tables as $table) {
        $content = "";

        $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
        $TableMLine = $res->fetch_row()[1];
        $splittedLine = explode("\n", $TableMLine);
        unset($splittedLine[0]);
        unset($splittedLine[count($splittedLine)]);

        $primaryKeys = [];
        $tableKeys = [];
        $foreignKeys = [];

        foreach ($splittedLine as $value) {
            $value = trim($value);
            if (!$value) {
                continue;
            }
            $match = [];
            if (preg_match("/^\`/i", $value)) {
                preg_match("/`.+`/i", $value, $match);
                $tableKeys[] = str_replace("`", "", $match[0]);
            } else if (preg_match("/^PRIMARY KEY/i", $value, $match)) {
                preg_match("/`.+`/i", $value, $match);
                $primaryKeys[] = str_replace("`", "", $match[0]);
            } else if (preg_match("/^CONSTRAINT/i", $value, $match)) {
                preg_match("/`.+`/i", $value, $match);
                $foreignKeys[] = str_replace("`", "", $match[0]);
            }
        }

        foreach ($primaryKeys as $primaryKey) {
            foreach ($tableKeys as $key => $tableKey) {
                if ($tableKey == $primaryKey) {
                    unset($tableKeys[$key]);
                }
                break;
            }
        }

        foreach ($foreignKeys as $foreignKey) {
            foreach ($tableKeys as $key => $tableKey) {
                if ($tableKey == $foreignKey) {
                    unset($tableKeys[$key]);
                }
                break;
            }
        }

        //Table value
        if (false) {
            echo "<h1>$table</h1>";
            echo "<pre>";
            var_dump($splittedLine);
            echo "</pre>";

            echo "<pre>";
            echo "<h2>primaryKeys</h2>";
            var_dump($primaryKeys);
            echo "<h2>tableKeys</h2>";
            var_dump($tableKeys);
            echo "<h2>foreignKeys</h2>";
            var_dump($foreignKeys);
            echo "</pre>";
        }

        $content .= "\n\nclass " . camelCase($table, true) . "\n implements CRUD {\n\tprivate \$table = \"$table\";
        \n";

        $content .= "\t//Primary Keys";
        foreach ($primaryKeys as $value) {
            $content .= "\n\tprivate \$$value;";
        }

        $content .= "\n\n\t//Table Keys";
        foreach ($tableKeys as $value) {
            $content .= "\n\tprivate \$$value;";
        }

        $content .= "\n\n\t//Foreign Keys";
        foreach ($foreignKeys as $value) {
            $content .= "\n\tprivate \$$value;";
        }

        $content .= "\n\n";
        $everyKey = array_merge($primaryKeys, $tableKeys, $foreignKeys);
        $content .= "
        public function create()
        {
            \$sqlUtils = new SQLUtils(Model::getInstance());

            \$params = [";
        foreach ($everyKey as $value) {
            $content .= "\n\t\t\"$value\" => \$this->\$$value,";
        }
        $content .= "
            ];

            return \$sqlUtils->insert(\$params);
        }";

        $content .= "\n
        public function update()
        {
            \$sqlUtils = new SQLUtils(Model::getInstance());

            \$toModify = [";
        foreach ($tableKeys as $value) {
            $content .= "\n\t\t\"$value\" => \$this->\$$value,";
        }
        foreach ($foreignKeys as $value) {
            $content .= "\n\t\t\"$value\" => \$this->\$$value,";
        }
        $content .= "
            ];

            \$identificationParams = [";
        foreach ($primaryKeys as $value) {
            $content .= "\n\t\t\"$value\" => \$this->\$$value,";
        }
        $content .= "
            ];

            return \$sqlUtils->update(\$this->\$table, \$toModify, \$identificationParams);
        }";

        $content .= "

        public function delete()
        {
            \$sqlUtils = new SQLUtils(Model::getInstance());

            \$params = [";
        foreach ($primaryKeys as $value) {
            $content .= "\n\t\t\"$value\" => \$this->\$$value,";
        }
        $content .= "
            ];

            return \$sqlUtils->delete(\$this->\$table, \$params);
        }";

        $content .= "

        public function query()
        {
            \$sqlUtils = new SQLUtils(Model::getInstance());

            \$params = [";
        foreach ($primaryKeys as $value) {
            $content .= "\n\t\t\"$value\" => \$this->\$$value,";
        }
        $content .= "
            ];

            return \$sqlUtils->query(\$this->\$table, \$params);
        }";

        $content .= "

        public function fill()
        {";
        foreach ($everyKey as $value) {
            $content .= "\n\t\t\$this->\$$value = Utils::getCleanedData(\"" . camelCase($value) . "\"),";
        }
        $content .= "
        }";

        $content .= "

        public function parse()
        {
            return json_encode([";
        foreach ($tableKeys as $value) {
            $content .= "\n\t\t\"" . camelCase($value) . "\" => \$this->\$$value,";
        }
        foreach ($foreignKeys as $value) {
            $content .= "\n\t\t\"" . camelCase($value) . "\" => \$this->\$$value,";
        }
        $content .= "
            ]);
        }";

        //$content .= "\n\n" . $TableMLine . ";\n\n";

        $content .= "\n} \n\n\n";

        $filesContent[camelCase($table, true)] = $content;
        //break;
    }

    $backup_name = $backup_name ? $backup_name : $name . ".sql";

    echo "<h1>Clases</h1>";
    echo "<pre>";
    var_dump($filesContent);
    echo "</pre>";

    foreach ($filesContent as $key => $value) {
        $fileWriter = fopen(__DIR__ . "/../server/classes/POPOs/" . "$key.php", "w+");
        fwrite($fileWriter, str_replace("\n", PHP_EOL, $value));
        fclose($fileWriter);
    }
    //echo __DIR__ . "/../server/classes/POPOs/";
}

function camelCase($string, $firstLetterCapital = false)
{
    if (!$string) {
        return $string;
    }
    $explodedString = preg_split("/[\ \_\-]/", $string);

    foreach ($explodedString as $key => $value) {
        $value = strtolower($value);
        $value[0] = strtoupper($value[0]);
        $explodedString[$key] = $value;
    }

    $parsedString = join("", $explodedString);

    if ($firstLetterCapital) {
        $parsedString[0] = strtoupper($parsedString[0]);
    } else {
        $parsedString[0] = strtolower($parsedString[0]);
    }

    return $parsedString;
}

?>
<form action="">
    <textarea name="sqlScript" id="sqlScript" cols="30" rows="10"></textarea>
</form>
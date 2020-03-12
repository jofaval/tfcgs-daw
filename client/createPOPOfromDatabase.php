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
            } else if (preg_match("/^PRIMARY KEY/i", $value)) {
                preg_match("/`.+`/i", $value, $match);
                $primaryKeys = array_merge($primaryKeys, explode(",", str_replace("`", "", $match[0])));
            } else if (preg_match("/^CONSTRAINT/i", $value)) {
                preg_match("/(?=FOREIGN KEY \(`).+(?<=`\) REFERENCES)/", $value, $match);
                print_r($match);
                $foreignKey = preg_replace("/(FOREIGN KEY \(`|`\) REFERENCES)/", "", $match[0]);
                $foreignKeys = array_merge($primaryKeys, explode(",", $foreignKey));
                //$foreignKeys[] = $match;
            }
        }

        $tableKeys = array_diff($tableKeys, $foreignKeys);
        $tableKeys = array_diff($tableKeys, $primaryKeys);
        $foreignKeys = array_diff($foreignKeys, $primaryKeys);
        /* foreach ($foreignKeys as $foreignKeyValue) {
        foreach ($tableKeys as $key => $tableKey) {
        if ($tableKey == $foreignKeyValue) {
        unset($tableKeys[$key]);
        }
        break;
        }
        }

        foreach ($primaryKeys as $primaryKey) {
        foreach ($tableKeys as $keyId => $tableKey) {
        if ($tableKey == $primaryKey) {
        unset($tableKeys[$keyId]);
        }
        break;
        }
        foreach ($foreignKeys as $keyId => $foreignKeyValue) {
        if ($foreignKeyValue == $primaryKey) {
        unset($foreignKeys[$keyId]);
        }
        break;
        }
        } */

        //Table value
        if (true) {
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

        $content .= "<?php\n\nclass " . camelCase($table, true) . " implements CRUD \n{\n\tprivate \$table = \"$table\";\n\n";

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

        $content .= "\n";
        $everyKey = array_merge($primaryKeys, $tableKeys, $foreignKeys);

        //Create
        $content .= "\n\tpublic function create()\n\t{\n\t\t\$sqlUtils = new SQLUtils(Model::getInstance());\n\n\t\t\$params = [";
        foreach ($everyKey as $value) {
            $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
        }
        $content .= "\n\t\t];\n\n\t\treturn \$sqlUtils->insert(\$params);\n\t}";

        //Update
        $content .= "\n\n\tpublic function update()\n\t{\n\t\t\$sqlUtils = new SQLUtils(Model::getInstance());\n\n\t\t\$toModify = [";
        foreach ($tableKeys as $value) {
            $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
        }
        foreach ($foreignKeys as $value) {
            $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
        }
        $content .= "\n\t\t];";

        $content .= "\n\n\t\t\$identificationParams = [";
        foreach ($primaryKeys as $value) {
            $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
        }
        $content .= "\n\t\t];\n\n\t\treturn \$sqlUtils->update(\$this->\$table, \$toModify, \$identificationParams);\n\t}";

        //Delete
        $content .= "\n\n\tpublic function delete()\n\t{\n\t\t\$sqlUtils = new SQLUtils(Model::getInstance());\n\n\t\t\$params = [";

        foreach ($primaryKeys as $value) {
            $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
        }
        $content .= "\n\t\t];\n\n\t\treturn \$sqlUtils->delete(\$this->\$table, \$params);\n\t}";

        //Query
        $content .= "\n\n\tpublic function query()\n\t{\n\t\t\$sqlUtils = new SQLUtils(Model::getInstance());\n\n\t\t\$params = [";

        foreach ($primaryKeys as $value) {
            $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
        }
        $content .= "\n\t\t];\n\n\t\treturn \$sqlUtils->query(\$this->\$table, \$params);\n\t}";

        //Fill
        $content .= "\n\n\n\tpublic function fill()\n\t{";
        foreach ($everyKey as $value) {
            $content .= "\n\t\t\$this->\$$value = Utils::getCleanedData(\"" . camelCase($value) . "\");";
        }
        $content .= "\n\t}";

        $content .= "\n\n\n\tpublic function fill()\n\t{\n\t\treturn json_encode([";
        foreach ($everyKey as $value) {
            $content .= "\n\t\t\t\"" . camelCase($value) . "\" => \$this->\$$value,";
        }
        $content .= "\n\t\t]);\n\t}";

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
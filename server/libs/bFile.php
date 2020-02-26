<?php
class FileUtils
{
    public static function validateFile($fileName, $path, $username, &$errors = [])
    {
        $final_file_name = false;
        if ($_FILES[$fileName]['error'] != 0) {
            $errors[] = 'Error: ';
            switch ($_FILES[$fileName]['error']) {
                case 1:
                    $errors[] = "UPLOAD_ERR_INI_SIZE <br>";
                    $errors[] = "Fichero demasiado grande<br>";
                    break;
                case 2:
                    $errors[] = "UPLOAD_ERR_FORM_SIZE<br>";
                    $errors[] = 'El fichero es demasiado grande<br>';
                    break;
                case 3:
                    $errors[] = "UPLOAD_ERR_PARTIAL<br>";
                    $errors[] = 'El fichero no se ha podido subir entero<br>';
                    break;
                case 4:
                    $errors[] = "UPLOAD_ERR_NO_FILE<br>";
                    $errors[] = 'No se ha podido subir el fichero<br>';
                    break;
                case 6:
                    $errors[] = "UPLOAD_ERR_NO_TMP_DIR<br>";
                    $errors[] = "Falta carpeta temporal<br>";
                case 7:
                    $errors[] = "UPLOAD_ERR_CANT_WRITE<br>";
                    $errors[] = "No se ha podido escribir en el disco<br>";

                default:
                    $errors[] = 'Error indeterminado.';
            }
            $final_file_name = false;
        } else {
            // Sino ha habido errores en la subida
            /*
             * Comprobamos que el fichero es del tipo que esperamos.
             * Tener en cuenta que este tipo viene determinado por lo que envía el navegador del usuario, no es del todo
             * segura
             */
            // Podríamos comprobar con un array de posibles tipos válidos

            //jpge
            if (!in_array($_FILES[$fileName]['type'], Config::$mvc_img_exts)) {
                $errors[] = 'Error: No se puede mover el fichero a su destino';
                $final_file_name = false;
            } else { // Si el formato es el esperado lo guardaremos definitivamente
                /*
                 * Comprobamos si ya existe un archivo con este nombre en el destino,
                 * si es así, establecemos un nombre no repetido.
                 */
                $nombre = $_FILES[$fileName]['name'];
                $explodedNombre = $nombre . explode(".");
                $nombre = "$username.$explodedNombre[1]";
                if (is_file($path . $nombre) === true) {
                    // Añadimos el tiempo para asegurarnos que el nombre es único
                    $idUnico = time();
                    $nombre = $path . $idUnico . '_' . $nombre;
                } else {
                    $nombre = $path . $nombre;
                }
                // Movemos el fichero a su nueva ubicación
                if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $nombre)) {
                    // Muestro la imagen.
                    $final_file_name = $nombre;
                } else {
                    $errors[] = 'Error: No se puede mover el fichero a su destino';
                    $final_file_name = false;
                }
            }
        }

        return $final_file_name;
    }
}
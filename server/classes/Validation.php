<?php

/**
 * Clase para realizar validaciones en el modelo
 * Es utilizada para realizar validaciones en el modelo de nuestras clases.
 *
 * @author Carlos Belisario
 */
class Validation
{

    protected $_atributos;

    protected $_error;

    public $mensaje;

    public static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Validation();
        }

        return self::$instance;
    }

    /**
     * Metodo para indicar la regla de validacion
     * El método retorna un valor verdadero si la validación es correcta, de lo contrario retorna el objeto
     * actual, permitiendo acceder al atributo Validacion::$mensaje ya que es publico
     */
    public function rules($rule = array(), $data)
    {
        if (!is_array($rule)) {
            $this->mensaje = "the rules must be in arrangement format";
            return $this;
        }
        foreach ($rule as $key => $rules) {
            $reglas = explode(',', $rules['regla']);
            if (array_key_exists($rules['name'], $data)) {
                foreach ($data as $indice => $valor) {
                    if ($indice === $rules['name']) {
                        foreach ($reglas as $clave => $valores) {
                            $validator = $this->_getInflectedName($valores);
                            if (!is_callable(array($this, $validator))) {
                                throw new BadMethodCallException("Didn't found the method $valores");
                            }
                            $respuesta = $this->$validator($rules['name'], $valor);
                        }
                        break;
                    }
                }
            } else {

                $this->mensaje[$rules['name']] = "The field {$rules['name']} is not inside a validartion rule nor in the form";
            }
        }
        if (!empty($this->mensaje)) {
            return $this;
        } else {
            return true;
        }
    }

    /**
     * Metodo inflector de la clase
     * por medio de este metodo llamamos a las reglas de validacion que se generen
     */
    private function _getInflectedName($text)
    {
        $validator = "";
        $_validator = preg_replace('/[^A-Za-z0-9]+/', ' ', $text);
        $arrayValidator = explode(' ', $_validator);
        if (count($arrayValidator) > 1) {
            foreach ($arrayValidator as $key => $value) {
                if ($key == 0) {
                    $validator .= "_" . $value;
                } else {
                    $validator .= ucwords($value);
                }
            }
        } else {
            $validator = "_" . $_validator;
        }

        return $validator;
    }

    /**
     * Metodo de verificacion de que el dato no este vacio o NULL
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _noEmpty($campo, $valor)
    {
        if (isset($valor) && !empty($valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The field $campo must be filled";
            return false;
        }
    }

    /**
     * Metodo de verificacion de tipo numerico
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _numeric($campo, $valor)
    {
        if (is_numeric($valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The field $campo must be numeric";
            return false;
        }
    }

    /**
     * Metodo de verificacion de tipo email
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _email($campo, $valor)
    {
        if (preg_match("/^[a-z]+([\.]?[a-z0-9_-]+)*@[a-z\.0-9]+\.[a-z\.0-9]+$/i", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The field $campo must follow the email pattern user@domain.org";
            return false;
        }
    }

    protected function _datetime($campo, $valor)
    {
        if (isset($valor) && preg_match("/^[0-9]{1,2}[:][0-9]{1,2}$/", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The field $campo must follow the datetime pattern 2020-02-02 20:20:20";
            return false;
        }
    }

    protected function _date($campo, $valor)
    {
        if (isset($valor) && preg_match("/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The field $campo must follow the datetime pattern 2020-12-13";
            return false;
        }
    }

    protected function _name($campo, $valor)
    {
        if (isset($valor) && preg_match("/^[a-zñ\ \º\ª]{0,50}$/iu", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The field $campo must be a name";
            return false;
        }
    }

    protected function _password($campo, $valor)
    {
        //if (isset($valor) && preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,24}$/i", $valor)) {
        if (isset($valor) && preg_match("/^[A-Za-z\d@$!%*?&]{3,24}$/i", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The field $campo must be alphanumeric, only certain special characters are allowed";
            return false;
        }
    }

    protected function _state($campo, $valor)
    {
        if (isset($valor) && in_array($valor, ["perfect", "on_repair", "left_out"])) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The field $campo must be either \"perfect\", \"on_repair\" or \"left_out\"";
            return false;
        }
    }

    protected function _text($campo, $valor)
    {
        if (isset($valor) && preg_match("/^[a-zñ\ \º\ª]+$/ium", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The field $campo must be a text";
            return false;
        }
    }

    protected function _username($campo, $valor)
    {
        if (isset($valor) && preg_match("/^[a-z0-9_-]{3,24}$/i", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The field $campo must be alphanumeric with \"_\" and \"-\" as an exception";
            return false;
        }
    }

    protected function _image($campo, $valor)
    {
        if (isset($valor) && preg_match("/.+[\.jpg|\.jpeg|\.png|\.gif]$/i", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The field $campo must be alphanumeric with \"_\" and \"-\" as an exception";
            return false;
        }
    }
}

// el uso de la clase es muy sencillo os dejo las pruebas que realice a la clase

/* $_POST['campo1'] = "d";
$_POST['campo2'] = "usuariohotmail.com";
$datos = $_POST;
$validacion = new Validation();
$regla = array(
array(
'name' => 'campo2',
'regla' => 'no-empty,email',
),
array(
'name' => 'campo1',
'regla' => 'no-empty,numeric',
),

);
$validaciones = $validacion->rules($regla, $datos); */
//print_r($validaciones);
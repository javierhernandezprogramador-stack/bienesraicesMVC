<?php

namespace Model;

use mysqli_sql_exception;

class ActiveRecord
{
    //Base de datos
    protected static $db;
    protected static $columnaDB = [];
    protected static $tabla = '';

    //url
    protected static $urlBase;

    //Errores
    protected static $errores = [];

    //Definir la conexion a la base de datos
    public static function setDB($database, $url)
    {
        self::$db = $database;
        self::$urlBase = $url;
    }

    public function guardar()
    {
        if (isset($this->id)) { //si existe un id es porque estamos actualizando
            return $this->actualizar();
        } else {
            return $this->crear();
        }
    }

    public function actualizar()
    {
        //sanitzar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "$key = '$value'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function crear()
    {

        //sanitzar los datos
        $atributos = $this->sanitizarAtributos();

        $string = join(', ', array_values($atributos));

        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES(' ";
        $query .= join("', '", array_values($atributos));
        $query .= "' )";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    //Eliminar un registro
    public function eliminar()
    {

        try {

            $query = "DELETE FROM " . static::$tabla . " WHERE id ='" . self::$db->escape_string($this->id) . "' LIMIT 1";
            $resultado = self::$db->query($query);

            return $resultado;
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }

    //Identificar y unir los atributos de la DB
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnaDB as $columna) {
            if ($columna === 'id') continue; //Esto hace que lo ignore
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        //Forma que me permite obtener el nombre asociativo ($key) y el valor del campo ($value)
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    //Validaciones
    public static function getErrores()
    {
        return static::$errores;
    }

    //subida de archivos
    public function setImagen($imagen)
    {
        //Elimina la imagen previa
        if (isset($this->id)) {
            //comprobar que exista un archivo en el servidor
            $this->borrarImagen();
        }

        //Asignar a la imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar imagen
    public function borrarImagen()
    {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    //Lista todos los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //obtiene determinado numero de registros
    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . ' LIMIT ' . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado); //retorna el primer elemento de un arreglo

    }

    public static function consultarSQL($query)
    {
        //consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //liberar memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static; //Instancia un objeto en la clase que se esta heredando

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) { //con $this accedo a mi objeto actual
                $this->$key = $value;
            }
        }
    }
}

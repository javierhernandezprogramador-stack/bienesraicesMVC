<?php

namespace Model;

class Vendedor extends ActiveRecord
{
    //Colocamos el nombre de la tabla de la base de datos
    protected static $tabla = 'vendedores';
    protected static $columnaDB = [
        'id',
        'nombre',
        'apellido',
        'telefono',
        'email',
        'imagen'
    ];
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }

        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }

        if (!$this->telefono) {
            self::$errores[] = "El teléfono es obligatorio";
        }

        if (!$this->email) {
            self::$errores[] = "El correo es obligatorio";
        }


        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        //Expresion regular es buscar un patron dentro de un texto
        if (!preg_match('/[0-9]{8}/', $this->telefono)) {
            self::$errores[] = "Formato de teléfono no valido";
        }

        //Expresion regular para validar un correo
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->email)) {
            self::$errores[] = "Formato de correo no valido";
        }

        return self::$errores;
    }
}

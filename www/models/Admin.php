<?php

namespace Model;

class Admin extends ActiveRecord
{

    //Bases de datos
    protected static $tabla = 'admin';
    protected static $columnaDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = 'El email es obligatorio';
        }

        if (!$this->password) {
            self::$errores[] = 'El password es obligatorio';
        }

        return self::$errores;
    }
}

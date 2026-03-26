<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros()
    {
        debuguear("acceso a nosotros");
    }

    public static function propiedades()
    {
        debuguear("acceso a propiedades");
    }

    public static function propiedad()
    {
        debuguear("acceso a propiedad");
    }

    public static function blog()
    {
        debuguear("acceso a blog");
    }

    public static function entrada()
    {
        debuguear("acceso a entrada");
    }

    public static function contacto()
    {
        debuguear("acceso a contacto");
    }
}

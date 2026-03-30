<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        $auth = $_SESSION['login'] ?? null;

        //arreglo de rutas protegidas
        $rutas_protegidas = ['/propiedades/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/admin', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $url = $_SERVER['REQUEST_URI'] ?? '/';
        $urlActual = strtok($url, '?');

        $metodo =  $_SERVER['REQUEST_METHOD'];

        if ($metodo == "GET") {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //proteger las rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) { //verifica si un elemento existe en el array
            header("Location: /");
        }

        if ($fn) {
            //la URL existe y hay una función asociada
            call_user_func($fn, $this); //llamar una función que no sabemos como se llama
        } else {
            echo "Pagina no encontrada";
        }
    }

    //Muestra una vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); //comienza almacenar en memoria por un momento...
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //limpiamos memoria y almacenamos

        include __DIR__ . "/views/layout.php"; //llamamos la master page
    }
}

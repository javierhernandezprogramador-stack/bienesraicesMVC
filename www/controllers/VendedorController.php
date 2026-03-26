<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class VendedorController
{
    public static function index(Router $router)
    {
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('vendedores/index', [
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {

        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            //Generar un nombre unico de imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //verificar si existe la image
            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['vendedor']['tmp_name']['imagen']);
                $imagen->cover(800, 600);
                $vendedor->setImagen($nombreImagen);
            }

            //validar que no haya campos vacios
            $errores = $vendedor->validar();

            //No hay errores
            if (empty($errores)) {

                //Crear carpeta imagenes
                if (!is_dir(CARPETA_IMAGENES)) {  //verifica si exite la carpeta imagenes
                    mkdir(CARPETA_IMAGENES); //crea la carpeta imagenes
                }

                //Guardar la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);

                //Guardar en la base de datos

                $resultado = $vendedor->guardar();

                if ($resultado) {
                    header('Location: /vendedores?resultado=1');
                }
            } else {
                $vendedor->imagen = '';
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/vendedores');
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //asingar los valores
            $args = $_POST['vendedor'];

            //sincronizar el objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);

            //validacion
            $errores = $vendedor->validar();

            //nombre de la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            //Subida de archivos
            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['vendedor']['tmp_name']['imagen']);
                $imagen->cover(800, 600);
                $vendedor->setImagen($nombreImagen);
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }

            if (empty($errores)) {
                $resultado = $vendedor->guardar();

                if ($resultado) {
                    header('Location: /vendedores?resultado=2');
                }
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }


    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $resultado =  $vendedor->eliminar();

                    if ($resultado) {
                        header('Location: /vendedores?resultado=3');
                    } else {
                        header('Location: /vendedores?resultado=4');
                    }
                }
            }
        }
    }
}

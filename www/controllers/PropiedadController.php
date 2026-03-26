<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/index', [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);

            //Generar nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Realiza un resize a la imagen con intervetion
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen']);
                $imagen->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();

            //Revisar que el arreglo de errores este vacio
            if (empty($errores)) {

                //Crear carpeta imagenes
                if (!is_dir(CARPETA_IMAGENES)) {  //verifica si exite la carpeta imagenes
                    mkdir(CARPETA_IMAGENES); //crea la carpeta imagenes
                }

                //Guardar la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);

                $resultado = $propiedad->guardar();

                if ($resultado) {
                    header('Location: /propiedades/admin?resultado=1');
                }
            } else {
                $propiedad->imagen = '';
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/propiedades/admin');

        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //asignar los atributos
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            //Validacion
            $errores = $propiedad->validar();

            //Generar nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Subida de archivos
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen']);
                $imagen->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }

            //Revisar que el arreglo de errores este vacio
            if (empty($errores)) {
                $resultado = $propiedad->guardar();

                if ($resultado) {
                    header('Location: /propiedades/admin?resultado=2');
                }
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
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
                    $propiedad = Propiedad::find($id);
                    $resultado = $propiedad->eliminar();

                    if ($resultado) {
                        header('Location: /propiedades/admin?resultado=3');
                    }
                }
            }
        }
    }
}

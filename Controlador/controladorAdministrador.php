<?php

class ControladorAdministrador
{

    public function login()
    {
        if (isset($_POST["email"])) {
            if (
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])
            ) {
                $encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                
                $tabla = "usuario";
                $item  = "email";
                $valor = $_POST["email"];
                
                $respuesta = ModeloAdministrador::mostrarAdministrador($tabla, $item, $valor);
                
                if ($respuesta["email"] == $_POST["email"] && $respuesta["password"] == $encriptar) {
                    if ($respuesta["estado"] == 1) {
                        echo "<script>console.log( 'Debug Objects: " . "entra" . "' );</script>";

                        $_SESSION["validarSesion"] = "ok";
                        $_SESSION["id"]                   = $respuesta["id"];
                        $_SESSION["email"]                = $respuesta["email"];
                        $_SESSION["password"]             = $respuesta["password"];

                        echo '<script>

                            window.location = "inicio";

                        </script>';
                    } else {

                        echo '<br>
                        <div class="alert alert-warning">Este usuario aún no está activado</div>';
                        echo "<script>console.log( 'Debug Objects: " . "erro" . "' );</script>";
                    }
                } else {

                    echo '<br>
                    <div class="alert alert-danger">Error al ingresar vuelva a intentarlo</div>';
                    echo "<script>console.log( 'Debug Objects: " . "erro2" . "' );</script>";
                }
            }
        }
    }

    public static function ctrMostrarAdministrador($item, $valor)
    {

        $tabla = "administrador";

        $respuesta = ModeloAdministrador::mostrarAdministrador($tabla, $item, $valor);

        return $respuesta;
    }

    public static function crearPerfil()
    {

        if (isset($_POST["email"])) {
            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])
            ) {

                $tabla = "usuario";

                $encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array(
                    "email"                 => $_POST["email"],
                    "password"              => $encriptar,
                    "estado"                => 1
                );

                $respuesta = ModeloAdministrador::ingresarPerfil($tabla, $datos);

                if ($respuesta == "ok") {

                    echo "<script>console.log( 'Debug Objects: " . "creado" . "' );</script>";

                }
            } else {

                echo "<script>console.log( 'Debug Objects: " . "erro" . "' );</script>";

            }
        }
    }

    /*=============================================
EDITAR PERFIL
=============================================*/

    public static function ctrEditarPerfil()
    {

        if (isset($_POST["idPerfil"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

                /*=============================================
                VALIDAR IMAGEN
                =============================================*/

                $ruta = $_POST["fotoActual"];

                if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto  = 500;

                    /*=============================================
                    PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
                    =============================================*/

                    if (!empty($_POST["fotoActual"])) {

                        unlink($_POST["fotoActual"]);
                    } else {

                        /*  mkdir($directorio, 0755); */
                    }

                    /*=============================================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                    =============================================*/

                    if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/perfil/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["editarFoto"]["type"] == "image/png") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/perfil/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "administrador";

                if ($_POST["editarPassword"] != "") {

                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {

                        echo '<script>

                                swal({
                                      type: "error",
                                      title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
                                      showConfirmButton: true,
                                      confirmButtonText: "Cerrar"
                                      }).then(function(result) {
                                        if (result.value) {

                                        window.location = "administrador";

                                        }
                                    })

                            </script>';
                    }
                } else {

                    $encriptar = $_POST["passwordActual"];
                }

                $datos = array(
                    "id" => $_POST["idPerfil"],
                    "nombre"            => $_POST["editarNombre"],
                    "email"             => $_POST["editarEmail"],
                    "password"          => $encriptar,
                    "perfil"            => $_POST["editarPerfil"],
                    "foto"              => $ruta
                );

                $respuesta = ModeloAdministrador::editarPerfil($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
                          type: "success",
                          title: "El perfil ha sido editado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result) {
                                    if (result.value) {

                                    window.location = "perfil";

                                    }
                                })

                    </script>';
                }
            } else {

                echo '<script>

                    swal({
                          type: "error",
                          title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result) {
                            if (result.value) {

                            window.location = "administrador";

                            }
                        })

                </script>';
            }
        }
    }

    /*=============================================
    ELIMINAR PERFIL
    =============================================*/

    public static function ctrEliminarPerfil()
    {

        if (isset($_GET["idPerfil"])) {

            $tabla = "administrador";
            $datos = $_GET["idPerfil"];

            if ($_GET["fotoPerfil"] != "") {

                unlink($_GET["fotoPerfil"]);
            }

            $respuesta = ModeloAdministrador::eliminarPerfil($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

                swal({
                      type: "success",
                      title: "El perfil ha sido borrado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                      }).then(function(result) {
                                if (result.value) {

                                window.location = "perfil";

                                }
                            })

                </script>';
            }
        }
    }
}

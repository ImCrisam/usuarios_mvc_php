<?php

$rute = $_SERVER['REQUEST_URI'];
$valor = explode('?', $rute);
$valor = explode('=', $rute);
echo '<h5>Eliminando usuario</h5>';
ControladorAdministrador::eliminarPerfil( $valor[1]);

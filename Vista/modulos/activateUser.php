<?php

$rute = $_SERVER['REQUEST_URI'];
$valor = explode('?', $rute);
$valor = explode('=', $rute);
echo '<h5>Actualizando usuario</h5>';
ControladorAdministrador::updateEstado( $valor[1]);

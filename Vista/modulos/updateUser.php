<form role="form" method="post" enctype="multipart/form-data">

    <div class=" mt-3" style="background:#CAC7C7; color:white">
        <h4 class="modal-title">Editar Perfil</h4>
    </div>
    <?php

    $rute = $_SERVER['REQUEST_URI'];
    $valor = explode('?', $rute);
    $valor = explode('=', $rute);
    $item = "id";
    $user = ControladorAdministrador::mostrarAdministrador($item, $valor[1]);
    echo ' <div class="box-body">';
    echo '<div class="form-group">';
    echo '<div class="input-group">';
    echo '<input type="number" class="form-control input-lg" readonly name="iduser" value="' . $user[0] . '">';
    echo '</div>';
    echo '<div class="input-group">';
    echo '<input  class="form-control input-lg" name="editarEmail" value="' . $user[1] . '">';
    echo '</div>';
    ?>
    <div class="input-group">
        <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña" >

    </div>

    </div>

    </div>

    </div>

    <div class="modal-footer">

        <a type="button" class="btn btn-default pull-left" href="usuarios">Salir</a>

        <button type="submit" class="btn btn-primary">Modificar Perfil</button>

    </div>

    <?php

    $editarPerfil = new ControladorAdministrador();
    $editarPerfil->editarPerfil();

    ?>

</form>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">

                <div class="card mt-2">
                    <div class="card-header">
                        <a class="btn btn-primary" href="logup">
                            Nuevo Perfil
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered tablaPerfiles" id="tablaPerfiles">
                            <thead>
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th>id</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php

                                $item  = null;
                                $valor = null;

                                $perfiles = ControladorAdministrador::mostrarAdministrador($item, $valor);

                                foreach ($perfiles as $key => $value) {

                                    echo ' <tr>
                          <td>' . ($key + 1) . '</td>
                          <td>' . $value["id"] . '</td>
                          <td>' . $value["email"] . '</td>';

                                    if ($value["estado"] != 0) {

                                        echo '<td><button class="btn btn-success  " idPerfil="' . $value["id"] . '" estadoPerfil="0" id="btnActivar">Activado</button></td>';
                                    } else {

                                        echo '<td><button class="btn btn-secondary  " idPerfil="' . $value["id"] . '" estadoPerfil="1">Desactivado</button></td>';
                                    }

                                    echo '<td>

                          <div class="btn-group">

                            <a class="btn btn-warning " idPerfil="' . $value["id"] . '" href="updateUser?id='.$value["id"] . '">Editar</a>
                            <a class="btn btn-danger " idPerfil="' . $value["id"] . '" href="deleteUser?id='.$value["id"] . '">Eliminar</a>

                          </div>

                        </td>

                      </tr>';
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

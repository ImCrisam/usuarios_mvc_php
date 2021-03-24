<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-form mt-5">
                <form method="post" class="mx-auto"  id="logup" name="logup">
                    <!--   <div class="form-group mt-1">
                        <label>id</label>
                        <input type="number" class="form-control" id="id" name="id" placeholder="Email">
                    </div> -->
                    <div class="form-group mt-1">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group mt-1">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group mt-1">
                        <label>Re - Password</label>
                        <input type="password" class="form-control" id="rePassword" name="rePassword" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Ingresar</button>
                    <button type="" class="btn btn-primary mt-3" id="btnCancelar">Cancelar</button>
                </form>
                <?php
                $login = new ControladorAdministrador();
                $login->crearPerfil();
                ?>


            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cerrarsesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white" id="exampleModalLabel">¿Desea cerrar sesión?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body text-dark font-weight-bold">Seleccione "<i class="fas fa-power-off"></i> Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="procesos/destroy.php"><i class="fas fa-power-off"></i> Cerrar sesión</a>
      </div>
    </div>
  </div>
</div>


<!--AGREGAR ESTUDIOS DIPLOMADOS - ESTE SI-->
<div class="modal fade" id="agregar_user">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Datos del participante</h5>
        <button class="close" data-dismiss="modal">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="enviar_correo/ejemplo_mailer.php" method="POST">
          <div class="row">
            <input type="hidden" name="idsolicitud" id="idsolicitud">

            <div class="col-lg-6 ol-md-6 col-sm-12 form-group">
              <label for="title">(*) Nombres del Club</label>
              <input type="text" style="text-transform: uppercase; font-size:12px;" name="nom_competidor" class="form-control" id="nombre_club" disabled>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 form-group">
              <label for="title">(*) Estado solicitud</label>
              <input type="text" id="estado_soli" class="form-control" disabled>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 form-group">
              <label for="title">(*) Fecha solicitud</label>
              <input type="text" id="fech_soli" class="form-control" disabled>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-6 form-group">
              <label for="title">(*) Crear usuario</label>
              <input type="text" name="user" class="form-control" required>
            </div>
            <div class="col-lg-3 ol-md-4 col-sm-6 form-group">
              <label for="title">(*) Asignar contraseña</label>
              <input type="text" name="pass" class="form-control" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary" name="actualizar_participante"><i class="fas fa-save"></i> Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--NUEVO USUARIO - ESTE SI-->
<div class="modal fade" id="agregar_usuario">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Datos del usuario</h5>
        <button class="close" data-dismiss="modal">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="procesos/agregar_usuario.php" method="POST">
          <div class="row">
            <div class="col-lg-6 ol-md-6 col-sm-12 form-group">
              <label for="title">(*) Nombres del usuario</label>
              <input type="text" style="text-transform: uppercase;" name="nombres" class="form-control">
            </div>
            <div class="col-lg-6 ol-md-6 col-sm-12 form-group">
              <label for="title">(*) Apellidos del usuario</label>
              <input type="text" style="text-transform: uppercase;" name="apellidos" class="form-control">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 form-group">
              <label for="title">(*) Nombre Usuario</label>
              <input type="text" name="user" class="form-control">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 form-group">
              <label for="title">(*) Contraseña</label>
              <input type="text" name="pass" class="form-control">
            </div>
            <div class="col-lg-4 col-md-5 col-sm-6 form-group">
              <label for="title">(*) Tipo usuario</label>
              <select name="tipo_user" style="font-weight:700;" class="form-control">
                <option disabled>Elegir...</option>
                <option value="1">ADMINISTRADOR</option>
                <option value="2">JUEZ</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary" name="agregar_user"><i class="fas fa-save"></i> Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
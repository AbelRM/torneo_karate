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
<div class="modal fade" id="agregar_participante">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Datos del participante</h5>
        <button class="close" data-dismiss="modal">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="procesos/inscribir.php" enctype="multipart/form-data" autocomplete="off" method="POST">
          <div class="row">
            <div class="col-lg-12 ol-md-12 col-sm-12 form-group">
              <p class="text-danger font-weight-bold">NOTA:</p>
              <ol class="text-danger font-weight-bold">
                <li>(*) Indica un campo obligatorio.</li>
              </ol>
            </div>
            <input type="hidden" name="idclub" value="<?php echo $idclub; ?>">
            <input type="hidden" name="idtorneo" value="<?php echo $idtorneo; ?>">
            <div class="col-lg-6 ol-md-6 col-sm-12 form-group">
              <label for="title">(*) Nombres del competidor</label>
              <input type="text" style="text-transform: uppercase; font-size:12px;" name="nom_competidor" class="form-control" maxlength="65" required>
            </div>
            <div class="col-lg-6 ol-md-6 col-sm-12 form-group">
              <label for="title">(*) Apellidos del competidor</label>
              <input type="text" style="text-transform: uppercase; font-size:12px;" name="ape_competidor" class="form-control" maxlength="65" required>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-6 form-group">
              <label for="title">(*) D.N.I.</label>
              <input type="number" name="dni" style="font-size:12px;" class="form-control" required>
            </div>
            <div class="col-lg-3 ol-md-4 col-sm-6 form-group">
              <label for="title">(*) Fecha nacimiento</label>
              <input type="date" style="font-size:12px;" name="fech_nacimiento" class="form-control" required>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 form-group">
              <label for="title">(*) Sexo</label>
              <select name="sexo" style="font-weight:700; font-size: 12px;" class="form-control">
                <option disabled>Elegir...</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
              </select>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 form-group">
              <label for="title">(*) Grado</label>
              <select name="grado" style="font-weight:700; font-size: 12px;" class="form-control">
                <option disabled>Elegir...</option>
                <!-- <option value="1 Kyu">1 Kyu</option>
                <option value="2 Kyu">2 Kyu</option> -->
                <option value="3 Kyu">3 Kyu</option>
                <option value="4 Kyu">4 Kyu</option>
                <option value="5 Kyu">5 Kyu</option>
                <option value="6 Kyu">6 Kyu</option>
                <option value="7 Kyu">7 Kyu</option>
                <option value="8 Kyu">8 Kyu</option>
                <option value="9 Kyu">9 Kyu</option>
                <option value="1 Dan">1 Dan</option>
                <option value="2 Dan">2 Dan</option>
              </select>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 form-group">
              <label for="title">(*) Peso (Kg.)</label>
              <input type="number" name="peso" style="font-size:12px;" class="form-control" placeholder="Peso en Kg." required>
            </div>

            <div class="col-lg-10 col-md-12 col-sm-12 form-group">
              <label for="title">(*) Modalidad a participar: <small class="text-small text-danger">La categoria de KATA se registra, acorde a la edad, automáticamente.</small></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="categoria_kata">KATA</label>
                </div>
                <select class="form-control" name="categoria_kata" onChange="opcion_kata(this)" required>
                  <option value="1">No participar</option>
                  <option value="Participar">Participar</option>
                </select>
                <div class="input-group-prepend">
                  <label class="input-group-text" for="categoria_kumi">KUMITE</label>
                </div>
                <select class="form-control" name="categoria_kumi" onChange="opcion_kumite(this)" required>
                  <option value="1">No participar</option>
                  <option value="Participar">Participar</option>
                </select>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 form-group" style="display: none;" id="agregar_kata">
              <label for="title">(*) Primer KATA a realizar</label>
              <input type="number" name="kata" style="font-size:12px;" class="form-control" placeholder="Ingrese el nro.">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 form-group" style="display: none;" id="agregar_kumite">
              <label for="title">(*) Código KUMITE</label>
              <input type="text" name="codigo_kumite" style="font-size:12px; text-transform: uppercase; " class="form-control" placeholder="Ejemplo: B9">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
              <label for="title">(*) Foto del participante:</label>
              <input type="file" name="foto" accept="image/*" class="form-control" />
            </div>

          </div>
          <div class=" modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary" name="guardar_participante"><i class="fas fa-save"></i> Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ELIMINAR REGISTRO -->
<div class="modal fade" id="eliminar_parti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="procesos/eliminar_parti.php" method="POST">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white">Eliminar registro</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <input type="hidden" name="iddetalle_torneo" id="iddetalle_torneo">
        <h4 class="m-3">¿Desea eliminar el participante seleccionado?</h4>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" name="deleteData4">Si</button>
        </div>
      </form>
    </div>
  </div>
</div>
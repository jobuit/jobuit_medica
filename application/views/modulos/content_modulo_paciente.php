<div class="container">
    <h2 class="card-title">Modulo paciente</h2>
    <a class="nav-link" href="<?= base_url()?>index.php/Login/logout"><h6 align="right"><font color="black">Cerrar sesion <?php echo $fila->correo?></font></h6></a>
    <div class="row">
        <div class="col">
            <div class="card" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">Mi perfil</h5>
                    <?php
                    echo form_open('index.php/ModuloPaciente/updatePaciente');
                    $attribs=array('value'=>$fila->id);
                    echo form_input_text('id',"Cedula o Nit",$attribs);
                    $attribs=array('value'=>$fila->nombre);
                    echo form_input_text('nombre',"Nombres",$attribs);
                    $attribs=array('value'=>$fila->apellido);
                    echo form_input_text('apellido',"Apellidos",$attribs);
                    $attribs=array('value'=>$fila->correo);
                    echo form_input_text('correo',"Correo electronico de registro",$attribs);
                    $attribs=array('value'=>$fila->telefono);
                    echo form_input_text('telefono',"Telefono",$attribs);
                    $attribs=array('value'=>$fila->direccion);
                    echo form_input_text('direccion',"Direccion actual",$attribs);
                    $attribs=array('value'=>$fila->fecha_nacimiento);
                    echo form_input_date('fecha_nacimiento',"Fecha de nacimiento",$attribs);
                    echo form_input_textarea('emfermedades',"Emfermedades");
                    echo "Selecciona tu tipo de cuenta";
                    echo form_input_select('tipo_cuenta',false);
                    echo "<option value=\"a\">Tipo A</option>
                      <option value=\"b\">Tipo B</option>
                      <option value=\"c\">Tipo C</option></select></div>";
                    echo form_submit('Editar perfil');
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
        <div class="col">
                <div class="col">
                    <div class="card" style="width: 100%">
                        <img class="card-img-top" src="<?= base_url()?>public/img/paciente.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">¿Deseas agendar una cita?</h5>
                            <?php
                            echo form_open('index.php/ModuloPaciente/insertCita');
                            $attribs=array('style'=>'display: none;','value'=>$fila->id);
                            echo form_input_text('id_user','',$attribs);
                            echo form_input_textarea('motivo',"Motivo de la consulta");
                            echo form_submit('Pedir cita');
                            echo form_close();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 100%">
                        <div class="card-body">
                            <h5 class="card-title">Mis consultas</h5>
                            <div class="list-group">
                                <?php
                                foreach ($citas->result() as $row){
                                    ?>
                                    <a id="<?php echo $row->id?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1"><?= $row->motivo?></h5>
                                            <small><?= $row->fecha?></small>
                                        </div>
                                        <p class="mb-1">Hora cita: <?= $row->hora?><br>Lugar cita: <?= $row->lugar?><br>Doctor: <?= $row->id_doctor?></b></p>
                                        <?php
                                        if ($row->id_doctor==''){?>
                                            <small style="color:red;">Cita sin comfirmar</small>
                                            <?php
                                        }else{?>
                                            <small style="color:blue;">Cita comfirmada</small>
                                            <?php
                                        }
                                        ?>
                                    </a>
                                    <hr>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="ventana">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cita medica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="HTMLtoPDF" class="modal-body">
                    <h5 class="modal-title">Datos paciente</h5>
                    <ul>
                        <li id="id_usuario"></li>
                        <li id="nombre_user"></li>
                        <li id="correo_user"></li>
                        <li id="telefono_user"></li>
                        <li id="direccion_user"></li>
                        <li id="fecha_nacimiento_user"></li>
                        <li id="emfermedades_user"></li>
                        <li id="tipo_cuenta_user"></li>
                    </ul>

                    <h5 class="modal-title">Datos doctor</h5>
                    <ul>
                        <li id="id_doctor"></li>
                        <li id="nombre_doctor"></li>
                        <li id="correo_doctor"></li>
                        <li id="especializacion"></li>
                        <li id="telefono_doctor"></li>
                    </ul>

                    <h5 class="modal-title">Datos cita medica</h5>
                    <ul>
                        <li id="id_cita"></li>
                        <li id="fecha_cita"></li>
                        <li id="hora_cita"></li>
                        <li id="lugar_cita"></li>
                        <li id="motivo_cita"></li>
                    </ul>

                    <h5 class="modal-title">Procedimiento</h5>
                    <ul>
                        <li id="proce"></li>
                        <li id="medicamentos"></li>
                        <li id="proxima"></li>
                    </ul>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Comfirmar cita</button>
                    <button type="button" class="btn btn-danger" onclick="HTMLtoPDF()">Exportar pdf</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?= base_url()?>js/jspdf.js"></script>
<script src="<?= base_url()?>js/pdfFromHTML.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $("#emfermedades").html("<?php echo $fila->emfermedades ?>")
    });

    $("a").on("click", function (e) {
        var id = $(this).attr('id');

        $('#ventana').modal('show');

        var request;
        if (request){
            request.abort();
        }

        request= $.ajax({
            url: "<?php echo base_url('index.php/ModuloAdmin/getDatosUser') ?>",
            type: "POST",
            data: "id=" + id,
            dataType: 'json'
        });

        request.done(function (response,textStatus,jqXHR) {
            console.log(response[0].fecha);
            $("#id_usuario").html("Cc: " + response[0].id);
            $("#nombre_user").html("Nombre: " + response[0].nombre+" "+response[0].apellido);
            $("#correo_user").html("Correo: " + response[0].correo);
            $("#telefono_user").html("Telefono: " + response[0].telefono);
            $("#direccion_user").html("Direccion: " + response[0].direccion);
            $("#fecha_nacimiento_user").html("Fecha nacimiento: " + response[0].fecha_nacimiento);
            $("#emfermedades_user").html("Emfermedades: " + response[0].emfermedades);
            $("#tipo_cuenta_user").html("Tipo cuenta: " + response[0].tipo_cuenta);
        });

        var request2;
        if (request2){
            request2.abort();
        }

        request2= $.ajax({
            url: "<?php echo base_url('index.php/ModuloAdmin/getDatosDoctor') ?>",
            type: "POST",
            data: "id=" + id,
            dataType: 'json'
        });

        request2.done(function (response,textStatus,jqXHR) {
            console.log(response[0].fecha);
            $("#id_doctor").html("Cc: " + response[0].id);
            $("#nombre_doctor").html("Nombre: " + response[0].nombre+" "+response[0].apellido);
            $("#correo_doctor").html("Correo: " + response[0].correo);
            $("#especializacion").html("Especializacion: " + response[0].especializacion);
            $("#telefono_doctor").html("Telefono: " + response[0].telefono);
        });

        var request3;
        if (request3){
            request3.abort();
        }

        request3= $.ajax({
            url: "<?php echo base_url('index.php/ModuloAdmin/getCitaPacienteJquery') ?>",
            type: "POST",
            data: "id=" + id,
            dataType: 'json'
        });

        request3.done(function (response,textStatus,jqXHR) {
            console.log(response[0].fecha);
            $("#id_cita").html("Id cita: " + response[0].id);
            $("#fecha_cita").html("Fecha cita: " + response[0].fecha);
            $("#hora_cita").html("Hora cita: " + response[0].hora);
            $("#lugar_cita").html("Lugar cita: " + response[0].lugar);
            $("#motivo_cita").html("Motivo consulta: " + response[0].motivo);
        });

        var request4;
        if (request4){
            request4.abort();
        }

        request4= $.ajax({
            url: "<?php echo base_url('index.php/ModuloDoctor/getProcedimiento') ?>",
            type: "POST",
            data: "id_cita=" + id,
            dataType: 'json'
        });

        request4.done(function (response,textStatus,jqXHR) {
            $("#proce").html(response[0].proce);
            $("#medicamentos").html(response[0].medicamentos);
            $("#proxima").html(response[0].proxima);
        });

    });

</script>
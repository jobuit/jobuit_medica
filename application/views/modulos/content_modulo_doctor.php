<div class="container">
    <h2 class="card-title">Modulo doctor</h2>
    <a class="nav-link" href="<?= base_url()?>index.php/Login/logout"><h6 align="right"><font color="black">Cerrar sesion <?php echo $fila->correo?></font></h6></a>
    <div class="row">
        <div class="col">
            <div class="card" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">Mi perfil</h5>
                    <?php
                    echo form_open('index.php/ModuloDoctor/updateDoctor');
                    $attribs=array('value'=>$fila->id);
                    echo form_input_text('id',"Cedula o Nit",$attribs);
                    $attribs=array('value'=>$fila->nombre);
                    echo form_input_text('nombre',"Nombres",$attribs);
                    $attribs=array('value'=>$fila->apellido);
                    echo form_input_text('apellido',"Apellidos",$attribs);
                    $attribs=array('value'=>$fila->correo);
                    echo form_input_text('correo',"Correo electronico de registro",$attribs);
                    $attribs=array('value'=>$fila->especializacion);
                    echo form_input_text('especializacion',"Especializacion",$attribs);
                    $attribs=array('value'=>$fila->telefono);
                    echo form_input_text('telefono',"Telefono",$attribs);
                    echo form_submit('Editar perfil');
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 100%">
                <img class="card-img-top" src="<?= base_url()?>public/img/paciente.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Mis pacientes</h5>
                    <div class="list-group">
                        <?php
                        foreach ($citas->result() as $row){
                            ?>
                            <a id="<?php echo $row->id?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= $row->motivo?></h5>
                                    <small><?= $row->fecha?></small>
                                </div>
                                <p class="mb-1">Hora cita: <?= $row->hora?><br>Lugar cita: <?= $row->lugar?><br>Paciente: <?= $row->id_usuario?></b></p>
                                <?php
                                if ($row->id_procedimiento==''){?>
                                    <small style="color:red;">Cita sin procedimiento</small>
                                    <?php
                                }else{?>
                                    <small style="color:blue;">Cita con procedimiento</small>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="ventana">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Procedimiento paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    echo form_open('index.php/ModuloDoctor/insertProcedimiento');
                    $attribs=array('style'=>'display: none;');
                    echo form_input_textarea('id_cita','',$attribs);
                    echo form_input_textarea('motivo',"Motivo consulta");
                    echo form_input_textarea('proce',"Procedimiento");
                    echo form_input_textarea('medicamentos',"Medicamentos");
                    echo form_input_textarea('proxima',"Proxima valoracion");
                    echo form_submit('Enviar procedimiento');
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript">

    $(document).ready(function () {

        $("a").on("click", function (e) {
            var id = $(this).attr('id');

            $('#ventana').modal('show');

            var request;
            if (request){
                request.abort();
            }

            request= $.ajax({
                url: "<?php echo base_url('index.php/ModuloAdmin/getCitaPacienteJquery') ?>",
                type: "POST",
                data: "id=" + id,
                dataType: 'json'
            });

            request.done(function (response,textStatus,jqXHR) {
                console.log(response[0].fecha);
                $("#id_cita").html(response[0].id);
                $("#motivo").html(response[0].motivo);
            });

            var request2;
            if (request2){
                request2.abort();
            }

            request2= $.ajax({
                url: "<?php echo base_url('index.php/ModuloDoctor/getProcedimiento') ?>",
                type: "POST",
                data: "id_cita=" + id,
                dataType: 'json'
            });

            request2.done(function (response,textStatus,jqXHR) {
                $("#id_doctor").html("Cc: " + response[0].id);
                $("#proce").html(response[0].proce);
                $("#medicamentos").html(response[0].medicamentos);
                $("#proxima").html(response[0].proxima);
            });

        });
    })
</script>
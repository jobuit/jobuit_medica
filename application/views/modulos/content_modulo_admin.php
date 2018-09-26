<div class="container">
    <h2 class="card-title">Modulo administrador</h2>
    <a class="nav-link" href="<?= base_url()?>index.php/Login/logout"><h6 align="right"><font color="black">Cerrar sesion <?php echo $this->session->userdata('email')?></font></h6></a>

    <div class="row">
        <div class="col">
            <div class="col">
                <div class="card" style="width: 100%">
                    <div class="col-lg-12">
                        <h5 class="card-title">Lista de usuarios</h5>
                        <?php
                        $content  = "<div class='table-responsive'>";
                        $content .= "<table class='table table-hover table-bordered table-condensed'>";
                        $content .=	"<thead>";
                        $content .=	"<tr>";
                        $content .= "<th style='text-align: center;'>Id</th>";
                        $content .= "<th style='text-align: center;'>Correo</th>";
                        $content .= "<th style='text-align: center;'>Tipo</th>";
                        $content .= "<th style='text-align: center;'>Eliminar cuenta</th>";
                        $content .=	"</tr>";
                        $content .=	"</thead>";
                        $content .=	"<tbody>";
                        $id=0;
                        foreach ($usuarios->result() as $row) {
                            $id=$row->id;
                            $content .= "<tr id='tr$id'>";
                            $content .= "<td style='text-align: center;'><p class=\"mb-1\">$id</p></td>";
                            $content .= "<td style='text-align: center;'><p class=\"mb-1\">$row->correo</p></td>";
                            $content .= "<td style='text-align: center;'><p class=\"mb-1\">$row->tipo</p></td>";
                            $content .= "<td style='text-align: center;'><button class='btn btn-danger' name='$row->correo' id='$row->id'>Eliminar</button></td>";
                            $content .= "</tr>";
                            $id++;
                        }
                        $content .=	"</tbody>";
                        $content .=	"</table>";
                        $content .= "</div>";
                        echo $content;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">Consultas pacientes</h5>
                    <div class="list-group">
                        <?php
                        foreach ($citas->result() as $row){
                            $idCita=$row->id;
                            ?>
                            <a id="<?php echo $idCita?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= $row->id?></h5>
                                    <small><?= $row->fecha?></small>
                                </div>
                                <p class="mb-1">Id usuario: <?= $row->id_usuario?><br>Id doctor: <?= $row->id_doctor?><br>Motivo: <?= $row->motivo?></b></p>

                                <?php
                                if ($row->id_doctor==''){?>
                                    <small style="color:red;">Cita sin diligenciar</small>
                                <?php
                                }else{?>
                                    <small style="color:blue;">Cita diligenciada</small>
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
                    <h5 class="modal-title">Cita usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    echo form_open('index.php/ModuloAdmin/updateCita');
                    $attribs=array('style'=>'display: none;');
                    echo form_input_textarea('id','',$attribs);
                    echo form_input_textarea('id_usuario','',$attribs);
                    echo form_input_textarea('id_doctor',"Id doctor");
                    echo form_input_textarea('fecha',"Fecha cita");
                    echo form_input_textarea('hora',"Hora cita");
                    echo form_input_textarea('lugar',"Lugar cita");
                    echo form_input_textarea('motivo',"Motivo cita");
                    echo form_submit('Actualizar cita');
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
                $("#id").html(response[0].id);
                $("#id_usuario").html(response[0].id_usuario);
                $("#id_doctor").html(response[0].id_doctor);
                $("#fecha").html(response[0].fecha);
                $("#hora").html(response[0].hora);
                $("#lugar").html(response[0].lugar);
                $("#motivo").html(response[0].motivo);
            });

        });


        $("button").on("click", function (e) {
            var id = $(this).attr('id');

            var request;
            if (request){
                request.abort();
            }

            request= $.ajax({
                url: "<?php echo base_url('index.php/ModuloAdmin/deleteUser') ?>",
                type: "POST",
                data: "id=" + id
            });

            request.done(function (response,textStatus,jqXHR) {
                console.log(response);
                $("#tr"+response).html("");
            });

        })
    })
</script>
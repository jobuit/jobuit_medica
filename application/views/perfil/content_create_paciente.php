<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php
            echo form_open('index.php/NuevoPaciente/insert');
            echo form_input_text('id',"Cedula o Nit");
            echo form_input_text('nombre',"Nombres");
            echo form_input_text('apellido',"Apellidos");
            echo form_input_text('correo',"Correo electronico de registro");
            echo form_input_text('telefono',"Telefono");
            echo form_input_text('direccion',"Direccion actual");
            echo form_input_date('fecha_nacimiento',"Fecha de nacimiento");
            echo form_input_textarea('emfermedades',"Emfermedades");
            echo "Selecciona tu tipo de cuenta";
            echo form_input_select('tipo',false);
            echo "<option value=\"a\">Tipo A</option>
                      <option value=\"b\">Tipo B</option>
                      <option value=\"c\">Tipo C</option></select></div>";
            echo form_submit('Crear paciente');
            echo form_close();
            ?>
        </div>
    </div>
</div>
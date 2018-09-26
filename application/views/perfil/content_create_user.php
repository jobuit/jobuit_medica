<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php
            echo form_open('index.php/NuevoUsuario/insert');
            echo "Selecciona tu tipo";
            echo form_input_select('tipo',false);
            echo "<option value=\"paciente\">Paciente</option>
                      <option value=\"doctor\">Doctor</option></select></div>";
            echo form_input_text('correo',"Correo electronico");
            echo form_input_password('contrasena',"Ingresa una contraseña");
            echo form_input_password('repetir',"Repetir contraseña");
            echo form_submit('Crear usuario');
            echo form_close();
            ?>
        </div>
    </div>
</div>
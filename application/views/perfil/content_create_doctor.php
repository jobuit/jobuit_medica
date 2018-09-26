<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php
            echo form_open('index.php/Nuevodoctor/insert');
            echo form_input_text('id',"Cedula o Nit");
            echo form_input_text('nombre',"Nombres");
            echo form_input_text('apellido',"Apellidos");
            echo form_input_text('correo',"Correo electronico de registro");

            echo "Selecciona especializacion";
            echo form_input_select('especializacion',false);

            foreach ($consulta->result() as $fila){
                echo "<option value=$fila->nombre>$fila->nombre</option>";
            }
            echo "</select></div>";

            echo form_input_text('telefono',"Telefono");
            echo form_submit('Crear doctor');
            echo form_close();
            ?>
        </div>
    </div>
</div>
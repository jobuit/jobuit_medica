<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Jobuit medica</title>

</head>
<body>

<div id="container">

    <center>
        <h1>Iniciar sesion</h1>
        <div style='padding: 10px; padding-bottom: 0px; background: white; width: 400px;'>
            <form action='<?= base_url()?>index.php/Login' method='post' accept-charset='UTF-8' role="form">
                <div class='form-group'>
                    <input class='form-control large' style='text-align: center;' type='text' name='user' placeholder='usuario'/>
                </div>
                <div class='form-group'>
                    <input class='form-control large' style='text-align: center;' type='password' name='password' placeholder='contraseña' />
                </div>
                <div class='form-group'>
                    <a class="nav-link" href="<?= base_url()?>index.php/NuevoUsuario"><h6><center><font color="black">Crear perfil</font></center></h6></a>
                </div>
                <div class='form-group'>
                    <button class='btn btn-primary' style='width: 380px;' type='submit'>INGRESAR</button>
                </div>
            </form>
        </div>
    </center>

</div>

</body>
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
        $datos=array('titulo' => 'Jobuit Medica');
        $this->load->view("welcome/head",$datos);

        $datos=array('post' => 'Jobuit Medica', 'descripcion' => 'Bienvenido a la plataforma de Jobuit Medica','img' => 'public/img/fondo.jpg');
        $this->load->view("welcome/header",$datos);

        $this->load->view("welcome/content",$datos);

        $this->load->view("welcome/footer");
	}
}

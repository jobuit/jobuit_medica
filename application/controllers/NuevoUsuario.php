<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NuevoUsuario extends CI_Controller {

    public function index()
    {
        $datos=array('titulo' => 'Jobuit Medica');
        $this->load->view("welcome/head",$datos);

        $datos=array('post' => 'Crear nuevo usuario', 'descripcion' => '','img' => 'public/img/doctors.jpg');
        $this->load->view("welcome/header",$datos);

        $this->load->view("perfil/content_create_user");
        $this->load->view("welcome/footer");
    }

    public function insert(){

        $this->load->model('User');

        $post=$this->input->post();
        $bool=$this->User->InsertUser($post);

        if($bool){
            $correo=$post['correo'];
            $contrasena=$post['contrasena'];
            $this->User->iniciarSesion($correo,$contrasena);
            $tipo=$post['tipo'];
            if($tipo=='doctor'){
                header("Location: ".base_url()."index.php/NuevoDoctor");
            }else if($tipo=='paciente'){
                header("Location: ".base_url()."index.php/NuevoPaciente");
            }
        }else{
            header("Location: ".base_url()."index.php/NuevoUsuario");
        }

    }
}
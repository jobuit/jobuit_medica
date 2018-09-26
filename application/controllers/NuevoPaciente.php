<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NuevoPaciente extends CI_Controller {

    public function index()
    {
        $datos=array('titulo' => 'Jobuit Medica');
        $this->load->view("welcome/head",$datos);

        $datos=array('post' => 'Crear nuevo paciente', 'descripcion' => 'Llena los campos por favor','img' => 'public/img/paciente.jpg');
        $this->load->view("welcome/header",$datos);

        $this->load->view("perfil/content_create_paciente");

        $this->load->view("welcome/footer");
    }

    public function insert(){

        if (!$this->session->userdata('login')){
            header("Location: ".base_url());
        }

        $this->load->model('Paciente');

        $post=$this->input->post();
        $bool=$this->Paciente->insertPaciente($post);

        if($bool){
            header("Location: ".base_url('index.php/ModuloPaciente'));
        }else{
            header("Location: ".base_url()."index.php/NuevoPaciente");
        }

    }

}
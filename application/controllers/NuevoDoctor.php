<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NuevoDoctor extends CI_Controller {

    public function index()
    {
        $datos=array('titulo' => 'Jobuit Medica');
        $this->load->view("welcome/head",$datos);

        $datos=array('post' => 'Crear nuevo doctor', 'descripcion' => 'Llena los campos por favor','img' => 'public/img/doctors.jpg');
        $this->load->view("welcome/header",$datos);

        $this->load->model('Especializaciones');
        $resultado=$this->Especializaciones->getEspecializaciones();
        $datos['consulta']=$resultado;
        $this->load->view("perfil/content_create_doctor",$datos);

        $this->load->view("welcome/footer");
    }

    public function insert(){

        if (!$this->session->userdata('login')){
            header("Location: ".base_url());
        }

        $this->load->model('Doctor');

        $post=$this->input->post();
        $bool=$this->Doctor->insertDoctor($post);

        if($bool){
            header("Location: ".base_url('index.php/ModuloDoctor'));
        }else{
            header("Location: ".base_url()."index.php/NuevoDoctor");
        }

    }
}
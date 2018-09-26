<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModuloPaciente extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Paciente');
    }

    public function index()
    {
        $datos=array('titulo' => 'Jobuit Medica');
        $this->load->view("welcome/head",$datos);

        $fila=$this->Paciente->getPaciente($this->session->userdata('email'));
        $datos['fila']=$fila;

        $this->load->model('Cita');
        $citas=$this->Cita->getCitaPaciente($fila->id);
        $datos['citas']=$citas;

        $this->load->view("modulos/content_modulo_paciente",$datos);

        $this->load->view("welcome/footer");
    }

    public function insertCita(){

        $post=$this->input->post();

        $this->load->model('Cita');
        $bool=$this->Cita->insertCita($post);

        if($bool){
            header("Location: ".base_url('index.php/ModuloPaciente'));
        }else{
            header("Location: ".base_url());
        }

    }

    public function updatePaciente(){
        $post=$this->input->post();

        $bool=$this->Paciente->updatePaciente($post);

        if($bool){
            header("Location: ".base_url('index.php/ModuloPaciente'));
        }else{
            header('Location: '.base_url());
        }
    }
}
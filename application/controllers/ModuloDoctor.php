<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModuloDoctor extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Doctor');
    }

    public function index()
    {
        $datos=array('titulo' => 'Jobuit Medica');
        $this->load->view("welcome/head",$datos);

        $fila=$this->Doctor->getDoctor($this->session->userdata('email'));
        $datos['fila']=$fila;

        $this->load->model('Cita');
        $citas=$this->Cita->getCitaDoctor($fila->id);
        $datos['citas']=$citas;

        $this->load->view("modulos/content_modulo_doctor",$datos);

        $this->load->view("welcome/footer");
    }

    public function getProcedimiento(){
        $this->load->model('Procedimiento');
        $post=$this->input->post();
        $id_cita=$post['id_cita'];

        $fila=$this->Procedimiento->getProcedimientoCita($id_cita);

        if ($fila==null){
            $return_arr[] = array("id" => '',
                "id_cita" => '',
                "proce" => '',
                "medicamentos" => '',
                "proxima" => '');
        }else{
            $return_arr[] = array("id" => $fila->id,
                "id_cita" => $fila->id_cita,
                "proce" => $fila->proce,
                "medicamentos" => $fila->medicamentos,
                "proxima" => $fila->proxima);
        }

        echo json_encode($return_arr);
    }

    public function insertProcedimiento(){

        $post=$this->input->post();

        $this->load->model('Procedimiento');
        $bool=$this->Procedimiento->insertProcedimiento($post);

        if($bool){

            $fila=$this->Procedimiento->getProcedimientoCita($post['id_cita']);

            $this->load->model('Cita');
            $bool2=$this->Cita->updateCitaProcedimiento($fila);

            if($bool2){
                header("Location: ".base_url('index.php/ModuloDoctor'));
            }else{
                header("Location: ".base_url());
            }

        }else{
            header("Location: ".base_url());
        }

    }


    public function updateDoctor(){
        $post=$this->input->post();

        $bool=$this->Doctor->updateDoctor($post);

        if($bool){
            header("Location: ".base_url('index.php/ModuloDoctor'));
        }else{
            header('Location: '.base_url());
        }
    }
}
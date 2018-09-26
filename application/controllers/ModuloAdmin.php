<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModuloAdmin extends CI_Controller {

    public function index()
    {
        $datos=array('titulo' => 'Jobuit Medica');
        $this->load->view("welcome/head",$datos);

        $this->load->model('User');
        $citas=$this->User->getUsers();
        $datos['usuarios']=$citas;

        $this->load->model('Cita');
        $citas=$this->Cita->getCitasPacientes();
        $datos['citas']=$citas;


        $this->load->view("modulos/content_modulo_admin",$datos);

        $this->load->view("welcome/footer");
    }

    public function getCitaPacienteJquery(){
        $this->load->model('Cita');
        $post=$this->input->post();
        $id=$post['id'];

        $fila=$this->Cita->getCitaPacienteJquery($id);
        $return_arr[] = array("id" => $fila->id,
            "id_usuario" => $fila->id_usuario,
            "id_doctor" => $fila->id_doctor,
            "fecha" => $fila->fecha,
            "hora" => $fila->hora,
            "lugar" => $fila->lugar,
            "motivo" => $fila->motivo);
        echo json_encode($return_arr);
    }

    public function getDatosUser(){
        $this->load->model('Cita');
        $post=$this->input->post();
        $id=$post['id'];

        $fila=$this->Cita->getCitaPacienteJquery($id);

        $this->load->model('Paciente');
        $filaUser=$this->Paciente->getPacienteById($fila->id_usuario);

        $return_arr[] = array("id" => $filaUser->id,
            "nombre" => $filaUser->nombre,
            "apellido" => $filaUser->apellido,
            "correo" => $filaUser->correo,
            "telefono" => $filaUser->telefono,
            "direccion" => $filaUser->direccion,
            "fecha_nacimiento" => $filaUser->fecha_nacimiento,
            "emfermedades" => $filaUser->emfermedades,
            "tipo_cuenta" => $filaUser->tipo_cuenta);
        echo json_encode($return_arr);
    }

    public function getDatosDoctor(){
        $this->load->model('Cita');
        $post=$this->input->post();
        $id=$post['id'];

        $fila=$this->Cita->getCitaPacienteJquery($id);

        $this->load->model('Doctor');
        $filaDoctor=$this->Doctor->getDoctorById($fila->id_doctor);

        if ($filaDoctor==null){
            $return_arr[] = array("id" => '',
                "nombre" => '',
                "apellido" => '',
                "correo" => '',
                "especializacion" => '',
                "telefono" => '');
        }else{
            $return_arr[] = array("id" => $filaDoctor->id,
                "nombre" => $filaDoctor->nombre,
                "apellido" => $filaDoctor->apellido,
                "correo" => $filaDoctor->correo,
                "especializacion" => $filaDoctor->especializacion,
                "telefono" => $filaDoctor->telefono);
        }
        echo json_encode($return_arr);
    }

    public function deleteUser(){
        $this->load->model('User');
        $post=$this->input->post();
        $id=$post['id'];

        $bool=$this->User->deleteUser($id);

        if ($bool){
            echo $id;
        }else {
            echo false;
        }


    }

    public function updateCita(){

        $post=$this->input->post();

        $this->load->model('Cita');
        $bool=$this->Cita->updateCitaModAdmin($post);

        if($bool){
            header("Location: ".base_url('index.php/ModuloAdmin'));
        }else{
            header("Location: ".base_url());
        }

    }
}
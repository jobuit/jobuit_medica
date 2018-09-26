<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/03/18
 * Time: 12:36 PM
 */

class  Login extends CI_Controller{
    public function index(){
        $email=$this->input->post('user');
        $pass=$this->input->post('password');
        $this->load->model('User');
        $bool=$this->User->iniciarSesion($email,$pass);

        if ($bool){
            $fila=$this->User->getUser($email);
            $tipo=$fila->tipo;
            if($tipo=='paciente'){
                header("Location: ".base_url('index.php/ModuloPaciente'));
            }else if($tipo=='doctor'){
                header("Location: ".base_url('index.php/ModuloDoctor'));
            }else if($tipo=='admin'){
                header("Location: ".base_url('index.php/ModuloAdmin'));
            }
        }else{
            header("Location: ".base_url());
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        header("Location: ".base_url());
    }
}
?>
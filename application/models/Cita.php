<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/03/18
 * Time: 10:24 AM
 */

class Cita extends CI_Model{

    public function insertCita($post=null){

        if($post!=null){
            $motivo=$post['motivo'];
            $id_usuario=$post['id_user'];

            $SQL= "INSERT INTO cita(id,id_usuario,id_doctor,fecha,hora,lugar,motivo) VALUES (NULL,'$id_usuario','','','','','$motivo')";

            if ($this->db->query($SQL)){
                return true;
            }
        }

        return false;
    }

    public function updateCitaProcedimiento($fila=null){
        if($fila!=null){
            $id_cita=$fila->id_cita;
            $id_procedimiento=$fila->id;

            $SQL= "UPDATE cita SET id_procedimiento = '$id_procedimiento' WHERE id = '$id_cita';";

            if ($this->db->query($SQL)){
                return true;
            }
        }

        return false;
    }

    public function updateCitaModAdmin($post=null){
        $data['id_usuario']=$post['id_usuario'];
        $data['id_doctor']=$post['id_doctor'];
        $data['fecha']=$post['fecha'];
        $data['hora']=$post['hora'];
        $data['lugar']=$post['lugar'];
        $data['motivo']=$post['motivo'];

        $this->db->where('id', $post['id']);

        if($this->db->update('cita', $data)){
            return true;
        }
        return false;
    }

    public function getCitasPacientes()
    {
        $result = $this->db->query("SELECT * FROM cita");
        return $result;
    }

    public function getCitaDoctor($id='')
    {
        $result = $this->db->query("SELECT * FROM cita WHERE id_doctor = '".$id."'");
        return $result;
    }

    public function getCitaPaciente($id='')
    {
        $result = $this->db->query("SELECT * FROM cita WHERE id_usuario = '".$id."'");
        return $result;
    }

    public function getCitaPacienteJquery($id='')
    {
        $result = $this->db->query("SELECT * FROM cita WHERE id = '".$id."'");
        return $result->row();
    }

}

?>
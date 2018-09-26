<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/03/18
 * Time: 10:24 AM
 */

class Paciente extends CI_Model{

    public function insertPaciente($post=null){

        if($post!=null){
            $cc=$post['id'];
            $nombre=$post['nombre'];
            $apellido=$post['apellido'];
            $correo=$post['correo'];
            $telefono=$post['telefono'];
            $direccion=$post['direccion'];
            $fecha=$post['fecha_nacimiento'];
            $emfermedades=$post['emfermedades'];
            $tipo=$post['tipo'];

            $SQL= "INSERT INTO paciente(id,nombre,apellido,correo,telefono,direccion,fecha_nacimiento,emfermedades,tipo_cuenta) VALUES ('$cc','$nombre','$apellido','$correo','$telefono','$direccion','$fecha','$emfermedades','$tipo')";

            if ($this->db->query($SQL)){
                return true;
            }
        }

        return false;
    }

    public function getPacienteById($id=""){
        $result = $this->db->query("SELECT * FROM paciente WHERE id = '".$id."'");
        if ($result->num_rows()>0){
            return $result->row();
        }else{
            return null;
        }
    }

    public function getPaciente($email=""){
        $result = $this->db->query("SELECT * FROM paciente WHERE correo = '".$email."'");
        if ($result->num_rows()>0){
            return $result->row();
        }else{
            return null;
        }
    }

    public function updatePaciente($post){
        $id=$post['id'];
        $data['nombre']=$post['nombre'];
        $data['apellido']=$post['apellido'];
        $data['correo']=$post['correo'];
        $data['telefono']=$post['telefono'];
        $data['direccion']=$post['direccion'];
        $data['fecha_nacimiento']=$post['fecha_nacimiento'];
        $data['emfermedades']=$post['emfermedades'];
        $data['tipo_cuenta']=$post['tipo_cuenta'];

        $this->db->where('id', $id);

        if($this->db->update('paciente', $data)){
            return true;
        }

        return false;
    }
}

?>
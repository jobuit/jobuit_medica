<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/03/18
 * Time: 10:24 AM
 */

class Doctor extends CI_Model{

    public function insertDoctor($post=null){

        if($post!=null){
            $cc=$post['id'];
            $nombre=$post['nombre'];
            $apellido=$post['apellido'];
            $correo=$post['correo'];
            $especializacion=$post['especializacion'];
            $telefono=$post['telefono'];

            $SQL= "INSERT INTO doctor(id,nombre,apellido,correo,especializacion,telefono) VALUES ('$cc','$nombre','$apellido','$correo','$especializacion','$telefono')";

            if ($this->db->query($SQL)){
                return true;
            }
        }

        return false;
    }

    public function updateDoctor($post){
        $id=$post['id'];
        $data['nombre']=$post['nombre'];
        $data['apellido']=$post['apellido'];
        $data['correo']=$post['correo'];
        $data['especializacion']=$post['especializacion'];
        $data['telefono']=$post['telefono'];

        $this->db->where('id', $id);

        if($this->db->update('doctor', $data)){
            return true;
        }
        return false;
    }

    public function getDoctor($email=""){
        $result = $this->db->query("SELECT * FROM doctor WHERE correo = '".$email."'");
        if ($result->num_rows()>0){
            return $result->row();
        }else{
            return null;
        }
    }

    public function getDoctorById($id=""){
        $result = $this->db->query("SELECT * FROM doctor WHERE id = '".$id."'");
        if ($result->num_rows()>0){
            return $result->row();
        }else{
            return null;
        }
    }
}

?>
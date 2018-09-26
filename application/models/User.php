<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/03/18
 * Time: 10:24 AM
 */

class User extends CI_Model{

    public function iniciarSesion($email,$pass){
        $fila=$this->getUser($email);

        if($fila!=null){
            if($fila->password == $pass){
                $datos=array(
                    'email' => $email,
                    'id' => 0,
                    'login' => true
                );

                $this->session->set_userdata($datos);
                return true;
            }
        }
        return false;
    }

    public function deleteUser($id=''){
        $SQL="DELETE FROM login WHERE id='$id'";
        if ($this->db->query($SQL)){
            return true;
        }
        return false;
    }

    public function getUsers(){
        $result = $this->db->query("SELECT * FROM login");
        return $result;
    }

    public function getUser($email=""){
        $result = $this->db->query("SELECT * FROM login WHERE correo = '".$email."'");
        if ($result->num_rows()>0){
            return $result->row();
        }else{
            return null;
        }
    }

    public function insertUser($post=null){

        if($post!=null){
            $correo=$post['correo'];
            $contrasena=$post['contrasena'];
            $repetir=$post['repetir'];
            $tipo=$post['tipo'];

            if($repetir==$contrasena){
                $SQL= "INSERT INTO login(id,correo,password,tipo) VALUES (null,'$correo','$contrasena','$tipo')";

                if ($this->db->query($SQL)){
                    return true;
                }
            }
        }

        return false;
    }
}

?>
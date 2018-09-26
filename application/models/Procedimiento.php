<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/03/18
 * Time: 10:24 AM
 */

class Procedimiento extends CI_Model{

    public function insertProcedimiento($post=null){

        if($post!=null){
            $id_cita=$post['id_cita'];
            $proce=$post['proce'];
            $medicamentos=$post['medicamentos'];
            $proxima=$post['proxima'];

            $SQL= "INSERT INTO procedimiento(id,id_cita,proce,medicamentos,proxima) VALUES (NULL,'$id_cita','$proce','$medicamentos','$proxima')";

            if ($this->db->query($SQL)){
                return true;
            }
        }

        return false;
    }

    public function getProcedimientoCita($id='')
    {
        $result = $this->db->query("SELECT * FROM procedimiento WHERE id_cita = '".$id."'");
        return $result->row();
    }
}

?>
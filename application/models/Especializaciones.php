<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/03/18
 * Time: 10:24 AM
 */

class Especializaciones extends CI_Model{

    public function getEspecializaciones(){
        return $resultado=$this->db->get('especializaciones');
    }
}

?>
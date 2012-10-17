<?php

class Usuarios_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function record_count($tabla)
    {       
        $this->db->from($tabla);
        return $this->db->count_all_results();                
    }
    
    
    public function filas_paginadas($tabla, $limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->order_by("username");
        $query = $this->db->get($tabla);

        if ($query->num_rows() > 0) {

            return $query->result_array();
        }

    }
    
     function get_usuario($id)
    {
        $this->db->select('id,username,password,email,perfil_id');
        $this->db->where('id', $id);                    
        $consulta = $this->db->get('academico');
        return $consulta->row_array();           
    }
    
    function crear_nuevo_usuario($datos)
    {
     
        $this->db->insert('academico', $datos);   
    }
    
     function editar_usuario($id,$datos)
    {       
        $this->db->where('id',$id);
        $this->db->update('academico',$datos);                             
    }
     function eliminar_usuarios($array_id)
    {       
        foreach($array_id as $id){
            $this->db->where('id', $id);
            $this->db->delete('academico');
        }                   
       // return $consulta->row_array();           
    }
}

//location: application/models/Home_model.php


?>
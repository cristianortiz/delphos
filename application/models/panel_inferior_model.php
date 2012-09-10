<?php

class Panel_inferior_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
    }
  
    function get_aviso($id)
    {
        $this->db->select('id,contenido');
        $this->db->where('id', $id);                    
        $consulta = $this->db->get('inferior');
        return $consulta->row_array();           
    }
    
     function cambiar_estado_aviso($array_id,$datos)
    {
        foreach($array_id as $id){
             $this->db->where('id', $id);
        $this->db->update('inferior', $datos);
        }
    }
    
    function editar_aviso($id,$datos)
    {       
        $this->db->where('id',$id);
        $this->db->update('inferior',$datos);                             
    }
    
    function eliminar_aviso($array_id)
    {       
        foreach($array_id as $id){
            $this->db->where('id', $id);
            $this->db->delete('inferior');
        }                   
       // return $consulta->row_array();           
    }
    
    function crear_aviso($contenido,$estado)
    {
      $data = array(
                   'contenido' => $contenido ,
                   'fecha' => mdate('%Y-%m-%d'),
                   'estado' => $estado                   
                );
        $this->db->insert('inferior', $data);   
    }
}

//location: application/models/login_model.php

?>
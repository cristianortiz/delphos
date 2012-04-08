<?php

class Panel_lateral_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
    }
  
    function get_aviso($id)
    {
        $this->db->select('id,contenido');
        $this->db->where('id', $id);                    
        $consulta = $this->db->get('lateral');
        return $consulta->row_array();           
    }
    
    function editar_aviso($id,$datos)
    {       
        $this->db->where('id',$id);
        $this->db->update('lateral',$datos);                             
    }
    
    function eliminar_aviso($id)
    {       
        $this->db->where('id', $id);
        $this->db->delete('lateral');                    
       // return $consulta->row_array();           
    }
    
    function crear_aviso($contenido)
    {
      $data = array(
                   'contenido' => $contenido ,
                   'fecha' => mdate('%Y-%m-%d') ,                   
                );
        $this->db->insert('lateral', $data);   
    }
}

//location: application/models/login_model.php

?>
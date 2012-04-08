<?php

class Home_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
  
    function get_panel_inferior()
    {
        $consulta = $this->db->query("SELECT DATE_FORMAT(fecha,'%d-%m-%Y') AS fecha,id,contenido
                                       FROM footer ORDER BY fecha DESC");
        
        return $consulta->result_array();     
    }
    
     function get_panel_lateral()
    {
        $consulta = $this->db->query("SELECT DATE_FORMAT(fecha,'%d-%m-%Y') AS fecha,id,contenido
                                       FROM lateral ORDER BY fecha DESC");
        
        return $consulta->result_array();     
    }
    
     function get_panel_principal()
    {
        $this->db->select('id, titulo, descripcion,contenido');                    
        $consulta = $this->db->get('principal');
        return $consulta->result_array();
        
        
    }
    
     function get_visualizacion()
    {
        $this->db->select('id,desplegar');                    
        $consulta = $this->db->get('visualizar');
        return $consulta->row_array();
        
        
    }
}

//location: application/models/login_model.php

?>
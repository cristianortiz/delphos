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
    
     function cambiar_estado_noticia($array_id,$datos)
    {
        foreach($array_id as $id){
             $this->db->where('id', $id);
        $this->db->update('lateral', $datos);
        }
    }
    
    function editar_aviso($id,$datos)
    {       
        $this->db->where('id',$id);
        $this->db->update('lateral',$datos);                             
    }
    
    function configurar_noticias($id,$datos)
    {       
        $this->db->where('id',$id);
        $this->db->update('visualizar',$datos);                             
    }
     function eliminar_noticia($array_id)
    {
        foreach($array_id as $id){
            $this->db->where('id', $id);
            $this->db->delete('lateral');
        }
    }
    
    function crear_noticia($contenido,$estado)
    {
      $data = array(
                   'contenido' => $contenido ,
                   'fecha' => mdate('%Y-%m-%d') ,
                   'estado'=> $estado                   
                );
        $this->db->insert('lateral', $data);   
    }
}

//location: application/models/login_model.php

?>
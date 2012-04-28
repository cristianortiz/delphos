<?php

class Panel_principal_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
    }
  
    function get_texto($id)
    {
        $this->db->select('id,titulo,descripcion,contenido');
        $this->db->where('id', $id);                    
        $consulta = $this->db->get('principal');
        return $consulta->row_array();           
    }
    
     function get_video($id)
    {
        $this->db->select('id,nombre,url,tipo');
        $this->db->where('id', $id);                    
        $consulta = $this->db->get('video');
        return $consulta->row_array();           
    }
    
    function borrar_video($id)
    {       
        $this->db->where('id', $id);
        $this->db->delete('video');                    
        //return $consulta->row_array();           
    }
    
    function editar_texto($id,$datos)
    {       
        $this->db->where('id',$id);
        $this->db->update('principal',$datos);                             
    }
    
    function eliminar_texto($id)
    {       
        $this->db->where('id', $id);
        $this->db->delete('principal');                    
        return $consulta->row_array();           
    }
    
    function crear_texto($contenido)
    {
      $data = array(
                   'contenido' => $contenido ,
                   'fecha' => mdate('%Y-%m-%d') ,                   
                );
        $this->db->insert('lateral', $data);   
    }
    function get_videos()
    {
        $this->db->select('id,nombre,descripcion,url,tipo');                         
        $consulta = $this->db->get('video');
        return $consulta->result_array();           
    }
    
    function actualizar_opcion($id,$datos)
    {       
        $this->db->where('id',$id);
        $this->db->update('visualizar',$datos);                             
    }
    
    
 
   public function insert_file($filename, $desc,$ruta,$tipo)
   {
      $data = array(
         'nombre'     => $filename,
         'descripcion'        => $desc,
         'url'=> $ruta,
         'tipo'=>$tipo
      );
      $this->db->insert('video', $data);
      return $this->db->insert_id();
   }
 
}
    


//location: application/models/login_model.php

?>
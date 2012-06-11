<?php

class Panel_principal_model extends CI_Model
{

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
    
     function recupera_tiempo()
    {
        $this->db->select('id,desplegar,tiempo');                    
        $consulta = $this->db->get('visualizar');
        return $consulta->row_array();
        
        
    }
    

    function get_video($id)
    {
        $this->db->select('id,nombre,url,tipo,descripcion,fecha');
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

    function editar_texto($id, $datos)
    {
        $this->db->where('id', $id);
        $this->db->update('principal', $datos);
    }

    function eliminar_texto($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('principal');

    }

    function crear_nuevo_articulo($imagen,$descripcion,$titulo,$contenido)
    {
        $data = array(
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'contenido' => $contenido,
            'imagen' => $imagen,
            'fecha' => mdate('%Y-%m-%d'));
        $this->db->insert('principal', $data);
        return $this->db->insert_id();
    }
    function get_videos()
    {
        $this->db->select('id,nombre,descripcion,url,tipo');
        $consulta = $this->db->get('video');
        return $consulta->result_array();
    }

    function actualizar_opcion($id, $datos)
    {
        $this->db->where('id', $id);
        $this->db->update('visualizar', $datos);
    }


    public function insert_file($filename, $desc, $ruta, $tipo)
    {
        $data = array(
            'nombre' => $filename,
            'descripcion' => $desc,
            'url' => $ruta,
            'tipo' => $tipo,
            'fecha' => mdate('%Y-%m-%d'));
        $this->db->insert('video', $data);
        return $this->db->insert_id();
    }
    
     function get_imagen($id)
    {
        $this->db->select('imagen');
        $this->db->where('id', $id);
        $consulta = $this->db->get('principal');
        return $consulta->row_array();
    }

    public function actualizar_imagen($imagen, $id)
    {
        $data = array('imagen' => $imagen);
        $this->db->where('id', $id);
        $this->db->update('principal', $data);
       return $id; 
    }
    public function borrar_imagen($id)
    {
        $data = array('imagen' => '');
        $this->db->where('id', $id);
        $this->db->update('principal', $data);
       return $id; 
    }

}


//location: application/models/login_model.php



?>
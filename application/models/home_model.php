<?php

class Home_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_panel_inferior()
    {
        $consulta = $this->db->query("SELECT DATE_FORMAT(fecha,'%d-%m-%Y') AS fecha,id,contenido
                                      FROM inferior
                                      WHERE estado = 'activo' ORDER BY fecha DESC");

        return $consulta->result_array();
    }

    function get_panel_lateral()
    {
        $consulta = $this->db->query("SELECT DATE_FORMAT(fecha,'%d-%m-%Y') AS fecha,id,contenido
                                       FROM lateral
                                       WHERE estado = 'activo'
                                       ORDER BY fecha DESC");

        return $consulta->result_array();
    }

    function get_panel_principal()
    {
        $this->db->select('id, titulo, descripcion,contenido,imagen,fecha');
        $this->db->where('estado', ACTIVO);
        $consulta = $this->db->get('principal');
        return $consulta->result_array();
    }

    function get_visualizacion()
    {
        $this->db->select('id,desplegar,num_noticias_lat,max_caracteres_lat');
        $consulta = $this->db->get('visualizar');
        return $consulta->row_array();

    }

    public function record_count($tabla,$estado)
    {       
        $this->db->from($tabla);
        $this->db->where('estado', $estado);
        return $this->db->count_all_results();                
    }
     public function record_count_videos($tabla)
    {       
        
        return $this->db->count_all($tabla);                
    }
    
    public function filas_paginadas($tabla, $limit, $start, $estado)
    {
        $this->db->limit($limit, $start);
        $this->db->where('estado', $estado);
        $this->db->order_by("fecha", "desc");
        $query = $this->db->get($tabla);

        if ($query->num_rows() > 0) {

            return $query->result_array();
        }

    }
    
     public function filas_paginadas_videos($tabla, $limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->order_by("fecha", "desc");
        $query = $this->db->get($tabla);

        if ($query->num_rows() > 0) {

            return $query->result_array();
        }

    }
}

//location: application/models/Home_model.php


?>
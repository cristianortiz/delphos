<?php

class Login_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function username_check($username)
    {
        $this->db->select('COUNT(*) AS resultado');
        $this->db->where('username', $username);
              
        $consulta = $this->db->get('academico');
        return $consulta->row_array();
    }
    
    function login_user($username,$password)
    {
        $this->db->select('COUNT(*) AS resultado,perfil_id');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
              
        $consulta = $this->db->get('academico');
        return $consulta->row_array();  
             
    }
    
    function admin_check($username,$password)
    {
        $this->db->select('COUNT(*) AS resultado,perfil_id');
        $this->db->where('id_admin', $username);
        $this->db->where('pass_admin', $password);
              
        $consulta = $this->db->get('administrador');
        return $consulta->row_array();     
    }
}

//location: application/models/login_model.php

?>
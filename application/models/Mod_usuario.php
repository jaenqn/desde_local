<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_usuario extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    public function verificar_usuario($values){
        $this->db->select();
        $this->db->where('usu_cuenta', $values['usuario']);
        $this->db->where('usu_pass', Hash::getHash($values['pass'], HASH_KEY, 'md5'));
        return $this->db->get('tbl_usuarios')->row();
    }
    public function verificar_nomusuario($values){
        $this->db->select();
        $this->db->where('usu_cuenta', $values);
        return $this->db->get('tbl_usuarios')->row();
    }

    public function insertar_usuario($values){
        $this->db->set($values);
        $res = $this->verificar_nomusuario($values['usu_cuenta']);
        if(!$res)
            return $this->db->insert('tbl_usuarios');
        else return false;
    }

}
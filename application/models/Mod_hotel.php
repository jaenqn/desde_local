<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_hotel extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    public function getcorrelativos($idhotel){
        $this->db->select();
        $this->db->where('hot_id', $idhotel);
        $res = $this->db->get('tbl_hoteles')->row();
        $correlativo = array();
        if($res){
            $correlativo[] = array('tipo' => 1, 'value' => $res->hot_cfactura, 'name' => 'factura');
            $correlativo[] = array('tipo' => 3, 'value' => $res->hot_cboleta, 'name' => 'boleta');
            $correlativo[] = array('tipo' => 7, 'value' => $res->hot_cnocre, 'name' => 'factura');
            $correlativo[] = array('tipo' => 8, 'value' => $res->hot_cndeb, 'name' => 'factura');
            return $correlativo;
        }else return false;

    }
    public function insertar_hotel(&$values){
        $this->db->set($values);
        $res =  $this->db->insert('tbl_hoteles');
        if($res) $values['hot_id'] = $this->db->insert_id();
        return $res;
    }
    public function eliminar($id){
        $this->db->db_debug = false;
        $this->db->where('hot_id', $id);
        $res = $this->db->delete('tbl_hoteles');
        $this->db->db_debug = true;
        return $res;
    }
    public function getdata($id){
        $this->db->select();
        $this->db->where('hot_id', $id);
        return $this->db->get('tbl_hoteles')->row();
    }
    public function actualizar_hotel($values){
        $this->db->set($values);
        $this->db->where('hot_id', $values['hot_id']);
        return $this->db->update('tbl_hoteles');
    }
    public function lst_hoteles(){


        $this->db->select();
        return $this->db->get('tbl_hoteles')->result_object();
    }

}
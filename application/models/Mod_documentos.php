<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_documentos extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    public function eliminar($iddoc){
        $this->db->where('doc_id', $iddoc);
        return $this->db->delete('tbl_documento');
    }
    public function existe_hotel($id){
        $this->db->where('hot_id', $id);
        return $this->db->get('tbl_hoteles')->row();
    }
    function insertar(&$values){
        if(trim($values->doc_ruta) == '') $values->doc_ruta = 'nopath';
        if(trim($values->doc_ruta_xml) == '') $values->doc_ruta_xml = 'nopath';

        $values->doc_correlativo = $values->doc_correlativo.'-'.sprintf("%08d", $values->doc_num_doc);
        if($this->db->insert('tbl_documento', $values)){
            $values->doc_id = $this->db->insert_id();
            return true;
        }else return false;
    }
    function insertar_alterno(&$values){

        if($this->db->insert('tbl_documento', $values)){
            $values['doc_id'] = $this->db->insert_id();
            return true;
        }else return false;
    }
    function getdata($num, $tipo){
        $this->db->select();
        $this->db->where('doc_num_doc', $num);
        $this->db->where('doc_tipo', $tipo);
        return $this->db->get('tbl_documento')->row();
        // $msg = $this->db->last_query();

    }
    function getwhere($opc){
        $this->db->select();
        $this->db->where($opc);
        return $this->db->get('tbl_documento')->row();
    }

    function getdatabyid($id){
        $this->db->select();
        $this->db->where('doc_id', $id);
        $r =  $this->db->get('tbl_documento')->row();
        $r->doc_fecha_format = DateTime::createFromFormat('Y-m-d H:i:s', $r->doc_fecha_emision)->format('d/m/Y');
        return $r;
    }
    function getcorrelativos($tipo){

        $this->db->select('doc_correlativo');
        $this->db->where('doc_tipo', $tipo);
        return $this->db->get('tbl_documento')->result_object();
    }
    function update_path($values){
        // print_r($values);
        $this->db->set($values);
        $this->db->where('doc_id', $values['doc_id']);
        return $this->db->update('tbl_documento');


    }
    function consultar_doc($values){
        // print_r($values);
        $this->db->select();
        $this->db->where('doc_tipo', $values['tipo']);
        $this->db->where('doc_correlativo', $values['num_doc']);
        $this->db->where('doc_fecha_emision', $values['fecha']);
        $this->db->where('doc_monto_total', $values['monto']);
        $this->db->where('hot_id_hotel', $values['hotel']);
        $this->db->where('doc_tipo_monto', $values['tipo_moneda']);
        return $this->db->get('tbl_documento')->row();
    }
    function testacces(){
        $this->db->select();
        $q = $this->db->get('tbl_documento')->result_object();
        echo $this->db->last_query();
        return $q;
    }

}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $datos = array();


        $this->smartys->assign($datos);
        $this->smartys->render('index');
    }

    public function registrar(){
        if($this->input->is_ajax_request()){
            $this->load->model('mod_documentos', 'doc');
            $p = $this->input->post();
            // print_r($p);
            // date_default_timezone_set('America/Lima');
            $fechatemp = DateTime::createFromFormat('d/m/Y', $p['txt_fecha_emision']);
            // print_r($fechatemp);exit;
            if(existen_vars($p, array(
                'sel_tipo','txt_id','txt_correlativo','txt_fecha_emision','txt_tipo_moneda','txt_monto','sel_hotel'
                )) && existen_vars($_FILES, array('filepdf', 'filexml')) && $fechatemp){

                $objH = $this->doc->existe_hotel(+$p['sel_hotel']);
                if($objH){

                    $values['doc_correlativo'] = $p['txt_correlativo'];
                    $values['doc_tipo'] = $p['sel_tipo'];
                    $values['doc_fecha_emision'] =  $fechatemp->format('Y-m-d');
                    $values['doc_tipo_monto'] = $p['txt_tipo_moneda'];
                    $values['doc_monto_total'] = $p['txt_monto'];
                    $values['hot_id_hotel'] = +$p['sel_hotel'];
                    $numcorre = explode('-', $values['doc_correlativo']);
                    $values['doc_num_doc'] = +end($numcorre);

                    // print_r($values);
                    if($this->doc->insertar_alterno($values)){
                    // if(true){
                        //mover los ficheros
                        $rutabase = DOCSPATH.'hotel00'.$objH->hot_id;
                        if(!is_dir($rutabase)){
                            mkdir($rutabase, 0700);
                        }
                        if(!is_dir($rutabase.DS.'pdf'))
                            mkdir($rutabase.DS.'pdf', 0700);

                        if(!is_dir($rutabase.DS.'xml'))
                            mkdir($rutabase.DS.'xml', 0700);

                        if($_FILES['filepdf']['error'] == 0 && $_FILES['filepdf']['type'] == 'application/pdf'){
                            if(move_uploaded_file($_FILES['filepdf']['tmp_name'], $rutabase.DS.'pdf'.DS.$_FILES['filepdf']['name'])){
                                $valpdf['doc_ruta'] = 'hotel00'.$objH->hot_id.'/pdf/'.$_FILES['filepdf']['name'];
                                $valpdf['doc_id'] = $values['doc_id'];
                                $this->doc->update_path($valpdf);
                            }else{
                                $valpdf['doc_ruta'] = 'nopath';
                                $valpdf['doc_id'] = $values['doc_id'];
                                $this->doc->update_path($valpdf);
                            }
                        }
                        if($_FILES['filexml']['error'] == 0 && $_FILES['filexml']['type'] == 'text/xml'){
                            if(move_uploaded_file($_FILES['filexml']['tmp_name'], $rutabase.DS.'xml'.DS.$_FILES['filexml']['name'])){
                                $valxml['doc_ruta_xml'] = 'hotel00'.$objH->hot_id.'/xml/'.$_FILES['filexml']['name'];
                                $valxml['doc_id'] = $values['doc_id'];
                                $this->doc->update_path($valxml);
                            }else{
                                $valxml['doc_ruta_xml'] = 'nopath';
                                $valxml['doc_id'] = $values['doc_id'];
                                $this->doc->update_path($valxml);
                            }
                        }




                        echo_json(array(
                            'msg' => 'registrado',
                            'resultado' => true
                            ));
                    }else echo_json(array('msg' => 'fail_reg'));
                }else echo_json(array('msg' => 'No encontrado'));

            }else echo_json(array('msg' => 'No encontrado'));

        }else echo_json(array('msg' => 'No encontrado'));
    }
    public function getdoc($iddoc){
        if($this->input->is_ajax_request()){
            if(is_numeric($iddoc)){
                $this->load->model('mod_documentos', 'doc');
                $objH = $this->doc->getdatabyid($iddoc);
                if($objH){
                    echo_json(array(
                        'msg' => 'success',
                        'objRes' => $objH,
                        'resultado' => true
                        ));
                }else echo_json(array('msg'=>'no encontrado'));
            }else echo_json(array('msg'=>'no encontrado'));
        }else echo_json(array('msg'=>'no encontrado'));
    }
    public function actualizar(){

        if($this->input->is_ajax_request()){
            $this->load->model('mod_documentos', 'doc');
            $p = $this->input->post();
            $fechatemp = DateTime::createFromFormat('d/m/Y', $p['txt_fecha_emision']);
            if(existen_vars($p, array(
                'sel_tipo','txt_id','txt_correlativo','txt_fecha_emision','txt_tipo_moneda','txt_monto','sel_hotel'
                )) && existen_vars($_FILES, array('filepdf', 'filexml')) && $fechatemp){

                $values['doc_id'] = $p['txt_id'];
                $values['doc_correlativo'] = $p['txt_correlativo'];
                $values['doc_tipo'] = $p['sel_tipo'];
                $values['doc_fecha_emision'] =  $fechatemp->format('Y-m-d');
                $values['doc_tipo_monto'] = $p['txt_tipo_moneda'];
                $values['doc_monto_total'] = $p['txt_monto'];
                $values['hot_id_hotel'] = +$p['sel_hotel'];

                $numcorre = explode('-', $values['doc_correlativo']);
                $values['doc_num_doc'] = +end($numcorre);

                $objH = $this->doc->existe_hotel(+$p['sel_hotel']);
                if($objH){
                    if($this->doc->update_path($values)){
                    // if(true){
                        //mover los ficheros
                        $rutabase = DOCSPATH.'hotel00'.$objH->hot_id;
                        if(!is_dir($rutabase)){
                            mkdir($rutabase, 0700);
                        }
                        if(!is_dir($rutabase.DS.'pdf'))
                            mkdir($rutabase.DS.'pdf', 0700);

                        if(!is_dir($rutabase.DS.'xml'))
                            mkdir($rutabase.DS.'xml', 0700);
                        if($_FILES['filepdf']['error'] == 0 && $_FILES['filepdf']['type'] == 'application/pdf'){
                            if(move_uploaded_file($_FILES['filepdf']['tmp_name'], $rutabase.DS.'pdf'.DS.$_FILES['filepdf']['name'])){
                                $valpdf['doc_ruta'] = 'hotel00'.$objH->hot_id.'/pdf/'.$_FILES['filepdf']['name'];
                                $valpdf['doc_id'] = $values['doc_id'];
                                $this->doc->update_path($valpdf);
                            }else{
                                $valpdf['doc_ruta'] = 'nopath';
                                $valpdf['doc_id'] = $values['doc_id'];
                                $this->doc->update_path($valpdf);
                            }
                        }
                        if($_FILES['filexml']['error'] == 0 && $_FILES['filexml']['type'] == 'text/xml'){
                            if(move_uploaded_file($_FILES['filexml']['tmp_name'], $rutabase.DS.'xml'.DS.$_FILES['filexml']['name'])){
                                $valxml['doc_ruta_xml'] = 'hotel00'.$objH->hot_id.'/xml/'.$_FILES['filexml']['name'];
                                $valxml['doc_id'] = $values['doc_id'];
                                $this->doc->update_path($valxml);
                            }else{
                                $valxml['doc_ruta_xml'] = 'nopath';
                                $valxml['doc_id'] = $values['doc_id'];
                                $this->doc->update_path($valxml);
                            }
                        }




                        echo_json(array(
                            'msg' => 'registrado',
                            'resultado' => true
                            ));
                    }else echo_json(array('msg' => 'fail_reg'));
                }else echo_json(array('msg' => 'No encontrado'));

            }else echo_json(array('msg' => 'No encontrado'));

        }else echo_json(array('msg' => 'No encontrado'));
    }
    public function eliminar(){
        if($this->input->is_ajax_request()){
            $p = $this->input->get();
            if(isset($p['id_doc'])){
                $idDoc = $p['id_doc'];
                if(is_numeric($idDoc)){
                    $this->load->model('mod_documentos', 'doc');
                    $obj = $this->doc->eliminar($idDoc);
                    if($obj){
                        echo_json(array(
                            'msg' => 'success',
                            'resultado' => true
                            ));
                    }else echo_json(array('msg'=>'no encontrado'));
                }else echo_json(array('msg'=>'no encontrado'));
            }else echo_json(array('msg'=>'no encontrado'));
        }else echo_json(array('msg'=>'no encontrado'));
    }
    public function datatable(){
        $this->load->model('mod_datatables','dt');
        $order = false;
        $selects = array();
        // print_r($_POST);
        if(isset($_POST['order'])){
            foreach ($_POST['order'] as $key => $value) {
                switch ($_POST['columns'][$value['column']]['data']) {
                    case 'doc_fecha_format':
                        $order['doc_fecha_emision'] = $value['dir'];
                        break;
                    default :
                        $order[$_POST['columns'][$value['column']]['data']] = $value['dir'];
                        break;

                }
            }
            // switch ($_POST['columns'][$_POST['order']['0']['column']]['data']) {
            //     case 'doc_fecha_format':
            //         $order = array('doc_fecha_emision' => $_POST['order']['0']['dir']);
            //         break;

            // }

        }
        $filter = array();
        $likes = array();
        // print_r($_POST);
        if($this->input->post('filters')){
            $p = $this->input->post('filters');
            $i = 0;
            foreach ($p as $key => $value) {
                switch ($value['column']) {
                    case 'hot_id_hotel':
                        $filter[] = $p[$i];
                        break;
                }
                $i++;
            }
        }
        $_POST['f'] = $filter;
        $_POST['l'] = $likes;
        $joins = array(
                array('tbl_hoteles', 'tbl_hoteles.hot_id = tbl_documento.hot_id_hotel')
                // array('tbl_procesos', 'tbl_procesos.pro_id = tbl_procesos_etapa.pro_id_proceso')
                // array('departamentos','departamentos.dep_id = unidades.dep_id_departamento')
            );
        $datas = $this->dt->get_datatables('tbl_documento','object',$likes, $filter,$selects, $order,$joins,$_POST['length'],$_POST['start']);
        foreach ($datas['list'] as $key => $value) {
            $value->doc_fecha_format = DateTime::createFromFormat('Y-m-d H:i:s', $value->doc_fecha_emision)->format('d/m/Y');
            $tema = explode('/', $value->doc_ruta);
            $temb = explode('/', $value->doc_ruta_xml);
            $value->doc_ruta_formatpdf = end($tema);
            $value->doc_ruta_formatxml = end($temb);
        }
        // $list = get_object_vars($list);
        $data = array();
        $no = $_POST['start'];


        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $datas['count_all'],
                        "recordsFiltered" => $datas['count_filtered'],
                        "data" => $datas['list'],
                        "post" => $_POST
                );
        //output to json format
        echo json_encode($output);
        // {
        //   "draw": 2,
        //   "recordsTotal": 57,
        //   "recordsFiltered": 57,
        //   "data": [

        //     [
        //       "Gavin",
        //       "Cortez",
        //       "Team Leader",
        //       "San Francisco",
        //       "26th Oct 08",
        //       "$235,500"
        //     ]
        //   ]
        // }
    }

}
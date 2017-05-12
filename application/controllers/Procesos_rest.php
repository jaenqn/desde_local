<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once LIBSPATH.'REST_Controller.php';
class Procesos_rest extends Restserver\Libraries\REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('mod_documentos','doc');
    }
    function index_post(){
        print_r($this);
        echo 'asdasd';
    }
    function test_post(){
        print_r($_POST);
        $this->response(array('id'=>'12','name'=>'KAer'));
    }
    function test_get($id){
        echo $id;
        // print_r($this);
        $this->response(array('id'=>'12','name'=>'KAer'));
    }
    function correlativos_get($tipo){

        $objd = $this->doc->getdatabyid($id);
        $this->response($objd,200);
    }
    function data_get($id){

        $objd = $this->doc->getdatabyid($id);
        $this->response($objd,200);
    }
    function existe_get($correlativo,$tipo, $idhotel){

        //enviar, numero de correlativo y tipo de documento 3 boleta 1 factura
        if(is_numeric($correlativo)){
            $val['doc_num_doc'] = $correlativo;
            $val['hot_id_hotel'] = $idhotel;
            $val['doc_tipo'] = $tipo;
            $objD = $this->doc->getwhere($val);

            if($objD){
                //$this->response(array('success' => true, 'message' =>'existe_doc : '.$correlativo.'--'.$tipo.'||||'.$msg));
                $this->response(array('success' => true, 'message' =>'existe_doc','code'=> $objD->doc_id));
            }else $this->response(array('success' => false, 'message' => 'not_found'));
        }else $this->response(array('success' => false, 'message' => 'fail'));


    }
    function existe_file_get($namefile){

    }
    function registrar_doc_post($modo){
        $data = file_get_contents("php://input");
        $dval = json_decode($data);
        // print_r($dval);
        unset($dval->doc_ruc);
        // print_r($dval);
        // print_r($dval);
        // $this->response(array('message'=>'error-insert'),204);


        // $dval['doc_tipo'] = $_POST['TipoDoc'];
        // $dval['doc_fecha_emision'] = $_POST['FechaEmision'];
        // $dval['doc_monto_total'] = $_POST['Monto'];
        // $dval['doc_correlativo'] = $_POST['Correlativo'];

        if($this->doc->insertar($dval)){
            $this->response(array('message'=>'doc-registrado ('.$modo.'): '.$dval->doc_correlativo,'code'=>$dval->doc_id, 'success' => true),201);
        }else $this->response(array('message'=>'error-insert'),204);



        // header('Location : '.base_url('procesos_rest/data/'.$dval->doc_id));

    }


}
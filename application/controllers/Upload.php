<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    function index(){
        $oname = "20103945039-03-BVR1-00000024.PDF";
        $onmae = substr($oname,0,strlen($oname)-4);
        print_r(explode('-',$onmae));
    }
    function document($id_doc, $tipo){
        $this->load->model('mod_documentos','doc');
        // print_r($_FILES);exit;
        $ftmp = $_FILES['file']['tmp_name'];
        $oname = $_FILES['file']['name'];
        $fname = false;
        $objD = $this->doc->getdatabyid(+$id_doc);
        // echo '>>>';
        // print_r($objD);
        // $objH = $this->doc->getdatabyid(+$id_doc);
        $movestart = false;

        $rutabase = DOCSPATH.'hotel00'.$objD->hot_id_hotel;
        if(!is_dir($rutabase)){
            mkdir($rutabase, 0700);
        }
        if(!is_dir($rutabase.DS.'pdf'))
            mkdir($rutabase.DS.'pdf', 0700);

        if(!is_dir($rutabase.DS.'xml'))
            mkdir($rutabase.DS.'xml', 0700);

        switch ($tipo) {
            case 'pdf':
                $fname = $rutabase.DS.'pdf'.DS.$oname;
                // $f = substr($oname,0,strlen($oname)-4);
                // $f = explode('-',$onmae);

                if($objD && ($objD->doc_ruta == 'nopath' || $objD->doc_ruta == '')){
                    $values['doc_id'] = $objD->doc_id;
                    $values['doc_ruta'] = 'hotel00'.$objD->hot_id_hotel.'/pdf/'.$oname;
                    $this->doc->update_path($values);
                    // exit;
                    $movestart = true;
                }

                break;
            case 'xml':
                $fname = $rutabase.DS.'xml'.DS.$oname;
                if($objD && ($objD->doc_ruta_xml == 'nopath' || $objD->doc_ruta_xml == '')){
                    //print_r($objD);
                    $values['doc_id'] = $objD->doc_id;
                    $values['doc_ruta_xml'] = 'hotel00'.$objD->hot_id_hotel.'/xml/'.$oname;
                    $this->doc->update_path($values);
                    $movestart = true;
                }
                break;
        }

        if($movestart && $fname){
            if(move_uploaded_file($ftmp, $fname))
                echo 'upload : '.$oname;
            else echo 'upload-cancel';
        }else echo 'doc-existe';

    }



}
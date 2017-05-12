<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    public function logout(){
        unset($_SESSION['id_usuario']);
        unset($_SESSION['usu_cuenta']);
        unset($_SESSION['usu_nombre']);
        unset($_SESSION['usu_logueado']);
        unset($_SESSION['usu_apellidos']);

        redirect('gestion');
    }
    public function index()
    {
            $this->load->library('recaptcha');
            $casa = 'asdasd';
            // $this->load->vars(array(
            //     'casa' => 'aEs una casa de prueba',
            //     'titulo_page' => 'Es un Título sin definir',
            //     ));
            $this->load->model('mod_hotel', 'hotel');

            $data['lst_hoteles'] = $this->hotel->lst_hoteles();
            if(count($data['lst_hoteles']) > 0){

                $data['correlativo'] =  json_encode($this->hotel->getcorrelativos($data['lst_hoteles'][0]->hot_id));

            }
            $data['lst_hoteles'] = $this->hotel->lst_hoteles();
            $this->load->getview('visitas', 'template_consulta', $data);

        // echo '<pre>';
        // print_r($tt);
        // echo '</pre>';
    }
    public function consultar(){

        $this->load->library('recaptcha');
        $answer = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($answer);
        if (isset($response['success']) and $response['success'] === true) {

            $this->load->model('mod_documentos','doc');
            $p = $this->input->post();
            // print_r($p);
            $gg = DateTime::createFromFormat('d/m/Y',$p['txtFecha']);
            if($gg)
                $val['fecha'] = $gg->format('Y-m-d');
            else $val['fecha'] = date('Y-m-d');
            $objH = $this->doc->existe_hotel($p['selHotel']);
            if($objH){
                $val['tipo'] = +$p['selTipoDoc'];
                $val['num_doc'] = $p['txtNumDoc'];
                $val['monto'] = +$p['txtMonto'];
                $val['hotel'] = +$p['selHotel'];
                $val['tipo_moneda'] = +$p['txt_tipo_moneda'];
                $objD = $this->doc->consultar_doc($val);
                // print_r($objD);
                if($objD){

                    echo json_encode(array('objData'=>$objD,'msg'=>'success'));
                }
                else echo json_encode(array('objData'=>$objD,'msg'=>'fail'));
            }else echo_json((array('msg'=>'hotel not found')));

        }else echo json_encode(array('objData'=>null,'msg'=>'fail-captcha'));
    }
    public function documento($tipo, $id){
        $cabezera = '';
        $this->load->model('mod_documentos','doc');
        $objD = $this->doc->getdatabyid($id);

        switch($tipo){
            case 'pdf':
                if($objD->doc_ruta != '' && $objD->doc_ruta != 'nopath'){
                    $name = explode('/',$objD->doc_ruta);

                    header('Content-Type: application/pdf');
                    header('Content-Disposition:attachment; filename='.end($name));
                    header('Cache-Control: max-age=0');
                    if(ob_get_contents())
                        ob_end_clean();
                    readfile(DOCSPATH.$objD->doc_ruta);
                }else echo json_encode(array('msg'=>'no_resource'));
                 break;
            case 'xml':
                if($objD->doc_ruta_xml != '' && $objD->doc_ruta_xml != 'nopath'){
                    $name = explode('/',$objD->doc_ruta_xml);

                    header('Content-Type: application/xml');
                    header('Content-Disposition:attachment; filename='.end($name));
                    header('Cache-Control: max-age=0');
                    if(ob_get_contents())
                        ob_end_clean();
                    readfile(DOCSPATH.$objD->doc_ruta_xml);
                }else echo json_encode(array('msg'=>'no_resource'));
                 break;
            default:
                echo json_encode(array('msg'=>'no_resource'));
                break;
        }




    }
    public function crear_usuario_admin(){
        $this->load->model('mod_usuario', 'usu');
        $val['usu_cuenta'] = 'admin';
        $val['usu_pass'] = Hash::getHash('admin', HASH_KEY, 'md5');
        $val['usu_nombre'] = 'admin';
        $val['usu_apellidos'] = 'admin';
        $res =  $this->usu->insertar_usuario($val);
        echo_json(array('result' => $res));
    }

}
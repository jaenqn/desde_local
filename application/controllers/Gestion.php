<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        if(!isset($_SESSION['usu_logueado'])){

            $this->load->getview('login','template_login');
        }else redirect('gestion/hoteles');
    }
    public function getcorrelativo(){
        if($this->input->is_ajax_request()){
            $p = $this->input->get();
            if(existen_vars($p, array('id_hotel'))){
                if(is_numeric($p['id_hotel'])){
                    $this->load->model('mod_hotel', 'hotel');
                    $objH = $this->hotel->getdata($p['id_hotel']);
                    if($objH){
                        $correlativo = $this->hotel->getcorrelativos($objH->hot_id);
                        echo_json(array(
                            'msg' => 'success',
                            'objRes' => $correlativo,
                            'resultado' => true
                            ));
                    }else echo_json(array('msg'=>'no encontrado'));
                }else echo_json(array('msg'=>'no encontrado'));
            }else echo_json(array('msg'=>'no encontrado'));
        }else echo_json(array('msg'=>'no encontrado'));
    }
    public function hoteles(){
        if(isset($_SESSION['usu_logueado'])){
            $data['title_header'] = 'Gestionar Hoteles';
            $data['title_page'] = 'Gestionar Hoteles';

            $this->load->getview('ges_hoteles', 'template', $data);
        }else redirect('gestion');
    }
    public function documentos(){

        if(isset($_SESSION['usu_logueado'])){
            $data['title_header'] = 'Lista de Documentos';
            $data['title_page'] = 'Gestionar  Documentos';
            $this->load->model('entidades/ent_documentos');
            $this->load->model('mod_hotel', 'hotel');
            $data['lst_hoteles'] = $this->hotel->lst_hoteles();
            if(count($data['lst_hoteles']) > 0){

                $data['correlativo'] =  json_encode($this->hotel->getcorrelativos($data['lst_hoteles'][0]->hot_id));

            }

            $this->load->getview('ges_documentos', 'template', $data);
        }else redirect('gestion');
    }
    public function Login(){
        if($this->input->is_ajax_request()){
            $res = array(
                'msg' => 'invalid',
                'success' => false
                );
            $p = $this->input->post();
            // print_r($p);
            if(isset($p['txtusuario']) && isset($p['txtpass'])){
                $this->load->model('mod_usuario', 'usu');
                $values['usuario'] = $p['txtusuario'];
                $values['pass'] = $p['txtpass'];
                $objUsu = $this->usu->verificar_usuario($values);
                // echo $this->db->last_query();
                if($objUsu){
                    $this->session->id_usuario = $objUsu->usu_id;
                    $this->session->usu_logueado = true;
                    $this->session->usu_cuenta = $objUsu->usu_cuenta;
                    $this->session->usu_nombre = $objUsu->usu_nombre;
                    $this->session->usu_apellidos = $objUsu->usu_apellidos;
                    $res['msg'] = 'exito';
                    $res['success'] = true;
                }else{
                    $res['msg'] = 'usuario no found';
                    $res['success'] = false;
                }

                echo json_encode($res);
            }else echo json_encode($res);

        }else show_404();
    }
    public function create_usuario(){

    }
    public function registrar_hotel(){
        if($this->input->is_ajax_request()){
            $this->load->model('mod_hotel', 'hotel');
            $p = $this->input->post();
            if(existen_vars($p, array(
                'txt_hotel','txt_id','txt_ruc','txt_fatcura','txt_Boleta','txt_notcre','txt_txtdeb'
                ))){

                $values['hot_nombre'] = $p['txt_hotel'];
                $values['hot_ruc'] = $p['txt_ruc'];
                $values['hot_cfactura'] = $p['txt_fatcura'];
                $values['hot_cboleta'] = $p['txt_Boleta'];
                $values['hot_cnocre'] = $p['txt_notcre'];
                $values['hot_cndeb'] = $p['txt_txtdeb'];
                if($this->hotel->insertar_hotel($values)){
                    echo_json(array(
                        'msg' => 'registrado',
                        'resultado' => true
                        ));
                }else echo_json(array('msg' => 'fail_reg'));

            }else echo_json(array('msg' => 'No encontrado'));

        }else echo_json(array('msg' => 'No encontrado'));
    }
    public function gethotel($idhotel){
        if($this->input->is_ajax_request()){
            if(is_numeric($idhotel)){
                $this->load->model('mod_hotel', 'hotel');
                $objH = $this->hotel->getdata($idhotel);
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
    public function actualizar_hotel(){

        if($this->input->is_ajax_request()){
            $this->load->model('mod_hotel', 'hotel');
            $p = $this->input->post();
            if(existen_vars($p, array(
                'txt_id','txt_hotel','txt_ruc','txt_fatcura','txt_Boleta','txt_notcre','txt_txtdeb'
                ))){

                $values['hot_id'] = $p['txt_id'];
                $values['hot_nombre'] = $p['txt_hotel'];
                $values['hot_ruc'] = $p['txt_ruc'];
                $values['hot_cfactura'] = $p['txt_fatcura'];
                $values['hot_cboleta'] = $p['txt_Boleta'];
                $values['hot_cnocre'] = $p['txt_notcre'];
                $values['hot_cndeb'] = $p['txt_txtdeb'];
                if($this->hotel->actualizar_hotel($values)){
                    echo_json(array(
                        'msg' => 'actualizado',
                        'resultado' => true
                        ));
                }else echo_json(array('msg' => 'fail_reg'));

            }

        }else echo_json(array('msg' => 'No encontrado'));
    }
    public function eliminar_hotel(){
        if($this->input->is_ajax_request()){
            $p = $this->input->get();
            if(isset($p['id_hotel'])){
                $idhotel = $p['id_hotel'];
                if(is_numeric($idhotel)){
                    $this->load->model('mod_hotel', 'hotel');
                    $objH = $this->hotel->eliminar($idhotel);
                    if($objH){
                        echo_json(array(
                            'msg' => 'success',
                            'resultado' => true
                            ));
                    }else echo_json(array('msg'=>'no encontrado'));
                }else echo_json(array('msg'=>'no encontrado'));
            }else echo_json(array('msg'=>'no encontrado'));
        }else echo_json(array('msg'=>'no encontrado'));
    }
    private function getlocationcorre($tipo){
           $medidas = array(
            'codtipodoc' => $tipo,
            'ruc' => array(14,1.8,20.2,2.5),
            'correlativo' => array(14.4,4,19.7,4.8),
            'fecha' => array(3.3,7.7,5.3,8.2),
            'monto' => array(15.3,21.8,20.5,22.7),
            'tipo_pago' => array(3.9,27.3,10.8,27.8)
            );
           return $medidas;
    }
    public function configjson($id){
        $this->load->model('mod_hotel', 'hotel');
        $objH = $this->hotel->getdata($id);

        $res['path_xml'] = 'ruta_folder';
        $res['path_pdf'] = 'ruta_folder';
        $res['base_url'] = base_url('');
        $res['time_loop'] = '5000';
        $res['id_hotel'] = $objH->hot_id;
        $res['ruc_hotel'] = $objH->hot_ruc;
        $res['correlativos'] = array(
            'factura' => $objH->hot_cfactura,
            'boleta' => $objH->hot_cboleta,
            'credito' => $objH->hot_cnocre,
            'debito' => $objH->hot_cndeb,
            );

        $res['locations_pdf'] = array(
            'factura' => $this->getlocationcorre(1),
            'boleta' => $this->getlocationcorre(3),
            'credito' => $this->getlocationcorre(7),
            'debito' => $this->getlocationcorre(8)
            );

        header('Content-disposition: attachment; filename=config.json');
        header('Content-type: application/json');
        echo_json($res);
    }
    public function datatable_hoteles(){
        $this->load->model('mod_datatables','dt');
        $order = false;
        $selects = array();
        if(isset($_POST['order'])){

            switch ($_POST['columns'][$_POST['order']['0']['column']]['data']) {
                // case 'get_estado':
                //     $order = array('pro_estado' => $_POST['order']['0']['dir']);
                //     break;

            }

        }
        $filter = array();
        $likes = array();
        if($this->input->post('filters')){
            $p = $this->input->post('filters');
            $i = 0;
            foreach ($p as $key => $value) {
                switch ($value['column']) {
                    case 'pel_nombre':
                        $likes[] = $p[$i];
                        break;
                    case 'pel_estado':
                        $filter[] = $p[$i];
                        break;
                }
                $i++;
            }
        }
        $_POST['f'] = $filter;
        $_POST['l'] = $likes;
        $joins = array(
                // array('tbl_categorias', 'tbl_categorias.cat_id = tbl_peligros.cat_id_categoria')
                // array('tbl_procesos', 'tbl_procesos.pro_id = tbl_procesos_etapa.pro_id_proceso')
                // array('departamentos','departamentos.dep_id = unidades.dep_id_departamento')
            );
        $datas = $this->dt->get_datatables('tbl_hoteles','object',$likes, $filter,$selects, $order,$joins,$_POST['length'],$_POST['start']);
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
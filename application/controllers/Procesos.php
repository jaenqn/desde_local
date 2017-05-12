<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 0);
class Procesos extends CI_Controller {
    private $_ss = null;
    function __construct() {
        parent::__construct();
        require_once LIBSPATH.'nusoap/lib/nusoap.php';
        $this->_ss = new soap_server();
        $this->_ss->configureWSDL('TestWSDL','urn:webserv');

        $this->_ss->register('subirpe',array('a' =>'xsd:string'),
            array(
                'return' => 'xsd:string'
            ),'urn:SOAPServerWSDL', 'urn:', 'rpc','encoded', 'Servicio de Prueba');



    }

    public function index()
    {
        exit;
    }
    public function subir_ficheros(){

        function subirpe($a){
            return $a.'asdasdasdasd';
        }
        $this->_ss->service(file_get_contents('php://input'));

    }
    public function casa(){}

}

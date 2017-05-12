<?php defined('BASEPATH') OR exit('No direct script access allowed');

class testuser extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        echo sprintf("%09d", 2111111123);
    }

}
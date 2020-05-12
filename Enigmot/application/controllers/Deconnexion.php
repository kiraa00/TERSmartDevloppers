<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deconnexion extends CI_Controller {

	public function __construct(){
		parent::__construct();
        
        header('Access-Control-Allow-Origin: *');

        $this->load->library('session');
		//XMLHttpRequest
    }
    
    public function index()
	{
		session_destroy();
        redirect("connexion");
	}
}
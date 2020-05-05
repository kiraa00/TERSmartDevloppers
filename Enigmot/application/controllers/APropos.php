<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APropos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// load form and url helpers
		$this->load->library('session');
        // load form_validation library
		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}

	public function index()
	{
		$headerData = array(
			"cssFile" => "assets/css/a-propos.css",
			"flagActif" => "a-propos",
		);
		$footerData = array(
			"javaFile" => "assets/js/a-propos.js",
		);
		$this->load->view('header', $headerData);
		$this->load->view('pages/a-propos');
		$this->load->view('footer',$footerData);
	}
}
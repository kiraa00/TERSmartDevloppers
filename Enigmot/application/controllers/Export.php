<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

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
			"cssFile" => "assets/css/export.css",
			"flagActif" => "export",
		);
		$footerData = array(
			"javaFile" => "assets/js/export.js",
		);
		$this->load->view('header', $headerData);
        if (isset($_SESSION['user'])) {
			$this->load->view('pages/export');
		} else {
			$this->load->view('pages/connexion');
		}
		$this->load->view('footer',$footerData);
	}
}
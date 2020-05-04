<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conditions extends CI_Controller {

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
			"cssFile" => "assets/css/conditions.css",
			"flagActif" => "conditions",
		);
		$footerData = array(
			"javaFile" => "assets/js/conditions.js",
		);
		$this->load->view('header', $headerData);
        if (isset($_SESSION['user'])) {
			$this->load->view('pages/conditions');
		} else {
			$this->load->view('pages/connexion');
		}
		$this->load->view('footer',$footerData);
	}
}
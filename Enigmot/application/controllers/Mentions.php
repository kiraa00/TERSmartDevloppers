<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentions extends CI_Controller {

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
			"cssFile" => "assets/css/mentions.css",
			"flagActif" => "mentions",
		);
		$footerData = array(
			"javaFile" => "assets/js/mentions.js",
		);
		$this->load->view('header', $headerData);
		$this->load->view('pages/mentions');
		$this->load->view('footer',$footerData);
	}
}
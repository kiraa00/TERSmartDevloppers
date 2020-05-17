<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editer_Information extends CI_Controller {

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
			"cssFile" => "assets/css/profil.css",
			"flagActif" => "profil",
		);
		$footerData = array(
			"javaFile" => "assets/js/profil.js",
		);
		$this->load->view('header', $headerData);
        if (isset($_SESSION['user'])) {
			$this->load->view('pages/editInfo');
		} else {
			$this->load->view('pages/connexion');
		}
		$this->load->view('footer',$footerData);
	}
}
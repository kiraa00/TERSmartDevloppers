<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resultat_Controller extends CI_Controller {

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
			"cssFile" => "",
			"flagActif" => "Résultats",
		);
		$footerData = array(
			"javaFile" => "",
		);
		$this->load->view('header', $headerData);
        if (isset($_SESSION['user'])) {
			$this->load->view('pages/resultat');
		} else {
			$this->load->view('pages/resultat');
		}
		$this->load->view('footer',$footerData);
	}
}
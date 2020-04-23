<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

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
		$this->load->view('header', ["flagActif" => "profil"]);
        if (isset($_SESSION['user'])) {
			$this->load->view('pages/profil');
		} else {
			$this->load->view('pages/connexion');
		}
		$this->load->view('footer');
	}
}
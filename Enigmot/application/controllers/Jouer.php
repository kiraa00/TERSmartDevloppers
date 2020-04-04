<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jouer extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');

		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}
	
	public function index()
	{
		$this->load->view('header', ["flagActif" => "jouer"]);
        $this->load->view('pages/Jouer');
        $this->load->view('footer');
	}
}
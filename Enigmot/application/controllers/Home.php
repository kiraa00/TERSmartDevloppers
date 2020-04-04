<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');

		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}

	public function index()
	{
		$this->load->view('header', ["flagActif" => "home"]);
        $this->load->view('Home');
		$this->load->view('footer');
	}
}

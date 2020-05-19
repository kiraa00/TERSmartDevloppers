<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscription extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// load form and url helpers
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Joueur');

		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}

	public function index()
	{
		$headerData = array(
			"cssFile" => "",
			"flagActif" => "authentification",
		);
		$footerData = array(
			"javaFile" => "",
		);
		$this->load->view('header', $headerData);
		if (isset($_SESSION['user'])) {
			$this->load->view('Home');
		} else {
			$this->load->view('pages/Inscription');
		}
		$this->load->view('footer',$footerData);
	}

	public function verifyPseudoAndEmail(){
		$data=array(
        	'pseudo'   =>  $this->input->post('pseudo'),
			'email' =>  strtolower($this->input->post('email'))
        );

		$reponse = $this->Joueur->verifyPseudoAndEmail($data);
		echo json_encode($reponse);
	}

	public function registerUser(){
		$data=array(
        	'pseudo' => $this->input->post('pseudo'),
			'email' => strtolower($this->input->post('email')),
			'point' => '0',
			'credit' => '0',
            'motdepasse' =>  sha1($this->input->post('password'))
        );

		$this->Joueur->registerUser($data);
	}
}

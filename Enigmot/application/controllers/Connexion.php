<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connexion extends CI_Controller {

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
			$this->load->view('pages/connexion');
		}
        $this->load->view('footer',$footerData);
	}

	public function verifyUserWhenConnecting(){
		$data=array(
			'email' =>  $this->input->post('email'),
            'motdepasse' =>  sha1($this->input->post('password'))
		);
		
		$reponse = $this->Joueur->verifyUserWhenConnecting($data);

		if ($reponse['flag'] == false) {
			echo json_encode(array("reponse" => false));
		} else {
			$this->session->set_userdata('user', $reponse['reponse'][0]);
			echo json_encode(array("reponse" => $_SESSION['user']));
		}
	}
}
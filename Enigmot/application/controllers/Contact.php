<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// load form and url helpers
		$this->load->library('session');
        $this->load->model('ContactModel');
        // load form_validation library
		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}

	public function index()
	{
		$headerData = array(
			"cssFile" => "assets/css/Contact.css",
			"flagActif" => "Contact",
		);
		$footerData = array(
			"javaFile" => "assets/js/Contact.js",
		);
		$this->load->view('header', $headerData);
		$this->load->view('pages/Contact');
		$this->load->view('footer',$footerData);
	}

	public function saveMessage() {
		$data;

		if (isset($_SESSION['user'])) {
			$data=array(
				'email' =>  $_SESSION['user']['email'],
				'pseudo' =>  $_SESSION['user']['pseudo'],
				'objet' =>  $this->input->post('objet'),
				'message' =>  $this->input->post('message')
			);
		} else {
			$data=array(
				'email' =>  $this->input->post('email'),
				'pseudo' =>  $this->input->post('pseudo'),
				'objet' =>  $this->input->post('objet'),
				'message' =>  $this->input->post('message')
			);
		}

		$this->ContactModel->saveMessage($data);
		echo json_encode(array("reponse" => true, "message" => "Nous vous répondrons dès que possible."));
	}
}
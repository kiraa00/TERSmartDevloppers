<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// load form and url helpers
		$this->load->library('session');
        $this->load->model('Joueur');
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
			$this->load->view('pages/profil');
		} else {
			$this->load->view('pages/connexion');
		}
		$this->load->view('footer',$footerData);
	}

	public function editPassword() {
		$data=array(
			'ancienMotDePasse' =>  sha1($this->input->post('ancienMotDePasse')),
            'nouveauMotDePasse' =>  sha1($this->input->post('nouveauMotDePasse'))
		);
		
		if ($_SESSION['user']['motdepasse'] !== $data['ancienMotDePasse']) {
			echo json_encode(array("reponse" => false, "message" => "Ancien mot de passe incorrect."));
		} else {
			$reponse = $this->Joueur->verifyAndEditPassword($data);
			echo json_encode(array("reponse" => true, "message" => "Votre mot de passe a été modifié avec succès."));
		}
	}

	public function editInfo() {
		$data;

		if ($this->input->post('type') === "GD") {
			$data = array(
				'genre' =>  $this->input->post('genre'),
				'dateNaissance' =>  $this->input->post('dateNaissance'),
				'id_joueur' => $_SESSION['user']['id_joueur']
			);

			$this->Joueur->editInfo($data, "GD");
		} else if ($this->input->post('type') === "G") {
			$data = array(
				'genre' =>  $this->input->post('genre'),
				'id_joueur' => $_SESSION['user']['id_joueur']
			);

			$this->Joueur->editInfo($data, "G");
		} else {
			$data = array(
				'dateNaissance' =>  $this->input->post('dateNaissance'),
				'id_joueur' => $_SESSION['user']['id_joueur']
			);

			$this->Joueur->editInfo($data, "D");
		}
	}
}
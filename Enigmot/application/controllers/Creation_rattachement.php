<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creation_rattachement extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// load form and url helpers
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Glose');
        $this->load->model('Mot');
        $this->load->model('Liaison');
        $this->load->model('Phrase');
        // load form_validation library
		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}

	public function index()
	{
		$this->load->view('header', ["flagActif" => "creer"]);
        if (isset($_SESSION['user'])) {
			$this->load->view('pages/creation_rattachement');
		} else {
			$this->load->view('pages/connexion');
		}
		$this->load->view('footer');
	}

	public function saveData() {
		
		//recuperation des données et preparation du calcul de cout
		$dataSet = json_decode($this->input->post("data"), true);
		$cost = 0;

		//Calcul du cout total de création de la phrase
        for ($i = 0; $i < count($dataSet['motsAmbigus']); $i++) {
			$cost = $cost + 50;
			$motAmbiguCourant = $dataSet['motsAmbigus'][$i];
			
			for ($j = 0; $j < count($motAmbiguCourant['gloses']); $j++) {
				$cost = $cost + 25;
			}
		}

		// Si le cout est inferieure à son credit, on insert dans la base sinon, on rejete
		if ($_SESSION['user']['credit'] >= $cost) {
			$reponse = $this->Phrase->saveData($dataSet, $cost, "rat");
			echo json_encode(array("reponse" => $reponse, "cost" => $cost));
		} else {
			echo json_encode(array("reponse" => false, "cost" => $cost));
		}		
	}
}
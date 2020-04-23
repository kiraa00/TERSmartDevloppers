<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create_Phrase extends CI_Controller {

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
		$headerData = array(
			"cssFile" => 'assets/css/createSentence.css',
			"flagActif" => "creer",
		);
		$footerData = array(
			"javaFile" => "assets/js/Create.js",
		);
		$this->load->view('header', $headerData);
        if (isset($_SESSION['user'])) {
			$this->load->view('pages/Create_Phrase');
		} else {
			$this->load->view('pages/connexion');
		}
		$this->load->view('footer',$footerData);
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
				$cost = $cost + 50;
			}
		
		}

		// Si le cout est inferieure à son credit, on insert dans la base sinon, on rejete
		if ($_SESSION['user']['credit'] >= $cost) {
			$reponse = $this->Phrase->saveData($dataSet, $cost, "amb");
			echo json_encode(array("reponse" => $reponse, "cost" => $cost));
		} else {
			echo json_encode(array("reponse" => false, "cost" => $cost));
		}		
	}

	/*public function ajouterGlose(){
		$data=array(
        	'glose'   =>  $this->input->post('glose'),
            'motAmbigu' =>  $this->input->post('motAmbigu'),
        );

		$id_Glose = $this->Glose->insert($data['glose']);
		$id_mot = $this->Mot->insert($data['motAmbigu']);

		$dataC = array(
        	'id_glose'   =>  $id_Glose,
            'id_ambigu' =>  $id_mot,
            'Nbr_choisi'  => 0,
        );

        $this->Liaison->insert($dataC);

        echo json_encode($data['glose']);
	}*/

	public function getGloses(){
		$data=array(
        	'mot'   =>  $this->input->post('data'),
        );

		$gloses = $this->Glose->getGlose($data);
		echo json_encode($gloses);
	}

	/*public function insertPhrase(){
		$phrase = $this->input->post('phraseD');
		$this->Phrase->insert($phrase);
		echo json_encode($this->input->post('gloseD'));
	}

		redirect('Create_Phrase');
	}*/
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// load form and url helpers
		$this->load->library('session');
        $this->load->model('Phrase');
        $this->load->model('Mot');
        $this->load->model('Liaison');
        $this->load->model('Glose');

        // load form_validation library
		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}

	public function index()
	{
		$headerData = array(
			"cssFile" => "assets/css/export.css",
			"flagActif" => "export",
		);
		$footerData = array(
			"javaFile" => "assets/js/export.js",
		);
		$this->load->view('header', $headerData);
		$this->load->view('pages/export');
		$this->load->view('footer',$footerData);
	}

	public function exportPhraseAmbigus() {
		$type = $_GET['type'];
		
		$arrayPhrasesDB = $this->Phrase->getPhrases($type);
		$arrayMotsDB = $this->Mot->getMots($type);
		$arrayLiaisonsDB = $this->Liaison->getLiaisons();
		$arrayGlosesDB = $this->Glose->getGloses();

		if ($arrayPhrasesDB == false || $arrayMotsDB == false || $arrayLiaisonsDB == false || $arrayGlosesDB == false) {
			return;
		}

		$json = '{'
					.'"infos":"Données collectées depuis le jeu Enigmot. Site web réalisé en 2020 dans le cadre d\'un TER de première année de master informatique à l\'université de Montpellier. Groupe : Chahinez BENALLAL, Mohamed HASSAN IBRAHIM, El-Bachir REHHALI, Nasser OMAR SOUBAGLE. Tuteur : Mathieu Lafourcade.\n",'
					.'"date":"01/05/2020 03:30",'
					.'"donnees":[';

		for ($i = 0; $i < count($arrayPhrasesDB); $i++) {
			if ($i != 0 && $i != count($arrayPhrasesDB)) {
				$json = $json . ",";
			}

			if ($type == "ambigu") {
				$json = $json . '{"phrase": "' .$arrayPhrasesDB[$i]['Phrase']. '","motsAmbigus": [';
			} else {
				$json = $json . '{"phrase": "' .$arrayPhrasesDB[$i]['Phrase']. '","rattachementsAmbigus": [';
			}

			$filterBy = $arrayPhrasesDB[$i]['id_phrase'];
			$arrayMotsFilter = array_filter($arrayMotsDB, function ($var) use ($filterBy) {
				return ($var['idPhrase'] == $filterBy);
			});
			
			foreach ($arrayMotsFilter as $k => $v) {
				if ($type == "ambigu") {
					$json = $json . '{"motAmbigu": "' .$v['motAmbigu']. '","identifiant": "m' .$v['position']. '","nbRep": ' .$v['nbr_reponse']. ',"gloses": [';
				} else {
					$json = $json . '{"rattachement": "' .$v['motAmbigu']. '","identifiant": "m' .$v['position']. '","nbRep": ' .$v['nbr_reponse']. ',"rattachéA": [';
				}
				
				$filterBy = $v['id_ambigu'];
				$arrayLiaisonFilter = array_filter($arrayLiaisonsDB, function ($var) use ($filterBy) {
					return ($var['idMotAmbigu'] == $filterBy);
				});

				foreach ($arrayLiaisonFilter as $l => $value) {
					$filterBy = $value['idGlose'];
					$glose = array_filter($arrayGlosesDB, function ($var) use ($filterBy) {
						return ($var['id_glose'] == $filterBy);
					});
					
					foreach ($glose as $a => $g) {
						$json = $json . '{"valeur": "' .$g['glose']. '","nbRep": ' .$value['nbrVote']. '},';
					}
				}

				$json = substr($json, 0, strlen($json) - 1);
				$json = $json . ']},';
			}
			
			$json = substr($json, 0, strlen($json) - 1);
			$json = $json . "]}";
		}

		$json = $json . "]}";

		header('content-type:application/json');
		echo $json;
	}
}
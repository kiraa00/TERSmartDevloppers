<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassementPhrase extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->model('Phrase');

		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}

	public function index($type = 'ALL')
	{
		if(isset($_SESSION['user'])){
			$javaFile="assets/js/classementPhraseJS.js";
			if($type!='ALL'){
				$javaFile="assets/js/classementMesPhraseJS.js";
			}
			$headerData = array(
				"cssFile" => "assets/css/ClassementJ.css",
				"flagActif" => "classement",
			);
			$footerData = array(
				"javaFile" => $javaFile,
			);
			$this->load->view('header', $headerData);
	        $this->load->view('pages/classement-phrase');
			$this->load->view('footer',$footerData);
		}else{
			redirect('Connexion');
		}
	}

public function ajax_list($type){
		$Filter = array(
			'type'	=> $type,
			'idUser'	=> $_SESSION['user']['id_joueur'],
		);
		$list = $this->Phrase->get_datatables($Filter);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $phrase) {
			$no++;
			$row = array();
			$row[] = $phrase->id_phrase;
			$row[] = $phrase->Phrase;
			$row[] = strtoupper(substr($phrase->type, 0, 1)) . substr($phrase->type, 1);
			$row[] = $phrase->gainTotale;
			$row[] = explode("-", explode(" ", $phrase->dateCreation)[0])[2] ."/". explode("-", explode(" ", $phrase->dateCreation)[0])[1] ."/". explode("-", explode(" ", $phrase->dateCreation)[0])[0];
				//add html for action
			$data[] = $row;
		}
		$output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Phrase->get_all_data(),
            "recordsFiltered" => $this->Phrase->get_filtered_data(),
            "data" => $data,
        );
		//output to json format
		echo json_encode($output);
	}	
}

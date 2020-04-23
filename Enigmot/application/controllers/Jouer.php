<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jouer extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('Phrase');
		$this->load->model('Mot');
		$this->load->model('Glose');
		$this->load->model('Liaison');
		$this->load->model('Joueur');
		$this->load->model('JouerModel');
		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}
	
	public function index()
	{
		$data = $this->getPhrase();
		if($data!=null){
			$footerData = array(
			"javaFile" => "assets/js/game.js",
		);
		//rules validation
		$this->form_validation->set_rules('idGlose[]', 'idGlose[]', 'required', array('required' => 'vous avez pas choisit la glose'));
		
		$this->load->view('header', ["flagActif" => "jouer"]);
        
        if ($this->form_validation->run() == FALSE)
            {
				$this->load->view('pages/Jouer',$data);
           }
        	
        

        $this->load->view('footer',$footerData);
		}else{
			redirect('Create_Phrase');
		}
}
	
	public function getPhrase(){
		$phrase = $this->Phrase->getRandomPhrase();
		if(isset($phrase)){
			$phraseId = $phrase->id_phrase;
			$mots = $this->Mot->getMotByPhrase($phraseId);
			$dataAmbigu = array();
			$i=0;
			foreach ($mots as $mot) {
				$gloses = $this->Glose->getGlosesByMotID($mot->id_ambigu);
				$dataAmbigu[$i] = array(
					'mot' => $mot,
					'gloses' => $gloses,
					'nbrGlose' => count($gloses),
				);
				$i++;
			}
			$data = array(
				'phrase'=> $phrase,
				'dataAmbigu' => $dataAmbigu,
			);
			return $data;
		}else{
			return null;
		}
	}

	public function ajouterGlose(){
		$id_mot = $this->input->post('id_Ambigu');
		$glose = $this->input->post('glose');
		$id_Glose = $this->Glose->insert($glose);
		$dataL = array(
            'idMotAmbigu' =>  $id_mot,
        	'idGlose'   =>  $id_Glose,
            'nbrVote'  => 0,
        );
        $this->Liaison->insert($dataL);
        echo $id_Glose;
	}



	public function saveData(){
		$user = null;
		if(isset($this->session->user)){
			$user = $this->session->user;
		}
		$data = array(
            'Phrase'      => $this->input->post('idPhrase'),
            'Mot'        => $this->input->post('idMot'),
            'Gloses'      => $this->input->post('idGlose'),
            'Joueur'		=> $user['id_joueur'],
		);
		$gainTotale = 0;
		for($i=0;$i<count($data['Mot']);$i++){
			$nbr_reponse = $this->Mot->jouer($data['Mot'][$i]);
			$nbr_Vote = $this->Liaison->jouer($data['Mot'][$i],$data['Gloses'][$i]);
			if($nbr_reponse==0){
				$nbr_reponse=1;
			}
			$gainTotale +=($nbr_Vote/$nbr_reponse)*100; 
		}
		$this->JouerModel->jouer($data['Phrase'],$data['Joueur'],$gainTotale);
		$this->Joueur->jouer($data['Joueur'],$gainTotale);

	}

}
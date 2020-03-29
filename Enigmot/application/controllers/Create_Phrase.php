<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create_Phrase extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// load form and url helpers
        $this->load->helper(array('form', 'url'));
        $this->load->model('Glose');
        $this->load->model('Mot');
        $this->load->model('Contenir');
        // load form_validation library
		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}

	public function index()
	{
		$this->load->view('header');
        $this->load->view('pages/Create_Phrase');
        $this->load->view('footer');
	}

	public function ajouterGlose(){
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

        $this->Contenir->insert($dataC);

        echo json_encode($data['glose']);
	}
}
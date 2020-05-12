<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassementJ extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->model('Joueur');

		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}

	public function index()
	{
		$headerData = array(
			"cssFile" => "assets/css/ClassementJ.css",
			"flagActif" => "classement",
		);
		$footerData = array(
			"javaFile" => "assets/js/ClassementJoueur.js",
		);
		$this->load->view('header', $headerData);
        $this->load->view('pages/ClassementView');
		$this->load->view('footer',$footerData);
	}

public function ajax_list(){
		$list = $this->Joueur->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $joueur) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $joueur->pseudo;
			$row[] = $joueur->credit;
			$row[] = $joueur->point;
			$row[] = "à définir";
			$row[] = "à définir";
				//add html for actio
			$data[] = $row;
		}
		$output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Joueur->get_all_data(),
            "recordsFiltered" => $this->Joueur->get_filtered_data(),
            "data" => $data,
        );
		//output to json format
		echo json_encode($output);
	}	
}

<?php

class Installer extends CI_Controller {
    public function index() 
    {
        $this->load->dbforge();

        $this->load->model('Joueur');
        $this->Joueur->createData();

        $this->load->model('Phrase');
        $this->Phrase->createData();

        $this->load->model('Jouer');
        $this->Jouer->createData();    

        $this->load->model('Mot');
        $this->Mot->createData(); 

        $this->load->model('Glose');
        $this->Glose->createData(); 

        $this->load->model('Contenir');
        $this->Contenir->createData(); 
        redirect('Home');
    }

}
    ?>
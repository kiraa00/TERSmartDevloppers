<?php

class Installer extends CI_Controller {
    public function index() 
    {
        $this->load->dbforge();

        $this->load->model('Joueur');
        $this->Joueur->createData();

        $this->load->model('Phrase');
        $this->Phrase->createData();

<<<<<<< HEAD
        $this->load->model('Jouer');
        $this->Jouer->createData();    
=======
        $this->load->model('JouerModel');
        $this->JouerModel->createData();    
>>>>>>> develop

        $this->load->model('Mot');
        $this->Mot->createData(); 

        $this->load->model('Glose');
        $this->Glose->createData(); 

<<<<<<< HEAD
        $this->load->model('Contenir');
        $this->Contenir->createData(); 
=======
        $this->load->model('Liaison');
        $this->Liaison->createData(); 

        $this->load->model('ContactModel');
        $this->ContactModel->createData(); 
        redirect('Home');
>>>>>>> develop
    }

}
    ?>
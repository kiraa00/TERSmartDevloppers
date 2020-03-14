<?php

class Installer extends CI_Controller {
    public function index() 
    {
        $this->load->dbforge();

        //creation de la base de données

        if ($this->dbforge->create_database('enigmot')){
            $this->load->database();
        }else{
            echo 'error pour créer la base de donnée vérifier s\'il n\'existe pas déjà';
        }


    


    }

}
    ?>
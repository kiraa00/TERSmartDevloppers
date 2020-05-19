<?php  
 class JouerModel extends CI_Model  
 {  
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function createData()  
      {  $attributes = array('ENGINE' => 'InnoDB');
        $this->load->dbforge();
    
      	$fields = array(
                'id_partie' => array(
                             'type' => 'int',
                             'constraint' => '15',
                             'auto_increment'=>true,
                              ),

                'id_phrase' => array(
                             'type' => 'int',
                             'constraint' => '15',
                              ),

                'id_joueur' => array(
                             'type' => 'int',
                             'constraint' => '15',
                              ),

                'Gain'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ), 
                             
                'dateCreation datetime Not NULL default current_timestamp'
            );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_partie',true);
        $this->dbforge->add_key('id_phrase',true);
        $this->dbforge->add_key('id_joueur',true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_joueur) REFERENCES Joueur(id_joueur)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_phrase) REFERENCES Phrase(id_phrase)');
        $this->dbforge->create_table('Jouer',FALSE, $attributes);


      }

      public function jouer($phrase,$joueur,$gain){
        $data = array(
          'id_phrase' => $phrase,
          'id_joueur' => $joueur,
          'Gain' => $gain,
        );
        $where = array(
          'id_phrase' => $phrase,
          'id_joueur' => $joueur,
        );
        $this->db->select('*');
        $this->db->where($where);
        $query=$this->db->get('Jouer');
        if($query->num_rows()==0){
          $this->db->insert('Jouer',$data);
          $this->db->set('gainTotale',"gainTotale+$gain",FALSE);
          $this->db->where('id_phrase',$phrase);
          $this->db->update('Phrase');
          $this->db->set('nbrPartieJouee',"nbrPartieJouee+1",FALSE);
          $this->db->where('id_joueur',$joueur);
          $this->db->update('Joueur');
        }
      }

      public function aJouer($joueur,$phrase){
        $where = array(
          'id_phrase' => $phrase,
          'id_joueur' => $joueur,
        );
        $this->db->select('*');
        $this->db->where($where);
        $query = $this->db->get('Jouer');
       if($query->num_rows()!=0){
          return true;
        }
      } 
}
  ?>
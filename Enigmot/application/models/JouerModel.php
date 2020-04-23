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
            );

        $this->dbforge->add_field($fields);
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
        $this->db->insert('Jouer',$data);
      } 
}
  ?>
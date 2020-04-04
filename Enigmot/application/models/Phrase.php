<?php  
 class Phrase extends CI_Model  
 {  
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function createData()  
      {  
        $attributes = array('ENGINE' => 'InnoDB');
        $this->load->dbforge();
    
      	$fields = array(
                'id_phrase' => array(
                             'type' => 'int',
                             'constraint' => '15',
                             'auto_increment'=>true
                              ),

                'Phrase' => array(
                                'type' => 'varchar',
                                'constraint' => '250',
                                 ),

                'Nbr_like'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'id_Createur'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             'default' => null,
                             ),

                'Type' => array(
                          'type' => 'ENUM("ambiguité","rattachement")',
                          'default' => 'ambiguité',
                          'null' => FALSE,
                          ),
                'Facile'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'Moyenne'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'Difficile'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),                                             
            );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_phrase',true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_Createur) REFERENCES Joueur(id_joueur)');
        $this->dbforge->create_table('Phrase',FALSE, $attributes);


      }
     
     public function insert($phrase){
        $data = array(
                'Phrase' => $phrase,

                'Nbr_like'  => 0,

                'id_Createur'  => null,

                'Type' => "ambiguité",
                
                'Facile'  => 0,

                'Moyenne'  => 1,

                'Difficile'  => 0,
              );

        $this->db->insert('Phrase', $data);

     }
}
  ?>
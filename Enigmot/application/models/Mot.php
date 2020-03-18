<?php  
 class Mot extends CI_Model  
 {  
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function createData()  
      {  
        $this->load->dbforge();
    
      	$fields = array(
                'id_ambigu' => array(
                             'type' => 'int',
                             'constraint' => '15',
                              ),

                'Mot' => array(
                                'type' => 'varchar',
                                'constraint' => '32',
                                 ),

                'id_phrase' => array(
                             'type' => 'int',
                             'constraint' => '15',
                              ),                                                                            
            );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_ambigu',true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_phrase) REFERENCES Phrase(id_phrase)');
        $this->dbforge->create_table('Mot');


      }
     
}
  ?>
<?php  
 class Glose extends CI_Model  
 {  
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function createData()  
      {  
        $this->load->dbforge();
    
      	$fields = array(
                'id_glose' => array(
                             'type' => 'int',
                             'constraint' => '15',
                              ),

                'Glose' => array(
                                'type' => 'varchar',
                                'constraint' => '32',
                                 ),
                                                                            
            );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_glose',true);
        $this->dbforge->create_table('Glose');


      }
     
}
  ?>
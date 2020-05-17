<?php  
 class ContactModel extends CI_Model  
 {  
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function createData()  
      {  $attributes = array('ENGINE' => 'InnoDB');
        $this->load->dbforge();
    
      	$fields = array(
                'idMessage' => array(
                             'type' => 'int',
                             'constraint' => '15',
                             'auto_increment'=>true,
                              ),

                'email' => array(
                                'type' => 'varchar',
                                'constraint' => '255',
                                 ),

                'pseudo'  => array(
                             'type' => 'varchar',
                             'constraint' => '255',
                             ),

                'objet'  => array(
                             'type' => 'varchar',
                             'constraint' => '255',
                             ),
                             
                'message' => array(
                            'type' => 'varchar',
                            'constraint' => '255',
                             ),

                'dateEnvoi datetime Not NULL default current_timestamp'
            );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('idMessage',true);
        $this->dbforge->create_table('Contact',FALSE, $attributes);
      }

      public function saveMessage($data) {
        $this->db->insert('Contact', $data);
      }
}
  ?>
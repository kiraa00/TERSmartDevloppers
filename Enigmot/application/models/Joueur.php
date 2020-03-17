<?php  
 class Joueur extends CI_Model  
 {  
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function createData()  
      {  
        $this->load->dbforge();
    
      	$fields = array(
                'id_joueur' => array(
                             'type' => 'int',
                             'constraint' => '15',
                             'auto_increment'=>true
                              ),

                'Nom' => array(
                                'type' => 'varchar',
                                'constraint' => '32',
                                 ),

                'Adresse' => array(
                                'type' => 'varchar',
                                'constraint' => '32',
                                 ),

                'Niveau'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'Xp'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'Credit'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'username' => array(
                                   'type' => 'varchar',
                                    'constraint' => '25',
                                     ),

                'password' => array(
                                   'type' => 'varchar',
                                    'constraint' => '32',
                                     ),


            );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_joueur',true);
        $this->dbforge->create_table('Joueur');


      }
     
}
  ?>
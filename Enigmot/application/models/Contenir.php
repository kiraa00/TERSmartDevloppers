<?php  
 class Contenir extends CI_Model  
 {  
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public $id_glose;
      public $id_ambigu;
      public $Nbr_choisi;


      public function createData()  
      {  
        $this->load->dbforge();
    
      	$fields = array(
                'id_glose' => array(
                             'type' => 'int',
                             'constraint' => '15',
                              ),

                'id_ambigu' => array(
                             'type' => 'int',
                             'constraint' => '15',
                              ),

                'Nbr_choisi'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ), 
            );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_glose',true);
        $this->dbforge->add_key('id_ambigu',true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_ambigu) REFERENCES Mot(id_ambigu)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_glose) REFERENCES Glose(id_glose)');
        $this->dbforge->create_table('Contenir');


      }


      public function insert($data){
        $this->db->insert('Contenir', $data);
      }
     
}
  ?>
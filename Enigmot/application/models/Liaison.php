<?php  
 class Liaison extends CI_Model  
 {  
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public $id_glose;
      public $id_ambigu;
      public $Nbr_choisi;


      public function createData()  
      {  $attributes = array('ENGINE' => 'InnoDB');
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

                'id_phrase' => array(
                             'type' => 'int',
                             'constraint' => '15',
                              ),
                
                'Nbr_vote'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

            );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_glose',true);
        $this->dbforge->add_key('id_ambigu',true);
        $this->dbforge->add_key('id_phrase',true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_phrase) REFERENCES Phrase(id_phrase)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_ambigu) REFERENCES Mot(id_ambigu)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_glose) REFERENCES Glose(id_glose)');
        $this->dbforge->create_table('Liaison',FALSE, $attributes);


      }


      public function insert($data){
        $where = array(
          'id_glose' => $data['id_glose'],
          'id_ambigu' => $data['id_ambigu'],
        );
        $this->db->select('*');
        $this->db->where($where);
        $query = $this->db->get('Contenir');
        if($query->num_rows()==0){
          $this->db->insert('Contenir', $data);
        }
        
      }
     
}
  ?>
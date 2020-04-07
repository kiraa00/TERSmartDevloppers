<?php  
 class Mot extends CI_Model  
 {  
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function createData()  
      {  $attributes = array('ENGINE' => 'InnoDB');
        $this->load->dbforge();
    
      	$fields = array(
                'id_ambigu' => array(
                             'type' => 'int',
                             'constraint' => '15',
                             'auto_increment'=>true,
                              ),

                'motAmbigu' => array(
                                'type' => 'varchar',
                                'constraint' => '32',
                                 ),

                'position'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'nbr_reponse'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),
                             
                'idPhrase' => array(
                            'type' => 'int',
                            'constraint' => '15',
                             ),
            );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_ambigu',true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (idPhrase) REFERENCES Phrase(id_phrase)');
        $this->dbforge->create_table('Mot',FALSE, $attributes);
      }


      public function insert($mot){
        $where = array(
          'motAmbigu' => $mot,
        );
        $this->db->select('*');
        $this->db->where($where);
        $query = $this->db->get('Mot');
        if($query->num_rows()==0){
          $this->db->insert('Mot', $where);
          $id = $this->db->insert_id();
        }else{
          $id = $query->row()->id_ambigu;
        }
        return $id;
      }      
     
}
  ?>
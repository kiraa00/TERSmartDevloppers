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

                'type' => array(
                'type' => 'ENUM("ambigu","rattachement")',
                'default' => 'ambigu',
                'null' => FALSE,
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

      public function getMotByPhrase($id){
        $this->db->select('*');
        $this->db->where('idPhrase',$id);
        $this->db->order_by('position', 'ASC');
        $query = $this->db->get('Mot');
        return $query->result();
      } 

      public function jouer($mot){
        $where = array(
          'id_ambigu' => $mot,
        );
        $this->db->select('*');
        $this->db->where($where);
        $query = $this->db->get('Mot');
        $nbr_reponse = $query->row()->nbr_reponse;
        $update = array(
          'nbr_reponse' => $nbr_reponse+1,
        );
        $this->db->update('Mot', $update, $where);
        return $nbr_reponse;
      }   
     
      public function getMotById($id){
        $this->db->select('*');
        $this->db->where('id_ambigu',$id);
        $query = $this->db->get('Mot');
        return $query->row();
      }
}
  ?>
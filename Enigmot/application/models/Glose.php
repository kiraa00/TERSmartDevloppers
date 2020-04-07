<?php  
 class Glose extends CI_Model  
 {  
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }
      
      public function createData()  
      {  $attributes = array('ENGINE' => 'InnoDB');
        $this->load->dbforge();
    
      	$fields = array(
                'id_glose' => array(
                             'type' => 'int',
                             'constraint' => '15',
                             'auto_increment'=>true,
                              ),

                'glose' => array(
                                'type' => 'varchar',
                                'constraint' => '32',
                                 ),
                                                                            
            );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_glose',true);
        $this->dbforge->create_table('Glose',FALSE, $attributes);


      }

      public function insert($glose){
        $where = array(
          'glose' => $glose,
        );
        $this->db->select('*');
        $this->db->where($where);
        $id = $this->db->get('Glose');

        if($id->num_rows()==0){
          $this->db->insert('Glose', $where);
          $id = $this->db->insert_id();
        }else{
          $id = $id->row()->id_glose;
        }
        return $id;
      }

      public function getGlose($mot){
          $this->db->select('Glose');
          $this->db->from('Glose AS G');
          $this->db->join('Liaison AS C', 'C.id_glose = G.id_glose');
          $this->db->join('Mot AS M', 'M.id_ambigu = C.id_ambigu');
          $this->db->where('Mot',$mot);
          $query = $this->db->get();
          if($query->num_rows()==0){
            return null;
          }else{
            return $query->result();  
          }
          
      }
     
}
  ?>
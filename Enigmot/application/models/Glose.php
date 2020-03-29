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
                             'auto_increment'=>true,
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

      public function insert($glose){
        $where = array(
          'Glose' => $glose,
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
     
}
  ?>
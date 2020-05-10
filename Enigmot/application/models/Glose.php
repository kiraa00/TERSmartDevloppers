<?php  
 class Glose extends CI_Model  
 {  
      public function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->model('Liaison');
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

      public function getGlose($data){
        $requestString = "SELECT DISTINCT g.glose FROM Glose g, Mot m, Liaison l WHERE m.id_ambigu = l.idMotAmbigu AND g.id_glose = l.idGlose AND m.motAmbigu = ? AND m.type = 'ambigu';";

        $request = $this->db->query($requestString, $data);
  
          if (count($request->result_array()) != 0) {
            return array("flag" => true, "reponse" => $request->result_array());
          } else {
            return array("flag" => false, "reponse" => "");
          }
      }

      public function getGlosesByMotID($id){
        $this->db->select('*');
        $this->db->from('Glose');
        $this->db->join('Liaison', 'Liaison.idGlose = Glose.id_glose');
        $this->db->where('idMotAmbigu',$id);
        $query = $this->db->get();
        return $query->result();
      }

      public function getGloses() {
        $requete = $this->db->query("SELECT * FROM Glose;");
        $isEmpty = count($requete->result_array()) == 0;
        
        if ($isEmpty) {
          return false;
        } else {
          return $requete->result_array();
        }
      }
}
  ?>
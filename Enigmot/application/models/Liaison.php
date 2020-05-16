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
                'idLigne' => array(
                              'type' => 'int',
                              'constraint' => '15',
                              'auto_increment'=>true,
                              ),

                'idLiaison' => array(
                              'type' => 'varchar',
                              'constraint' => '32',
                              'default' =>"",
                              ),

                'idMotAmbigu' => array(
                              'type' => 'int',
                              'constraint' => '15',
                              ),

                'idGlose' => array(
                             'type' => 'int',
                             'constraint' => '15',
                              ),
                
                'nbrVote'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

            );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('idLigne',true);
        $this->dbforge->add_key('idLisaison',true);
        $this->dbforge->add_key('idMotAmbigu',true);
        $this->dbforge->add_key('idGlose',true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (idMotAmbigu) REFERENCES Mot(id_ambigu)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (idGlose) REFERENCES Glose(id_glose)');
        $this->dbforge->create_table('Liaison',FALSE, $attributes);


      }


      public function insert($data){
        $where = array(
          'idGlose' => $data['idGlose'],
          'idMotAmbigu' => $data['idMotAmbigu'],
        );
        $this->db->select('*');
        $this->db->where($where);
        $query = $this->db->get('Liaison');
        if($query->num_rows()==0){
          $this->db->insert('Liaison', $data);
        }
        
      }
     public function jouer($Mot,$Glose){
      $where = array(
        'idMotAmbigu' => $Mot,
        'idGlose' => $Glose,

      );
      $this->db->select('*');
      $this->db->where($where);
      $query=$this->db->get('Liaison');
      $nbrVote=$query->row()->nbrVote;
      $this->db->set('nbrVote',"nbrVote+1",FALSE);
      $this->db->where($where);
      $this->db->update('Liaison');
      return $nbrVote;
     }

     public function getLiaisons() {
      $requete = $this->db->query("SELECT * FROM Liaison;");
      $isEmpty = count($requete->result_array()) == 0;
      
      if ($isEmpty) {
        return false;
      } else {
        return $requete->result_array();
      }
    }

    public function getVote($mot,$glose){
      $where = array(
        'idMotAmbigu' => $mot,
        'idGlose' => $glose,
      );      
      $this->db->select('*');
      $this->db->where($where);
      $query=$this->db->get('Liaison');
      return $query->row()->nbrVote;
     }
}
  ?>
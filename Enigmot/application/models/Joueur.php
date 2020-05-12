<?php  
 class Joueur extends CI_Model  
 {  
      var $table = 'Joueur';
      var $column = array('id_joueur','pseudo','xp','credit');
      var $order = array('credit' => 'desc');

      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function createData()  
      {  $attributes = array('ENGINE' => 'InnoDB');
        $this->load->dbforge();
    
      	$fields = array(
                'id_joueur' => array(
                             'type' => 'int',
                             'constraint' => '15',
                             'auto_increment'=>true,
                              ),

                'pseudo' => array(
                                'type' => 'varchar',
                                'constraint' => '32',
                                 ),

                'email' => array(
                                'type' => 'varchar',
                                'constraint' => '32',
                                 ),

                'niveau'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'xp'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'credit'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'motdepasse' => array(
                                   'type' => 'varchar',
                                    'constraint' => '32',
                                     ),
            );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_joueur',true);
        $this->dbforge->create_table('Joueur',FALSE, $attributes);
      }

      public function verifyPseudoAndEmail($data) {
        $requetePseudo = $this->db->query("SELECT * FROM Joueur WHERE pseudo = ?", $data['pseudo']);
        $requeteEmail = $this->db->query("SELECT * FROM Joueur WHERE email = ?", $data['email']);

        $pseudo = count($requetePseudo->result_array()) == 0;
        $email = count($requeteEmail->result_array()) == 0;

        return array("pseudo" => $pseudo, "email" => $email);
      }

      public function registerUser($user) {
          $this->db->insert('Joueur', $user);
      }

      public function verifyUserWhenConnecting($data) {
        $request = $requetePseudo = $this->db->query("SELECT * FROM Joueur WHERE email = ? AND motdepasse = ?", $data);

        if (count($request->result_array()) == 0) {
          return array("flag" => false, "reponse" => "");
        } else {
          return array("flag" => true, "reponse" => $request->result_array());
        }
      }

      public function jouer($joueur,$gain){
        $this->db->set('credit',"credit+$gain",FALSE);
        $this->db->where('id_joueur',$joueur);
        $this->db->update('Joueur');
      }

      public function getJoueurById($id){
        $this->db->select('*');
        $this->db->where('id_joueur',$id);
        $query = $this->db->get('Joueur');
        return $query->row();
      }



      ///fonctions pour le classement des joueurs
      private function _get_datatables_query(){
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column as $item){
          if($_POST['search']['value'])
            ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
          $column[$i] = $item;
          $i++;
        }    
        if(isset($_POST['order'])){
          $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order)){
          $order = $this->order;
          $this->db->order_by(key($order), $order[key($order)]);
        }
      }

      public function get_datatables(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
          $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
      }

      public function get_filtered_data(){
        $this->_get_datatables_query();
        $query = $this->db->get();  
        return $query->num_rows();  
      }

      public function get_all_data(){ 
        $this->db->select("*");  
        $this->db->from($this->table);  
        return $this->db->count_all_results();  
      }

}
?>
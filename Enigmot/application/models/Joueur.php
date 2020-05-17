<?php  
 class Joueur extends CI_Model  
 {  
<<<<<<< HEAD
=======
      var $table = 'Joueur';
      var $column = array('id_joueur', 'pseudo', 'titre', 'dateInscription', 'point', 'nbrPhraseCree', 'nbrMotAmbigu', 'nbrPartieJouee');
      var $order = array('point' => 'desc');

>>>>>>> develop
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function createData()  
<<<<<<< HEAD
      {  
=======
      {  $attributes = array('ENGINE' => 'InnoDB');
>>>>>>> develop
        $this->load->dbforge();
    
      	$fields = array(
                'id_joueur' => array(
                             'type' => 'int',
                             'constraint' => '15',
<<<<<<< HEAD
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
=======
                             'auto_increment'=>true,
                              ),

                'pseudo' => array(
                                'type' => 'varchar',
                                'constraint' => '255',
                                 ),

                'email' => array(
                                'type' => 'varchar',
                                'constraint' => '255',
                                 ),

                'point'  => array(
>>>>>>> develop
                             'type' => 'int',
                             'constraint' => '11',
                             ),

<<<<<<< HEAD
                'Credit'  => array(
=======
                'credit'  => array(
>>>>>>> develop
                             'type' => 'int',
                             'constraint' => '11',
                             ),

<<<<<<< HEAD
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
=======
                'motdepasse' => array(
                                   'type' => 'varchar',
                                    'constraint' => '255',
                                     ),

                'genre' => array(
                                'type' => 'varchar',
                                'constraint' => '32',
                                'default' =>"",
                                ),

                'titre' => array(
                                'type' => 'varchar',
                                'constraint' => '32',
                                'default' => 'Novice'
                                ),

                'dateNaissance' => array(
                                   'type' => 'varchar',
                                    'constraint' => '32',
                                    'default' =>"",
                                     ),

                'nbrPhraseCree' => array(
                                   'type' => 'int',
                                    'constraint' => '32',
                                    'default' => 0,
                                    'null' => FALSE,                                    
                                   ),

                'nbrGloseAjoutee' => array(
                                   'type' => 'int',
                                    'constraint' => '32',
                                    'default' => 0,
                                    'null' => FALSE,                                    
                                   ),

                'nbrMotAmbigu' => array(
                                   'type' => 'int',
                                    'constraint' => '32',
                                    'default' => 0,
                                    'null' => FALSE,                                    
                                   ),

                'nbrPartieJouee' => array(
                                   'type' => 'int',
                                    'constraint' => '32',
                                    'default' => 0,
                                    'null' => FALSE,
                                  ),

                'derniereConnexion' => array(
                                   'type' => 'datetime',
                                   'default' =>"0000-00-00 00:00:00",
                                     ),

                'dateInscription datetime Not NULL default current_timestamp',
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
        $request = $this->db->query("SELECT * FROM Joueur WHERE email = ? AND motdepasse = ?", $data);

        if (count($request->result_array()) == 0) {
          return array("flag" => false, "reponse" => "");
        } else {
          $requete = $this->db->query("UPDATE Joueur SET derniereConnexion = CURRENT_TIMESTAMP WHERE email = ? AND motdepasse = ?", $data);
          return array("flag" => true, "reponse" => $request->result_array());
        }
      }

      public function verifyAndEditPassword($data) {
        $dataPassword = array(
          'motdepasse' =>  $data['nouveauMotDePasse'],
          'email' =>  $_SESSION['user']['email']
        );

          $requete = $this->db->query("UPDATE Joueur SET motdepasse = ? WHERE email = ?", $dataPassword);
          $_SESSION['user']['motdepasse'] = $data['nouveauMotDePasse'];
      }

      public function editInfo($data, $type) {
        var_dump($data);
        if ($type === "GD") {
          $requete = $this->db->query("UPDATE Joueur SET genre = ?, dateNaissance = ? WHERE id_joueur = ?", $data);
          $_SESSION['user']['genre'] = $data['genre'];
          $_SESSION['user']['dateNaissance'] = $data['dateNaissance'];
        } else if ($type === "G") {
          $requete = $this->db->query("UPDATE Joueur SET genre = ? WHERE id_joueur = ?", $data);
          $_SESSION['user']['genre'] = $data['genre'];
        } else if ($type === "D") {
          $requete = $this->db->query("UPDATE Joueur SET dateNaissance = ? WHERE id_joueur = ?", $data);
          $_SESSION['user']['dateNaissance'] = $data['dateNaissance'];
        }
      }

      public function getTitre($point) {
        if ($point >= 115000)
          return "Enigmator";
        else if ($point >= 92000)
          return "Bâtonnier";
        else if ($point >= 68000)
          return "Grand Maître";
        else if ($point >= 22000)
          return "Maître";
        else if ($point >= 3000)
          return "Challenger";
        else
          return "Novice";
      }

      public function jouer($joueur,$gain,$titre){
        $this->db->set('credit',"credit+$gain",FALSE);
        $this->db->set('point',"point+$gain",FALSE);
        $this->db->set('titre',"$titre");
        $this->db->where('id_joueur',$joueur);
        $this->db->update('Joueur');
      }

      public function getJoueurById($id){
        $this->db->select('*');
        $this->db->where('id_joueur',$id);
        $query = $this->db->get('Joueur');
        return $query->row();
      }

      public function ajoutGlose($joueur,$credit){
        $this->db->set('credit',"credit-$credit",FALSE);
        $this->db->where('id_joueur',$joueur);
        $this->db->update('Joueur');
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
>>>>>>> develop

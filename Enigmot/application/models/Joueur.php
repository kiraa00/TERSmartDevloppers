<?php  
 class Joueur extends CI_Model  
 {  
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
        $this->db->update('Joueur');
      }
}
?>
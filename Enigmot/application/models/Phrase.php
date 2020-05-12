<?php  
class Phrase extends CI_Model  
{  
      public function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function createData()  
      {  
        $attributes = array('ENGINE' => 'InnoDB');
        $this->load->dbforge();
    
      	$fields = array(
                'id_phrase' => array(
                             'type' => 'int',
                             'constraint' => '15',
                             'auto_increment'=>true
                              ),

                'Phrase' => array(
                                'type' => 'varchar',
                                'constraint' => '250',
                                 ),

                'nbr_like'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'id_Createur'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             'default' => null,
                             ),

                'type' => array(
                          'type' => 'ENUM("ambigu","rattachement")',
                          'default' => 'ambigu',
                          'null' => FALSE,
                          ),
                'facile'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'moyenne'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),

                'difficile'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             ),                                             
            );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_phrase',true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_Createur) REFERENCES Joueur(id_joueur)');
        $this->dbforge->create_table('Phrase',FALSE, $attributes);


      }
     
      public function insert($phrase){
        $data = array(
                'Phrase' => $phrase,

                'nbr_like'  => 0,

                'id_Createur'  => null,

                'type' => "ambigu",
                
                'facile'  => 0,

                'moyenne'  => 1,

                'difficile'  => 0,
              );

        $this->db->insert('Phrase', $data);
      }

      public function getPhrases($type) {
        $requetePhrase;

        if ($type == "ambigu") {
          $requetePhrase = $this->db->query("SELECT id_phrase, Phrase FROM Phrase WHERE type = 'ambigu';");
        } else {
          $requetePhrase = $this->db->query("SELECT id_phrase, Phrase FROM Phrase WHERE type = 'rattachement';");
        }

        $isEmpty = count($requetePhrase->result_array()) == 0;
        
        if ($isEmpty) {
          return false;
        } else {
          return $requetePhrase->result_array();
        }
      }

      public function saveData($data, $cost, $type) {
        //  Insertion de la phrase dans la base de données et récuperation de son id
        $phrase;

        if ($type == "amb") {
          $phrase = array(
            'Phrase' => $data['phrase'],
            'nbr_like'  => 0,
            'id_Createur'  => $_SESSION['user']['id_joueur'],
            'type' => "ambigu",
            'facile'  => 0,
            'moyenne'  => 1,
            'difficile'  => 0
          );
        } else {
          $phrase = array(
            'Phrase' => $data['phrase'],
            'nbr_like'  => 0,
            'id_Createur'  => $_SESSION['user']['id_joueur'],
            'type' => "rattachement",
            'facile'  => 0,
            'moyenne'  => 1,
            'difficile'  => 0
          );
        }

        $this->db->insert('Phrase', $phrase);
        $idPhrase = $this->db->insert_id();

        //  Insertion du mot ambigu dans la base de données

        for ($i = 0; $i < count($data['motsAmbigus']); $i++) {
          $motAmbiguCourant = $data['motsAmbigus'][$i];

          if ($type == "amb") {
            $motAmbigu = array(
              'motAmbigu' => $motAmbiguCourant['motAmbigu'],
              'position'  => $motAmbiguCourant['position'],
              'nbr_reponse'  => 1,
              'idPhrase' => $idPhrase
            );
          } else {
            $motAmbigu = array(
              'motAmbigu' => $motAmbiguCourant['motAmbigu'],
              'position'  => $motAmbiguCourant['position'],
              'nbr_reponse'  => 1,
              'idPhrase' => $idPhrase,
              'type' => "rattachement"
            );
          }

          $this->db->insert('Mot', $motAmbigu);
          $idMotAmbigu = $this->db->insert_id();

          //  Insertion des gloses ambigus dans la base de données

          for ($j = 0; $j < count($motAmbiguCourant['gloses']); $j++) {
            $gloseCourante = $motAmbiguCourant['gloses'][$j];

            $glose = array(
              'glose' => $gloseCourante['valeur']
            );

            // Verification de l'existance de la glose avant l'insertion

            $gloseDB = $this->db->query("SELECT * FROM Glose WHERE glose = ?", $glose);
            $idGlose = 0;

            if (count($gloseDB->result_array()) == 0) {
              $this->db->insert('Glose', $glose);
              $idGlose = $this->db->insert_id();
            } else {
              $idGlose = $gloseDB->result_array()[0]['id_glose'];
            }

        //  Insertion de la laison entre le mot ambigu et la glose

            $liaison = [];

            if ($gloseCourante['selected'] == true) {
              $liaison = array(
                'idMotAmbigu' => $idMotAmbigu,
                'idGlose'  => $idGlose,
                'nbrVote'  => 1,
              );
            } else {
              $liaison = array(
                'idMotAmbigu' => $idMotAmbigu,
                'idGlose'  => $idGlose,
                'nbrVote'  => 0,
              );
            }

            $this->db->insert('Liaison', $liaison);
          }
        }
        
        $dataCost = array(
          'credit' =>  $_SESSION['user']['credit'] - $cost,
        );
        $this->db->where('id_joueur',$_SESSION['user']['id_joueur']);
        $this->db->update('Joueur', $dataCost);
        $_SESSION['user']['credit'] = $_SESSION['user']['credit'] - $cost;

        return true;
      }

      public function getRandomPhrase($type){
        $user = ($this->session->user)['id_joueur'];
         // $this->db->select('*');
         // $this->db->from('Phrase');
         // $this->db->join('Jouer','Jouer.id_phrase=Phrase.id_phrase','Right');
         // $this->db->where('type',$type);
         // $this->db->where('id_Createur !=',$user);
         // $this->db->where('Jouer.id_joueur !=',$user);
         // $this->db->order_by('id_phrase', 'RANDOM');
        if(isset($user)){
          $query = $this->db->query("SELECT * FROM Phrase WHERE Phrase.id_phrase NOT IN(SELECT Jouer.id_phrase From Phrase,Jouer WHERE Phrase.id_phrase=Jouer.id_phrase AND Jouer.id_joueur=$user) AND Phrase.id_Createur != $user AND Phrase.type='$type' ORDER BY RAND();");
          $nbr_rows=$query->num_rows();
        }else{
          $nbr_rows=0;
        }
        if($nbr_rows==0){
          $this->db->select('*');
          $this->db->where('type',$type);
          $this->db->where('id_Createur !=',$user);
          $this->db->order_by('id_phrase' ,'RANDOM');
          $query = $this->db->get('Phrase');
        }
         return $query->row();
      }

      public function getPhraseById($id){
        $this->db->select('*');
        $this->db->where('id_phrase',$id);
        $query = $this->db->get('Phrase');
        return $query->row();
      }
}
?>
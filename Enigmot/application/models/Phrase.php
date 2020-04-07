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
                          'type' => 'ENUM("ambiguité","rattachement")',
                          'default' => 'ambiguité',
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

                'type' => "ambiguité",
                
                'facile'  => 0,

                'moyenne'  => 1,

                'difficile'  => 0,
              );

        $this->db->insert('Phrase', $data);
      }

      public function saveData($data) {
    
          //  Insertion de la phrase dans la base de données et récuperation de son id
        
        $phrase = array(
          'Phrase' => $data['phrase'],
          'nbr_like'  => 0,
          'id_Createur'  => $_SESSION['user']['id_joueur'],
          'type' => "ambigu",
          'facile'  => 0,
          'moyenne'  => 1,
          'difficile'  => 0
        );

        $this->db->insert('Phrase', $phrase);
        $idPhrase = $this->db->insert_id();

        //  Insertion du mot ambigu dans la base de données

        for ($i = 0; $i < count($data['motsAmbigus']); $i++) {
          $motAmbiguCourant = $data['motsAmbigus'][$i];

          $motAmbigu = array(
            'motAmbigu' => $motAmbiguCourant['motAmbigu'],
            'position'  => $motAmbiguCourant['position'],
            'nbr_reponse'  => 0,
            'idPhrase' => $idPhrase
          );

          $this->db->insert('mot', $motAmbigu);
          $idMotAmbigu = $this->db->insert_id();

          //  Insertion des gloses ambigus dans la base de données

          for ($j = 0; $j < count($motAmbiguCourant['gloses']); $j++) {
            $gloseCourante = $motAmbiguCourant['gloses'][$j];

            $glose = array(
              'glose' => $gloseCourante['valeur']
            );

            // Verification de l'existance de la glose avant insertion

            $gloseDB = $this->db->query("SELECT * FROM glose WHERE glose = ?", $glose);
            $idGlose = 0;

            if (count($gloseDB->result_array()) == 0) {
              $this->db->insert('glose', $glose);
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

            $this->db->insert('liaison', $liaison);
          }
        }
        
        return true;
      }
}
?>
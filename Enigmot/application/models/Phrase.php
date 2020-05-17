<?php  
class Phrase extends CI_Model  
{  
      var $table = 'Phrase';
      var $column = array('id_phrase', 'Phrase', 'type', 'gainTotale', 'dateCreation');
      var $order = array('gainTotale' => 'desc');

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
                                'constraint' => '1024',
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

                'signale' => array(
                          'type' => 'tinyint',
                          'constraint' => '1',
                          'default' => '0',
                          'null' => FALSE,
                          ),
                          
                'gainTotale'  => array(
                             'type' => 'int',
                             'constraint' => '11',
                             'default' => 0,
                             ),         
                'dateCreation datetime Not NULL default current_timestamp',

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

      public function saveData($data, $cost, $type, $titre) {
        $nbrMotAmbigu = 0;
        $nbrGloseAjoutee = 0;

        //  Insertion de la phrase dans la base de données et récuperation de son id
        $phrase;

        if ($type == "amb") {
          $phrase = array(
            'Phrase' => $data['phrase'],
            'nbr_like'  => 0,
            'id_Createur'  => $_SESSION['user']['id_joueur'],
            'type' => "ambigu"
          );
        } else {
          $phrase = array(
            'Phrase' => $data['phrase'],
            'nbr_like'  => 0,
            'id_Createur'  => $_SESSION['user']['id_joueur'],
            'type' => "rattachement"
          );
        }

        $this->db->insert('Phrase', $phrase);
        $idPhrase = $this->db->insert_id();

        //  Insertion du mot ambigu dans la base de données

        for ($i = 0; $i < count($data['motsAmbigus']); $i++) {
          $nbrMotAmbigu++;
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
            $nbrGloseAjoutee++;
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

          if ($type == "amb") {
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
          } else {
            if ($gloseCourante['selected'] == true) {
              $liaison = array(
                'idLiaison' => $gloseCourante['identifiant'] . "_m" . ($i+1),
                'idMotAmbigu' => $idMotAmbigu,
                'idGlose'  => $idGlose,
                'nbrVote'  => 1,
              );
            } else {
              $liaison = array(
                'idLiaison' => $gloseCourante['identifiant'] . "_m" . ($i+1),
                'idMotAmbigu' => $idMotAmbigu,
                'idGlose'  => $idGlose,
                'nbrVote'  => 0,
              );
            }
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

        $_SESSION['user']['nbrPhraseCree'] = $_SESSION['user']['nbrPhraseCree'] + 1;
        $_SESSION['user']['nbrGloseAjoutee'] = $_SESSION['user']['nbrGloseAjoutee'] + $nbrGloseAjoutee;
        $_SESSION['user']['nbrMotAmbigu'] = $_SESSION['user']['nbrMotAmbigu'] + $nbrMotAmbigu;
        $_SESSION['user']['point'] = $_SESSION['user']['point'] + 25;
        $_SESSION['user']['titre'] = $titre;
        $dataJoueur = array(
          'titre' => $titre,
          'point' => $_SESSION['user']['point'],
          'nbrPhraseCree' =>  $_SESSION['user']['nbrPhraseCree'],
          'nbrGloseAjoutee' => $_SESSION['user']['nbrGloseAjoutee'],
          'nbrMotAmbigu' => $_SESSION['user']['nbrMotAmbigu'],
          'id_joueur' => $_SESSION['user']['id_joueur']
        );
        $requete = $this->db->query("UPDATE Joueur SET titre = ?, point = ?, nbrPhraseCree = ?, nbrGloseAjoutee = ?, nbrMotAmbigu = ? WHERE id_joueur = ?", $dataJoueur);


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

      public function getCreateurById($phrase){
        $this->db->select('*');
        $this->db->where('id_phrase',$phrase);
        $query = $this->db->get('Phrase');
        return $query->row()->id_Createur;
      }

      ///fonctions pour le classement
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
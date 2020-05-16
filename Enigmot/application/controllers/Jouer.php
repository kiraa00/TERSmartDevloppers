<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jouer extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('Phrase');
		$this->load->model('Mot');
		$this->load->model('Glose');
		$this->load->model('Liaison');
		$this->load->model('Joueur');
		$this->load->model('JouerModel');
		//XMLHttpRequest
		header('Access-Control-Allow-Origin: *');
	}
	
	public function index($type = 'ambigu')
	{
		$data = $this->getPhrase($type);
		if($data!=null){
			$data['Type']=$type;
			if($type == 'ambigu'){
				$data['url']='index.php/jouer';
				$javaFile = "assets/js/gameAmb.js";
			}else{
				$data['url']='index.php/jouer/rattachement';
				$javaFile = "assets/js/gameRatt.js";
			}
			$footerData = array(
				"javaFile" => $javaFile,
			);
			$headerData = array(
				"cssFile" => 'assets/css/game.css',
				"flagActif" => "jouer",
			);	
			$this->load->view('header',$headerData);     
			$this->load->view('pages/Jouer',$data);
	        $this->load->view('footer',$footerData);
		}else{
			redirect('Create_Phrase');
		}
}
	
	public function getPhrase($type){
		$phrase = $this->Phrase->getRandomPhrase($type);
		if(isset($phrase)){
			$phraseId = $phrase->id_phrase;
			$mots = $this->Mot->getMotByPhrase($phraseId);
			$dataAmbigu = array();
			$i=0;
			foreach ($mots as $mot) {
				$gloses = $this->Glose->getGlosesByMotID($mot->id_ambigu);
				$dataAmbigu[$i] = array(
					'mot' => $mot,
					'gloses' => $gloses,
					'nbrGlose' => count($gloses),
				);
				$i++;
			}
			$data = array(
				'phrase'=> $phrase,
				'dataAmbigu' => $dataAmbigu,
			);
			return $data;
		}else{
			return null;
		}
	}

	public function ajouterGlose(){
		$id_mot = $this->input->post('id_Ambigu');
		$id_Glose='';
        $gloses = $this->Glose->getGlosesByMotID($id_mot);
        $cost = count($gloses)*10;
        $message='';
        if($_SESSION['user']['credit']>=$cost){
			$glose = $this->input->post('glose');
			$id_Glose = $this->Glose->insert($glose);
			$dataL = array(
	            'idMotAmbigu' =>  $id_mot,
	        	'idGlose'   =>  $id_Glose,
	            'nbrVote'  => 0,
	        );
        	$_SESSION['user']['credit'] = $_SESSION['user']['credit'] - $cost;
        	$this->joueur->ajoutGlose($_SESSION['user']['credit'],$cost);
        	$this->Liaison->insert($dataL);
        }else{
        	$message='vous n\'avez pas assez de crédits pour créer la glose';
        }
        $dataSend=array(
        	'message' => $message,
        	'id_Glose' => $id_Glose,
        );
        echo json_encode($dataSend);
	}



	public function saveData(){
		$user = null;
		$phrase = $this->input->post('idPhrase');
		$dejaJouer = false;
		if(!isset($phrase)){
			redirect('Jouer');
		}
					//rules validation
		$this->form_validation->set_rules('idGlose[]', 'idGlose[]', 'required', array('required' => 'vous avez pas choisit la glose'));
		if($this->form_validation->run()==TRUE){
			if(isset($this->session->user)){
				$user = $this->session->user;
				$dejaJouer = $this->JouerModel->aJouer($user['id_joueur'],$phrase);
			}
				$data = array(
		            'Phrase'      => $phrase,
		            'Mot'        => $this->input->post('idMot'),
		            'Gloses'      => $this->input->post('idGlose'),
		            'Joueur'		=> $user['id_joueur'],
				);
			if(isset($this->session->user) & !$dejaJouer){
				$gainTotale = 0;
				for($i=0;$i<count($data['Mot']);$i++){
					list($gloseID, $liaisonID) = explode(":",$data['Gloses'][$i]);
					$nbr_reponse = $this->Mot->jouer($data['Mot'][$i]);
					$nbr_Vote = $this->Liaison->jouer($data['Mot'][$i],$gloseID,$liaisonID);
					if($nbr_reponse==0){
						$nbr_reponse=1;
					}
					$gainTotale +=($nbr_Vote/$nbr_reponse)*100; 
				}
				$gainTotale = ceil($gainTotale);
				//ajouter la partie jouer
				$this->JouerModel->jouer($data['Phrase'],$data['Joueur'],$gainTotale);
				// ajouter les points et crédits au joueur
				$_SESSION['user']['credit'] = $_SESSION['user']['credit'] + $gainTotale;
				$_SESSION['user']['point'] = $_SESSION['user']['point'] + $gainTotale;
				$titre = $this->Joueur->getTitre($_SESSION['user']['point']);

				$this->Joueur->jouer($data['Joueur'],$gainTotale,$titre);

				// ajouter les points et crédits au créateur
				$createurId = $this->Phrase->getCreateurById($data['Phrase']);
				$createur = $this->Joueur->getJoueurById($createurId);
				$pointGagne = $createur->point+count($data['Mot'])*10;
				$titre = $this->Joueur->getTitre($pointGagne);
				$this->Joueur->jouer($createurId,$gainTotale,$titre);
			}
			


			//affichage de résultats
			//----- phrase de resultat -----------------
			if(isset($gainTotale)){
				$resultat = "Félicitations, vous avez gagné <amb> $gainTotale </amb> points !";
				if($gainTotale == 0){
					$resultat = "Dommage, vous n'avez pas gagné de point cette fois.";
				}
			}else{
				if($dejaJouer){
					$resultat = "Vous avez déjà joué cette phrase, vous ne gagnez donc pas de points.";
				}else{
				$resultat = "Connectez-vous pour enregistrer vos parties et avoir accès à toutes les phrases et fonctionnalités !";
				}
			}
			//----- récupération de la phrase jouer ------
			$dataPhrase = $this->Phrase->getPhraseById($data['Phrase']);
			$type = $dataPhrase->type;
			//----- récupération de créateur de la phrase
			$dataJoueur = $this->Joueur->getJoueurById($dataPhrase->id_Createur);
			//----- structurer les mots avec ses gloses et le nombre de vote
			$MotsResultat = array();
			for($i=0;$i<count($data['Mot']);$i++){
				$dataMot = $this->Mot->getMotById($data['Mot'][$i]);
				$MotsResultat[$i]=array(
					'motObject'	=>	$dataMot,
					'gloses'	=>	array(),
				);
				//récupérer et structurer des gloses du mot
				$dataGloses = $this->Glose->getGlosesByMotID($data['Mot'][$i]);
				$j=0;
				foreach ($dataGloses as $dataglose) {
					$idGlose=$dataglose->id_glose;
					$idLiaison=$dataglose->idLiaison;
					list($gloseIDref, $liaisonIDref) = explode(":",$data['Gloses'][$i]);
					$Vote = $this->Liaison->getVote($data['Mot'][$i],$idGlose,$idLiaison);
					$gloseName = $dataglose->glose;
					if($idGlose == $gloseIDref & $idLiaison == $liaisonIDref){
						$gloseName = "<glose>".$dataglose->glose."</glose>";
						if(!$dejaJouer){
							$Vote--;
						}
						$Vote= "<glose>".$Vote."</glose>";
					}
					
					$MotsResultat[$i]['gloses'][$j]=array(
						'gloseName' =>	$gloseName,
						'vote'	=>	$Vote,
					);
					if(!isset($this->session->user)){
						$MotsResultat[$i]['gloses'][$j]['vote']="";
					}
					$j++;
				}
			}

			$ResultatJeu = array(
				'resultat'	=>	$resultat,
				'phrase'	=>	$dataPhrase->Phrase,
				'createur'	=>	$dataJoueur->pseudo,
				'dataMots'	=>	$MotsResultat,
			);
			if($type == 'ambigu'){
				$ResultatJeu['url']='index.php/jouer';
			}else{
				$ResultatJeu['url']='index.php/jouer/rattachement';
			}			
			$this->showResult($ResultatJeu);
		}else{
			redirect('Jouer');
		}
		
	}

	public function showResult($data){
		$headerData = array(
			"cssFile" => "assets/css/resultat.css",
			"flagActif" => "Résultats",
		);
		$footerData = array(
			"javaFile" => "assets/js/gameAmb.js"
		);
		$this->load->view('header', $headerData);
		$this->load->view('pages/resultat',$data);
		$this->load->view('footer',$footerData);
	}

}
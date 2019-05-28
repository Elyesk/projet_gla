<?php
session_start();
$servername = "localhost";
$username = "main";
$password = "main";

class Personne {
	private $idPersonne;
	private $email;
	private $prenom;
	private $nom;
	private $mdp;
	
	function __construct($data) {
		print_r($data);
		$this->idPersonne = $data["idPersonne"];
		$this->email = $data["email"];
		$this->prenom = $data["prenom"];
		$this->nom = $data["nom"];
		$this->mdp = $data["mdp"];
	}
	
	function getIdPersonne(){
		return $this->idPersonne;
	}
	function getEmail(){
		return $email;
	}
	function setEmail($login){
		$this->email = $login;
	}
	function getNom(){
		return $this->nom;
	}
	function setNom($nom) {
		$this->nom = $nom;
	}
	function getMdp(){
		return $this->mdp;
	}
	function setMdp($mdp){
		$this->mdp = $mdp;
	}
	function getPrenom(){
		return $this->nom;
	}
	function setPrenom($nom){
		$this->prenom = $nom;  
	}
}

class Salarie extends Personne {
	private $estManager;
	
	function __construct($data) {
		parent::__construct($data);
		$this->estManager = $data["estManager"];
	}
	
	function getDroitManager(){
		return $estManager;   
	}
	function setDroitManager($manager){
		$estManager = $manager;
	}
}

class Action {
	public $idAction;
    public $descriptionGeneree;
    public $validee;
    public $sqlPourAnnulerAction;
    
	function __construct($data) {
		$this->idAction = $data["idAction"];
		$this->descriptionGeneree = $data["descriptionGeneree"];
		$this->validee = $data["validee"];
		$this->sqlPourAnnulerAction = $data["sqlPourAnnulerAction"];
	}
	
    function getId(){
    	return $this->idAction;
    }
    function getDescription(){
    	return $this->descriptionGeneree;
    }
    function setDescription($description){
    	$this->descriptionGeneree = $description;
    }
    function valider($validation){
		$validee = (int)$validation;
    }
    function getSql(){
    	return $this->sqlPourAnnulerAction;
    }
    function setSql($sql){
    	$this->sqlPourAnnulerAction = $sql;
    }
}

class Produit {
    private $idProduit;
    private $nomProduit;
    private $auteur;
    private $etat;
    private $categorie;
    private $edition;
    private $datePublic;
    private $quantite;
    private $noteProduit;
    private $description;
	
    private $emprunts;
    private $reservations;
	
	function __construct($data) {
		print_r($data);
		$this->idProduit = $data["idProduit"];
		$this->nomProduit = $data["nomProduit"];
		$this->auteur = $data["auteur"];
		$this->etat = $data["etat"];
		
		if ($data["edition"] === null) {
			$this->edition = "";
		} else {
			$this->edition = $data["edition"];
		}
		$this->datePublic = $data["datePublic"];
		$this->quantite = $data["quantite"];
		
		if ($data["noteProduit"] == -1) {
			$this->noteProduit = "Aucune note pour l'instant";
		} else {
			$this->noteProduit = $data["noteProduit"];
		}
		if ($data["description"] === null) {
			$this->description = "";
		} else {
			$this->description = $data["description"];
		}
	}
	
	// NOT TESTED FUNCTION
	function setEmprunts($data) {
		$this->emprunts = array();
		foreach ($data as $row) {
			array_push($this->emprunts, new Emprunt($row));
		}
	}
	
	function setReservations($data) {
		// TODO
	}
	
    function getIdProduit(){
    	return $this->idProduit;
    }
    function setIdProduit($idProduit){
		$this->idProduit = $idProduit;
    }
    function getNomProduit(){
		return $this->nomProduit;
    }
    function setNomProduit($nom){
    	$this->nomProduit = $nom;
    }
    function getAuteur(){
		return $this->auteur;
    }
    function setAuteur($auteur){
    	$this->auteur = $auteur;
    }
    function getEtat(){
    	return $this->etat;
    }
    function setEtat($etat){
    	$this->etat = $etat;
    }
    function getEdition(){
		return $this->edition;
    }
    function setEdition($edition){
    	$this->edition = $edition;
    }
    function getDatePublic(){
    	return $this->datePublic;
    }
    function setDatePublic(){
		$this->datePublic = $datePublic;
    }
    function getQuantite(){
		return $this->quantite;
    }
    function setQuantite($quantite){
    	$this->quantite = $quantite;
    }
    function getNoteProduit(){
    	return $this->noteProduit;
    }
    function setNoteProduit($noteProduit){
    	$this->noteProduit = $noteProduit;
    }
    function getDescription(){
    	return $this->description;
    }
    function setDescription($description){
    	$this->description = $description;
    }
	
    function getEmprunts(){
    	// TODO	
    }
    function getReservations(){
    	// TODO	
    }
}

class Emprunt {
    private $idEmprunt;
    private $idClient;
    private $idProduit;
    private $date_emprunt;
    private $date_retour;
    public $produit;
	
	function __construct($data) {
		print_r($data);
		$this->idEmprunt = $data["idEmprunt"];
		$this->idClient = $data["idClient"];
		$this->idProduit = $data["idProduit"];
		$this->date_emprunt = $data["date_emprunt"];
		$this->date_retour = $data["date_retour"];
	}
	
	function setProduit($produit) {
		$this->produit = $produit;
	}
	
    function getIdEmprunt(){
    	return $this->idEmprunt;
    }
    function getIdClient(){
    	return $this->idClient;
    }
    function getIdProduit(){
    	return $this->idProduit;
    }
    function setIdProduit($idProduit){
    	$this->idProduit = $idProduit; 
    }
    function getDate_emprunt(){
    	return $this->date_emprunt;	
    }
    function getDate_retour(){
    	return $this->date_retour;
    }
    function setDate_retour($date){
    	$this->date_retour = $date;
    }
}

class Actions_ADO {
	static function createAction($connection, $description, $sqlPourAnnuler) {
		$connection->query("INSERT INTO db.Action (descriptionGeneree, sqlPourAnnulerAction) VALUES ('$description','$sqlPourAnnuler')");
	}
}

class Info_Salarié_ADO {
	public $vue;
	public $salarie;
	public $connection;
	
	function __construct($id) {
		$this->connection = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		if ($this->connection->connect_error) {
			die("Connection failed: " . $this->connection->connect_error);
		}
		echo "SELECT * FROM db.Personne, db.Salarie WHERE db.Salarie.idPersonne=$id AND db.Salarie.idPersonne = db.Personne.idPersonne";
		$result = $this->connection->query("SELECT * FROM db.Personne, db.Salarie WHERE db.Salarie.idPersonne=$id AND db.Salarie.idPersonne = db.Personne.idPersonne");
		if (!$result or $result->num_rows == 0) {
			print_r($this->connection->error_list);
			die("Etes vous sur que ce salarié existe");
		}
		
		$this->salarie = new Salarie($result->fetch_assoc());
	}
	
	function supprimerSalarie_ADO(){
		$id = $this->salarie->getIdPersonne();
		
		$result = $this->connection->query("DELETE FROM db.Personne WHERE idPersonne=$id");
		// Supprimer la personne supprime aussi dans la table salarie.
		if (!$result) {
			print_r($this->connection->error_list);
			echo "Echec de la suppression.";
		}
		
		// Création de l'action correspondante.
		$nom = $this->salarie->getNom();
		$description = "Suppression du salarie $nom. Cette action ne peut pas etre annulée.";
		$sqlPourAnnuler = "";
		
		Actions_ADO::createAction($this->connection, $description, $sqlPourAnnuler);
	}
	
	function affiche_ListeSalarie_ADO(){
		// TODO
	}
}

class Action_ADO {
    public $vue;
    public $actions;
	
	function __construct() {
		$this->connection = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		if ($this->connection->connect_error) {
			die("Connection failed: " . $this->connection->connect_error);
		}
		
		echo "SELECT * FROM db.Action ORDER BY idAction DESC";
		$result = $this->connection->query("SELECT * FROM db.Action");
		if (!$result or $result->num_rows == 0) {
			print_r($this->connection->error_list);
			die("Pas d'actions !");
		}
		$this->actions = $result->fetch_all(MYSQLI_ASSOC);
	}
	
    function valider_action_ADO($id){
				print_r($this->actions[$id]);
    	$this->actions[$id]["validee"] = 1;
		echo "UPDATE db.Action SET validee=1 WHERE id=$id";
		print_r($this->actions[$id]);
		$result = $this->connection->query("UPDATE db.Action SET validee=1 WHERE idAction=$id");
		if (!$result) {
			print_r($this->connection->error_list);
			echo "Echec de la validation.";
		}
    }
    function annuler_action_ADO($id){
    	$this->actions[$id]["validee"] = -1;
		echo "UPDATE db.Action SET validee=-1 WHERE id=$id";
		$result = $this->connection->query("UPDATE db.Action SET validee=1 WHERE idAction=$id");
		if (!$result) {
			print_r($this->connection->error_list);
			echo "Echec de l'annulation.";
		}
		
		print_r ($this->actions[$id]);
		if ($this->actions[$id]["sqlPourAnnulerAction"] == "") {
			echo "Malheureusement cette action précise ne peut pas réellement etre annulée. Les données ont déjà été perdues.";
		} else {
			$result = $this->connection->query($this->actions[$id]["sqlPourAnnulerAction"]);
			if (!$result) {
				print_r($this->connection->error_list);
				echo "Echec de l'annulation.";
			} else {
				$result = $this->connection->query("DELETE FROM db.Action WHERE idAction=$id");
				if (!$result) {
					print_r($this->connection->error_list);
					echo "Echec de l'annulation.";
				}
				unset($actions[$id]);
			}
		}
    }
}

$info = new Action_ADO();
$info->valider_action_ADO(19);

class Reservation { 
    private $idReservation;
    private $idDocument;
    private $idAbonne;
    private $date_reservation;
	
	function __construct($data) {
		print_r($data);
		$this->idReservation = $data["idReservation"];
		$this->idDocument = $data["idDocument"];
		$this->idAbonne = $data["idAbonne"];
		$this->date_reservation = $data["date_reservation"];
	}


    function getIdReservation(){
    	return $this->idReservation;
    }
    function getIdDocument(){
    	return $this->idDocument;
    }
    function getIdAbonne(){
    	return $this->idAbonne;
    }
    function setIdAbonne($idAbonne){
    	$this->idAbonne = $idAbonne; 
    }
    function getDate_reservation(){
    	return $this->date_reservation;	
    }
    function setDate_reservation($date_reservation){
    	$this->date_reservation = $date_reservation;
    }
}

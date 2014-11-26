<?php

class Association{
	
///// VARIABLES D'ÉTAT /////
	public $idAssocation;
	public $nomAssociation;
	public $description;
	public $adresse1;
	public $adresse2;
	public $ville;
	public $codePostal;
	public $adresseMail;
	public $siteWeb;
	public $lienlogo;
	public $login;
	public $password;

///// METHODES DE CLASSE /////
	public function __construct($nom=NULL, $description=NULL, $ad1=NULL, $ad2=NULL, $vill=NULL, $CP = NULL, $mail=NULL, $sweb=NULL, $lien=NULL, $log=NULL, $pass=NULL,$id=NULL){
		$this->idAssocation = $id;			
		$this->nomAssociation= $nom;
		$this->description=$description;
		$this->adresse1 = $ad1;
		$this->adresse2 = $ad2;
		$this->ville = $vill;
		$this->codePostal = $CP;
		$this->adresseMail = $mail;
		$this->siteWeb = $sweb;
		$this->lienlogo = $lien;
		$this->login = $log;
		$this->password = $pass;
	}



}

?> 
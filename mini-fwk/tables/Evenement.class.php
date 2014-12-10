<?php

 class Evenement{

 		public $id;
		public $nom;
		public $description;
		public $dateHeure;
		public $ppvente;
		public $pvente;
		public $typeEvent;
		public $idlieu;
		public $idAsso;
		
		public function __construct($id=NULL, $nom=NULL, $description=NULL, $dateHeure=NULL, $ppvente=NULL, $pvente=NULL, $typeEvent=NULL, $idlieu=NULL, $idAsso=NULL){
			$this->id = $id;			
			$this->description=$description;
			$this->nom= $nom;
			$this->dateHeure = $dateHeure;
			$this->ppvente = $ppvente;
			$this->pvente = $pvente;
			$this->typeEvent = $typeEvent;
			$this->idlieu = $idlieu;
			$this->idAsso = $idAsso;
		}

 }		
 ?>
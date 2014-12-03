<?php

 class Evenement{

 		public $id;
		public $nom;
		public $description;
		public $dateHeure;

		
		public function __construct($id=NULL, $nom=NULL, $description=NULL, $dateHeure=""){
			$this->id = $id;			
			$this->description=$description;
			$this->nom= $nom;
			$this->dateHeure = $dateHeure;
		}

 }
 ?>
<?php

 class Cinema{

 		/*public $idLieu;*/
		public $nomLieu;
		/*public $adresse1;
		public $adresse2;
		public $ville;
		public $codePostal;*/
		public $idTypeLieu;
		public $longitude;
		public $latitude;
		
		
		public function __construct(/*$idLieu=NULL, */$nomLieu=NULL,/* $adresse1=NULL, $adresse2=NULL, $ville =NULL, $codePostal=NULL, */$idTypeLieu=2, $longitude=NULL, $latitude=NULL){
			
			/*$this->idLieu = $idLieu;*/		
			$this->nomLieu=$nomLieu;
			/*$this->adresse1= $adresse1;
			$this->adresse2 = $adresse2;
			$this->ville = $ville;
			$this->codePostal = $codePostal;*/
			$this->idTypeLieu = $idTypeLieu;
			$this->longitude = $longitude;
			$this->latitude = $latitude;
		}

 }
 ?>
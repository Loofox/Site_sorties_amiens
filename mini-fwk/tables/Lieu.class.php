<?php

class Lieu{
		
		public $idLieu;
		public $nomLieu;
		public $adresse1;
		public $adresse2;
		public $ville;
		public $codePostal;
		public $idTypeLieu;
		public $longitude;
		public $latitude;

		public function __construct($nomLieu=NULL, $adresse1=NULL, $adresse2=NULL, $ville=NULL, $codePostal=NULL, $idTypeLieu=NULL, $longitude=NULL,$latitude =NULL, $idLieu=NULL){
			$this->idLieu = $idLieu;			
			$this->nomLieu = $nomLieu;
			$this->adresse1 = $adresse1;
			$this->adresse2 = $adresse2;
			$this->ville = $ville;
			$this->codePostal = $codePostal;
			$this->idTypeLieu = $idTypeLieu;
			$this->longitude = $longitude;
			$this->latitude = $latitude;
		}
		
		
		
		
}

?>
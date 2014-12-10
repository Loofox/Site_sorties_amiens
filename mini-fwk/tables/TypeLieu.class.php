<?php



//exemple de classe en relation avec la table
class TypeLieu{
		
		public $idTypeLieu;
		public $nomTypeLieu;
		
		public function __construct($nomLieu=NULL, $idTypeLieu=NULL){
			$this->idTypeLieu = $idTypeLieu;			
			$this->nomTypeLieu = $nomTypeLieu;
		}
		
		
		//éventuellement setters et getters
		
		
}

?>
<?php



//exemple de classe en relation avec la table
class TypeEvenement{
		
		public $idTypeEvenement;
		public $nomTypeEvenement;
		
		public function __construct($nomTypeEvenement=NULL, $idTypeEvenement=NULL){
			$this->idTypeEvenement = $idTypeEvenement;			
			$this->nomTypeEvenement = $nomTypeEvenement;
		}
		
		
		//éventuellement setters et getters
		
		
}

?>
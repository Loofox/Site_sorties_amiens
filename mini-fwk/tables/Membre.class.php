<?php
//exemple de table Membre
/*
//structure SQL : 
CREATE TABLE `Membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `pass` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
*/



//exemple de classe en relation avec la table
class TypeEvenement{
		
		public $idTypeEvenement;
		public $nomTypeEvenement
		
		public function __construct($nomTypeEvenement=NULL, $idTypeEvenement=NULL){
			$this->idTypeEvenement = $idTypeEvenement;			

		}
		
		
		//éventuellement setters et getters
		
		
}

?>
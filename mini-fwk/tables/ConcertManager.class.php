<?php
//exemple de table Membre
/*
//structure SQL : 
CREATE TABLE `Membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `pass` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
*/



//classe de gestion des entités Membre
class ConcertManager{
	

		public static function chercherParidTypeLieu($idTypeLieu=3){
			$sql="SELECT * FROM lieu WHERE idTypeLieu = ?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($idTypeLieu));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}
			$c= $res->fetch();			
			$conc=new Bar();
			$conc->idLieu=$c[0];
			$conc->nomLieu= $c[1];
			$conc->adresse1=$c[2];
			$conc->adresse2=$c[3];
			$conc->ville=$c[4];
			$conc->codePostal=$c[5];	
			$conc->idTypeLieu=$c[6];	
			$conc->longitude=$c[7];	
			$conc->latitude=$c[8];													
			return $conc;
		}

		public static function desactiver(){
			
		}
		public static function activer(){
			
		}
}

?>
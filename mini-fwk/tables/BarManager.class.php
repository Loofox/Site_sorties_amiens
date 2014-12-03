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
class BarManager{
	

		public static function chercherParidTypeLieu($idTypeLieu=1){
			$sql="SELECT * FROM lieu WHERE idTypeLieu = ?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($idTypeLieu));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}
			$b= $res->fetch();			
			$bar=new Bar();
			$bar->idLieu=$b[0];
			$bar->nomLieu= $b[1];
			$bar->adresse1=$b[2];
			$bar->adresse2=$b[3];
			$bar->ville=$b[4];
			$bar->codePostal=$b[5];	
			$bar->idTypeLieu=$b[6];	
			$bar->longitude=$b[7];	
			$bar->latitude=$b[8];													
			return $bar;
		}

		public static function desactiver(){
			
		}
		public static function activer(){
			
		}
}

?>
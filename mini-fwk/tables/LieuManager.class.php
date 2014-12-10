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
class LieuManager{
	
/*
		public static function creer($m){
			
			$sql = "INSERT INTO Membre VALUES ('',?, ?, ?, ?, ?)";
			$res = DB::get_instance()->prepare($sql);
			$res -> execute(array($m->login, $m->nom, $m->prenom,$m->mail,$m->pass));
			$m->id=DB::get_instance()->lastInsertId();
			return $m;
			
		}

*/
		public static function chercherParID($id){
			$sql="SELECT * from lieu WHERE idLieu=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($id));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}
			$m= $res->fetch();			
			$membre=new Lieu();
			$membre->idLieu=$m[0];			
			$membre->nomLieu = $m[1];
			$membre->adresse1 = $m[2];
			$membre->adresse2 = $m[3];
			$membre->ville = $m[4];
			$membre->codePostal = $m[5];
			$membre->idTypeLieu = $m[6];
			$membre->longitude = $m[7];
			$membre->latitude = $m[8];							
			return $membre;
		}


/*
		public static function chercherParLogin($login){
			$sql="SELECT * from Membre WHERE login=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($login));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}
			$m= $res->fetch();			
			$membre=new Membre();
			$membre->id=$m[0];
			$membre->login=$m[1];
			$membre->nom= $m[2];
			$membre->prenom=$m[3];
			$membre->mail=$m[4];
			$membre->pass=$m[5];											
			return $membre;
		}
		
*/		
		//autres exemples de fonctions possibles
		public static function liste(){
			$sql = "SELECT * FROM lieu";
			$res = DB::get_instance()->prepare($sql);
			$res -> execute();

			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}


			$m = array();
			while( $ligne =  $res->fetch(PDO::FETCH_ASSOC)){
					$m[ $ligne["idLieu"] ] = $ligne["nomLieu"];
				}	
			return $m;
				
		}   		

		public static function desactiver(){
			
		}
		public static function activer(){
			
		}

}

?>
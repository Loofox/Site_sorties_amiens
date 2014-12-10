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
class TypeEvenementManager{
	
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
			$sql="SELECT * from typeevenement WHERE idTypeEvenement=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($id));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}
			$m= $res->fetch();			
			$membre=new TypeEvenement();
			$membre->idTypeEvenement=$m[0];
			$membre->nomTypeEvenement=$m[1];
											
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
		public static function liste()
		{
			$sql = "SELECT * FROM typeevenement";
			$res = DB::get_instance()->prepare($sql);
			$res -> execute();

			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}

			$m = array();
			while( $ligne =  $res->fetch(PDO::FETCH_ASSOC)){
					$m[ $ligne["idTypeEvenement"] ] = $ligne["nomTypeEvenement"];
				}	
			return $m;
		}   		

		public static function desactiver(){
			
		}
		public static function activer(){
			
		}

}

?>
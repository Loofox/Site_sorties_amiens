<?php

/*
//structure SQL de la table Association
CREATE TABLE IF NOT EXISTS `association` (
  `idAssociation` int(11) NOT NULL AUTO_INCREMENT,
  `nomAssociation` varchar(256) CHARACTER SET utf16 NOT NULL,
  `description` varchar(256) CHARACTER SET utf16 NOT NULL,
  `adresse1` varchar(256) CHARACTER SET utf16 NOT NULL,
  `adresse2` varchar(256) CHARACTER SET utf16 NOT NULL,
  `ville` varchar(25) CHARACTER SET ucs2 NOT NULL,
  `codePostal` int(5) NOT NULL,
  `adresseMail` varchar(100) CHARACTER SET utf16 NOT NULL,
  `siteWeb` varchar(100) CHARACTER SET utf16 NOT NULL,
  `lienLogo` varchar(256) CHARACTER SET utf16 NOT NULL,
  `login` varchar(16) CHARACTER SET utf8 NOT NULL,
  `password` char(32) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idAssociation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
*/



//classe de gestion des entités Associatoin
class AssociationManager{
	

		public static function creer($a){
			
			$sql = "INSERT INTO association VALUES ('',?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$res = DB::get_instance()->prepare($sql);
			$res -> execute(array($a->nomAssociation, $a->description,$a->adresse1, $a->adresse2, $a->ville, $a->codePostal, $a->adresseMail, $a->siteWeb, $a->lienLogo, $a->login, $a->password));
			$a->id=DB::get_instance()->lastInsertId();
			return $m;
			
		}


		public static function chercherParID($id){
			$sql="SELECT * from association WHERE id=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($id));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}
			$m= $res->fetch();			
			$association=new Association();
			$association->idAssociation=$m[0];
			$association->nomAssociation=$m[1];
			$association->description= $m[2];
			$association->adresse1=$m[3];
			$association->adresse2=$m[4];
			$association->ville=$m[5];
			$association->codePostal=$m[6];											
			$association->adresseMail=$m[7];											
			$association->siteWeb=$m[8];											
			$association->lienLogo=$m[9];
			$association->login=$m[10];
			$association->password=$m[11];																																												
			return $association;
		}



		public static function chercherParLogin($login){
			$sql="SELECT * from association WHERE login=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($login));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}
			$m= $res->fetch();			
			$association=new Association();
			$association->idAssociation=$m[0];
			$association->nomAssociation=$m[1];
			$association->description= $m[2];
			$association->adresse1=$m[3];
			$association->adresse2=$m[4];
			$association->ville=$m[5];
			$association->codePostal=$m[6];											
			$association->adresseMail=$m[7];											
			$association->siteWeb=$m[8];											
			$association->lienLogo=$m[9];
			$association->login=$m[10];
			$association->password=$m[11];																																												
			return $association;
		}
		
		//autres exemples de fonctions possibles
		public static function liste(){
			
		}   		

		public static function desactiver(){
			
		}
		public static function activer(){
			
		}
}

?> 
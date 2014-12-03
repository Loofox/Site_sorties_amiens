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
class EvenementManager{
	

		public static function creer($m){
			
			$sql = "INSERT INTO evenement VALUES ('','', '', '', '', '', '', '', '0')";
			$res = DB::get_instance()->prepare($sql);
			$res -> execute(array($m->nom, $m->description, $m->dateHeure, $m->prixPreVente, $m->prixVente, $m->idTypeEvenement, $m->idLieu, $m->idAssociation));
			$m->id=DB::get_instance()->lastInsertId();
			return $m;
			
		}		
		
		//autres exemples de fonctions possibles
		public static function liste(){
			$sql = "SELECT idEvenement, nomEvenement, description, dateHeure FROM evenement ORDER BY idEvenement DESC";
			$stmt =	DB::get_instance()->prepare($sql);
			$stmt->execute();
			$resul = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $resul;

			}   

		public static function liste_asso($id){
			$sql = "SELECT nomEvenement, description, dateHeure FROM evenement WHERE idAssociation = ? ORDER BY idEvenement DESC";
			$stmt =	DB::get_instance()->prepare($sql);
			$stmt->execute(array($id));
			$resul = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $resul;

			} 		


		public static function chercherParNom($nom){
			$sql="SELECT * from evenement WHERE nomEvenement=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($nom));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}
			$e= $res->fetch();			
			$evenement=new Evenement();
			$evenement->id=$e[0];
			$evenement->nom= $e[1];
			$evenement->description=$e[2];
			$evenement->dateHeure=$e[3];
			$evenement->prixPreVente=$e[4];
			$evenement->prixVente=$e[5];	
			$evenement->idTypeEvenement=$e[6];	
			$evenement->idLieu=$e[7];	
			$evenement->idAssociatione=$e[8];													
			return $evenement;
		}

		public static function desactiver(){
			
		}
		public static function activer(){
			
		}
}

?> 
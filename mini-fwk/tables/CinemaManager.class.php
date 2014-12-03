<?php

//classe de gestion des entités Membre
class CinemaManager{
	

		public static function chercherParidTypeLieu($idTypeLieu=2){
			$sql="SELECT * FROM lieu WHERE idTypeLieu = ?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($idTypeLieu));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}
			$c= $res->fetch();			
			$cin=new Cinema();
			$cin->idLieu=$c[0];
			$cin->nomLieu= $c[1];
			$cin->adresse1=$c[2];
			$cin->adresse2=$c[3];
			$cin->ville=$c[4];
			$cin->codePostal=$c[5];	
			$cin->idTypeLieu=$c[6];	
			$cin->longitude=$c[7];	
			$cin->latitude=$c[8];													
			return $cin;
		}

		public static function desactiver(){
			
		}
		public static function activer(){
			
		}
}

?>
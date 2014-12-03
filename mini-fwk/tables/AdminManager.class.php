<?php

//classe de gestion des entités Membre
class AdminManager{
	
		public static function chercherParlogin($loginAdmin){
			$sql="SELECT * from administrateur WHERE loginAdmin=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($nom));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}
			$a= $res->fetch();			
			$admin=new Admin();
			$admin->idAdmin=$a[0];
			$admin->loginAdmin= $a[1];
			$admin->passAdmin=$a[2];													
			return $admin;
		}

		public static function desactiver(){
			
		}
		public static function activer(){
			
		}
}

?>
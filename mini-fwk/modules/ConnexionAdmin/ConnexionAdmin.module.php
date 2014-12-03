<?php
class ConnexionAdmin extends Module{
			

	public function action_login(){

		//Vérification des données de connexion
		$user=AdminManager::chercherParLogin($_POST["loginAdmin"]);

		if($_POST["passAdmin"]==$user->password){
			//charger le membre
			$this->session->ouvrir($user);

			//code de demo
			$m= $user;
			//$m->login = $this->req->Login;
			$this->session->user=$m;		
			$this->tpl->assign('loginAdmin',$m->login);
			$this->site->ajouter_message("Vous êtes connecté en tant que ".$m->login);
			//$this->session->connex = $f;	
			$this->site->redirect("index"); /* Redirection vers portail admin */
		}
		else{
			$this->site->redirect("index");
		}
	}

	public function action_deconnect(){		
		$this->site->ajouter_message('Vous êtes déconnecté');							
		$this->session->fermer(); 			
		$this->site->redirect("index");
	}

}
?>
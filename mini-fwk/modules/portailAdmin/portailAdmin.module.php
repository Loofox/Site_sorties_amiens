<?php
class portailAdmin extends Module{

	public function action_index(){
		$this->set_title("Administrateur");

		//création de variables PHP
		//on récupère de la base de données des éléments
		$donne = EvenementManager::Liste();
		//passe les variables au template		
		$this->tpl->assign('data',$donne);

	}
	
	public function action_modifier(){
		$this->set_title("Modifier");
	
		//recupère l'id et la référence 
		$id = $this->req->id;
		$ref= $this->req->ref;
		
		//passe ces informations dans le template
		
		$this->tpl->assign("id",$id);
		$this->tpl->assign("reference",$ref);		
	
		
	}
	public function action_supprimer(){
		$this->set_title("Supprimer");

		//recupère l'id et la référence 
		$id = $this->req->id;
		$ref= $this->req->ref;
		
		//passe ces informations dans le template
		
		$this->tpl->assign("id",$id);
		$this->tpl->assign("reference",$ref);		
		
	}
	

	public function action_ajouter(){
		$this->set_title("Ajouter");	
		
		$f= new Form("?module=CRUD&action=valide","form_modif");	
		$f->add_text("nom","nom","Nom de l'événement")->set_required();
		$f->add_text("description","description","Description")->set_required();
		$f->add_text("dateH","dateH","Date et heure")->set_required();
		
		//règles de validation automatiques
		//$f->dateH->set_validation("date:d-m-Y");
		$f->nom->set_validation("required");
		$f->description->set_validation("required");
		$f->dateH->set_validation("required");
		$f->dateH->set_value("0000-00-00 00:00:00");


		$f->add_submit("Valider","bntval")->set_value('Valider');	

		//passe le formulaire dans le template sous le nom "form"
		$this->tpl->assign("form_modif",$f);	
		
		//stocke la structure du formulaire dans la session sous le nom "form"
		//pour une éventuelle réutilisation
		$this->session->form = $f;
	}

		public function action_valide(){
		$this->set_title("Ajouter");	
		$err=false;
		//on récupère la structure du formulaire précédemment stocké dans la session
		$form=$this->session->form;
		$form->reset_errors();


		//effectue les tests de vérification définis par l'utilisateur
		//si un des tests échoue : false
		$valide = $form->check();
	
	
		//dans cet exemple, on vérifie seulement si le login est vide et s'il n'existe pas dans la base

		if($this->requete->nom == ''){
			$valide=false;
			$form->login->set_error(true);
			$form->login->set_error_message("champ vide !");
		}
	
		//Appel à la BD via objet MembreManager
		elseif( EvenementManager::chercherParNom( $this->requete->nom) !== false){
			$valide=false;
			$form->nom->set_error(true);
			$form->nom->set_error_message("Il y a déja un événement qui porte ce nom !");			
		 }
		
		
		//si un des tests a échoué
		if( $valide==false ){	
		
			$this->site->ajouter_message("Merci de remplir le champs Nom de l'événment",ALERTE);			

		
			//on pré-remplit avec les valeurs déjà saisies
			$form->populate();		
			//passe le formulaire dans le template sous le nom "form"
			$this->tpl->assign("form",$form);
		}
		//tous les tests ont été validés
		else{

			//création d'une instance d'événement
			$m=new Evenement($this->requete->nom,$this->requete->description,$this->requete->dateHeure);

			//enregistrement (insertion) dans la base
			EvenementManager::creer($m);

			//passe un message pour la page suivante
			$this->site->ajouter_message("L'événement est ajouté !");			

			//redirige vers le module par défaut
			$this->site->redirect('index');
		}
	}


	public function action_detail(){
		$this->set_title("Détail");	
		
		//recupère l'id et la référence 
		$id = $this->req->id;
		$ref= $this->req->ref;
		
		//passe ces informations dans le template
		
		$this->tpl->assign("id",$id);
		$this->tpl->assign("reference",$ref);		
		
		
	}
	
}	
?>
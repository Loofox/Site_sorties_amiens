<?php
class portailAsso extends Module{

	public function action_index(){
		$this->set_title("Association");

		//création de variables PHP
		//on récupère de la base de données des éléments
		$donne = EvenementManager::liste_event($this->session->user->idAssociation);
		//passe les variables au template		
		$this->tpl->assign('data',$donne);

	}
	
	public function action_modifier(){
		$this->set_title("Modification");
	
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
		
		$f= new Form("?module=portailAsso&action=valide","form_ajout");	
		$f->add_text("nom","nom","Nom de l'événement")->set_required();
		$f->add_textarea("description","description","Description")->set_required();
		$f->add_text("dateH","dateH","Date et heure")->set_required();
		$f->add_text("prixPVente","prixPVente","Prix de prévente")->set_required();
		$f->add_text("prixVente","prixVente","Prix de vente")->set_required();
		$f->add_radiogroup("Tevent","Tevent", "Type d'événement",array("1"=>"Soirée intégration","2"=>"Zinzin","3"=>"Bonne humeur"))->set_value("Soirée intégration");
		$f->add_radiogroup("Tlieu","Tlieu", "Lieu",array("1"=>"Bar","2"=>"Discothèque","3"=>"Théâtre"))->set_value("Bar");

		//règles de validation automatiques
		//$f->dateH->set_validation("date:d-m-Y");
		$f->nom->set_validation("required");
		$f->description->set_validation("required");
		$f->dateH->set_validation("required");
		$f->dateH->set_value("00-00-000 00:00:00");


		$f->add_submit("Valider","bntval")->set_value('Valider');	

		//passe le formulaire dans le template sous le nom "form"
		$this->tpl->assign("form_ajout",$f);	
		
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

		if($this->requete->nom == ''){
			$valide=false;
			$form->nom->set_error(true);
			$form->nom->set_error_message("champ vide !");
		}
	
		//Appel à la BD via objet EvenementManager
		elseif( EvenementManager::chercherParNom($this->requete->nom) !== false){		/* S'il y a déjà un événement qui porte ce nom */
			$valide=false;
			$form->nom->set_error(true);
			$form->nom->set_error_message("Il y a déja un événement qui porte ce nom !");			
		 }
		
		
		//si un des tests a échoué
		if( $valide==false ){	
		
			$this->site->ajouter_message("Merci de remplir tous les champs",ALERTE);			

		
			//on pré-remplit avec les valeurs déjà saisies
			$form->populate();		
			//passe le formulaire dans le template sous le nom "form"
			$this->tpl->assign("form_ajout",$form);
		}
		//tous les tests ont été validés
		else{

			//création d'une instance d'événement
			$m=new Evenement();
			$m->nom = $this->requete->nom;
			$m->description = $this->requete->description;
			$m->dateHeure = $this->requete->dateHeure;
			$m->ppvente = $this->requete->prixPVente;
			$m->pvente = $this->requete->prixVente;
			$m->typeEvent = $this->requete->Tevent;
			$m->idlieu = $this->requete->Tlieu;
			$m->idAsso = $this->session->user->idAssociation;
			
			//enregistrement (insertion) dans la base
			EvenementManager::creer($m);

			//passe un message pour la page suivante
			$this->site->ajouter_message("L'événement est ajouté !");			

			//redirige vers le module par défaut
			$this->site->redirect('portailAsso');
		}
	}


	public function action_detail(){
		$this->set_title("Détails");	
		
		//recupère l'id et la référence 
		$id = $this->req->id;

		$res =new Evenement();
		$res =EvenementManager::chercherParId($id);
		
		//passe ces informations dans le template
		
		$this->tpl->assign("id",$id);
		$this->tpl->assign("nom",$res->nom);
		$this->tpl->assign("description",$res->description);
		$this->tpl->assign("date",$res->dateHeure);
		$this->tpl->assign("prixPreVente",$res->ppvente);
		$this->tpl->assign("prixVente",$res->pvente);

		//---------------------------------------------------------------	
/*
		$id_tuto = $this->req->id_tuto;
		$titre_conseil = $this->req->titre_conseil;
		$contenu = $this->req->contenu;
		$date_parution = $this->req->date_parution;
		$type_conseil = $this->req->type_conseil;
		
		$conseil = new CRUDConseil();
		$conseil = CRUDConseilManager::Afficher_detail_conseil($id_tuto);

		$this->tpl->assign("id_tuto",$id_tuto);	
		$this->tpl->assign("titre_conseil",$conseil->titre_conseil); 
		$this->tpl->assign("contenu",$conseil->contenu);
		$this->tpl->assign("date_parution",$date_parution);
		$this->tpl->assign("type_conseil",$type_conseil);
		
*/		
	}
	
}	
?>
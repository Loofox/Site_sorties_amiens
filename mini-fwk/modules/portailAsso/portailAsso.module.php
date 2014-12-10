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
		$this->session->ideventmodif = $id;
		$this->set_title("Modification");	
		
		$last = EvenementManager::chercherParId($id);

		$TypeEvenement= TypeEvenementManager::liste();
		$Lieu= LieuManager::liste();

		$f= new Form("?module=portailAsso&action=valide_modification","form_modif");	
		$f->add_text("nom","nom","Nom de l'événement")->set_required();
		$f->add_textarea("description","description","Description")->set_required();
		$f->add_text("dateH","dateH","Date et heure")->set_required();
		$f->add_text("prixPVente","prixPVente","Prix de prévente")->set_required();
		$f->add_text("prixVente","prixVente","Prix de vente")->set_required();
		$f->add_select("choixEvenement","choixEvenement","Type d'événement",$TypeEvenement)->set_required();
		$f->add_select("choixLieu","choixLieu","Lieu",$Lieu)->set_required();

		//règles de validation automatiques
		//$f->dateH->set_validation("date:d-m-Y");
		$f->nom->set_validation("required");
		$f->description->set_validation("required");
		$f->dateH->set_validation("required");
		$f->dateH->set_value($last->dateHeure);
		$f->nom->set_value($last->nom);
		$f->description->set_value($last->description);
		$f->prixPVente->set_value($last->ppvente);
		$f->prixVente->set_value($last->pvente);
		$f->choixEvenement->set_value($last->typeEvent);
		$f->choixLieu->set_value($last->idlieu);


		$f->add_submit("Valider","bntval")->set_value('Valider');	

		//passe le formulaire dans le template sous le nom "form"
		$this->tpl->assign("form_modif",$f);	
		
		//stocke la structure du formulaire dans la session sous le nom "form"
		//pour une éventuelle réutilisation
		$this->session->form_modif = $f;
		
		//passe ces informations dans le template
		
		$this->tpl->assign("id",$id);
		
	}

			public function action_valide_modification(){
		$this->set_title("Modification");	
		$err=false;
		//on récupère la structure du formulaire précédemment stocké dans la session
		$form=$this->session->form_modif;
		$form->reset_errors();


		//effectue les tests de vérification définis par l'utilisateur
		//si un des tests échoue : false
		$valide = $form->check();

		if($this->requete->nom == ''){
			$valide=false;
			$form->nom->set_error(true);
			$form->nom->set_error_message("champ vide !");
		}	
		
		//si un des tests a échoué
		if( $valide==false ){	
		
			$this->site->ajouter_message("Merci de remplir tous les champs",ALERTE);			

		
			//on pré-remplit avec les valeurs déjà saisies
			$form->populate();		
			//passe le formulaire dans le template sous le nom "form"
			$this->tpl->assign("form_modif",$form);
		}
		//tous les tests ont été validés
		else{

			//création d'une instance d'événement
			$m=new Evenement();
			$m->id = $this->session->ideventmodif;
			$m->nom = $this->req->nom;
			$m->description = $this->req->description;
			$m->dateHeure = $this->req->dateH;
			$m->ppvente = $this->req->prixPVente;
			$m->pvente = $this->req->prixVente;
			$m->typeEvent = $this->req->choixEvenement;
			$m->idlieu = $this->req->choixLieu;
			$m->idAsso = $this->session->user->idAssociation;


			//enregistrement (insertion) dans la base
			EvenementManager::modifier($m);

			//passe un message pour la page suivante
			$this->site->ajouter_message("L'événement à bien été modifié !");			

			//redirige vers le module par défaut
			$this->site->redirect('portailAsso');
		}
	}

	public function action_supprimer(){
		$this->set_title("Supprimer");

		//recupère l'id et la référence 
		$id = $this->req->id;
		EvenementManager::supprimer($id);
		
		//passe un message pour la page suivante
		$this->site->ajouter_message("L'événement à bien été supprimé !");			

		//redirige vers le module par défaut
		$this->site->redirect('portailAsso');

		
		
	}
	

	public function action_ajouter(){
		$this->set_title("Ajouter");	
		
		$TypeEvenement= TypeEvenementManager::liste();
		$Lieu= LieuManager::liste();

		$f= new Form("?module=portailAsso&action=valide","form_ajout");	
		$f->add_text("nom","nom","Nom de l'événement")->set_required();
		$f->add_textarea("description","description","Description")->set_required();
		$f->add_text("dateH","dateH","Date et heure")->set_required();
		$f->add_text("prixPVente","prixPVente","Prix de prévente")->set_required();
		$f->add_text("prixVente","prixVente","Prix de vente")->set_required();
		$f->add_select("choixEvenement","choixEvenement","Type d'événement",$TypeEvenement)->set_required();
		$f->add_select("choixLieu","choixLieu","Lieu",$Lieu)->set_required();

		//règles de validation automatiques
		//$f->dateH->set_validation("date:d-m-Y");
		$f->nom->set_validation("required");
		$f->description->set_validation("required");
		$f->dateH->set_validation("required");
		$f->dateH->set_value("0000-00-00 00:00:00");


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
			$m->nom = $this->req->nom;
			$m->description = $this->req->description;
			$m->dateHeure = $this->req->dateH;
			$m->ppvente = $this->req->prixPVente;
			$m->pvente = $this->req->prixVente;
			$m->typeEvent = $this->req->choixEvenement;
			$m->idlieu = $this->req->choixLieu;
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

		$res = new Evenement();
		$res = EvenementManager::chercherParId($id);
		
		//passe ces informations dans le template
		
		$this->tpl->assign("id",$id);
		$this->tpl->assign("nom",$res->nom);
		$this->tpl->assign("description",$res->description);
		$this->tpl->assign("date",$res->dateHeure);
		$this->tpl->assign("prixPreVente",$res->ppvente);
		$this->tpl->assign("prixVente",$res->pvente);

		/* Récuperation du nom du type de l'évenement à partir de son id */
		$typeEvent = new TypeEvenement();
		$typeEvent = TypeEvenementManager::chercherParId($res->typeEvent);

		$this->tpl->assign("typeEvent",$typeEvent->nomTypeEvenement);
		
		/* Récuperation du nom du lieu de l'évenement à partir de son id */
		$Lieu = new Lieu();
		$Lieu = LieuManager::chercherParId($res->idlieu);

		$this->tpl->assign("Lieu",$Lieu->nomLieu);
		$this->tpl->assign("adresse1",$Lieu->adresse1);
		$this->tpl->assign("adresse2",$Lieu->adresse2);
		$this->tpl->assign("ville",$Lieu->ville);
		$this->tpl->assign("codePostal",$Lieu->codePostal);

		/* Récupération du nom du type de lieu de l'événement à partir de l'id du lieu */
		$typeLieu = new TypeLieu();
		$typeLieu = TypeLieuManager::chercherParId($Lieu->idTypeLieu);

		$this->tpl->assign("typeLieu",$typeLieu->nomTypeLieu);
	}
	
}	
?>
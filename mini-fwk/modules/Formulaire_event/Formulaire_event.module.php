<?php
class Formulaire_event extends Module{

	public function init(){}

	public function action_index(){

		$this->set_title("Formulaire d'inscription");		


		
		//construction d'un formulaire manuellement
		//chaque champ est ajouté par appel de fonction
		$f=new Form("?module=Formulaire_event&action=valide","form1");
			$f->add_text("nom", "nom", "Nom de l'association")->set_required();
			$f->add_textarea("desc", "desc", "Description")->set_required();
			$f->add_text("adr", "adr", "Adresse 1")->set_required();
			$f->add_text("adr2", "adr2", "Adresse 2");
			$f->add_text("ville", "ville", "Ville")->set_required();
			$f->add_text("codepostal", "codepostal", "Code Postal")->set_required();
			$f->add_text("mail","mail","e-M@il")->set_required();	
			$f->add_text("site", "site", "Site Web")->set_required();
			$f->add_text("lienlogo", "lienlogo", "Lien du logo")
			$f->add_text("login","login","Login")->set_required();
			$f->add_password("pass1","pass1","Mot de passe")->set_required();		
			$f->add_password("pass2","pass2","retapez...")->set_required();

		//règles de validation automatiques
		$f->nom->set_validation("required");
		$f->desc->set_validation("required");
		$f->adr->set_validation("required");
		$f->ville->set_validation("required");
		$f->codepostal->set_validation("is_int");	
		$f->mail->set_validation("mail");
		$f->site->set_validation("required");
		$f->login->set_validation("required");
		$f->pass1->set_validation("required");
		$f->pass2->set_validation("equals-field:pass1");	
	


		$f->add_submit("Valider","bntval")->set_value('Valider');		

		//passe le formulaire dans le template sous le nom "form"
		$this->tpl->assign("form",$f);	
		
		//stocke la structure du formulaire dans la session sous le nom "form"
		//pour une éventuelle réutilisation
		$this->session->form = $f;				
	}

	public function action_valide(){

		$this->set_title("Inscription");
		$err=false;
		//on récupère la structure du formulaire précédemment stocké dans la session
		$form=$this->session->form;
		$form->reset_errors();


		//effectue les tests de vérification définis par l'utilisateur
		//si un des tests échoue : false
		$valide = $form->check();
	
	
		//dans cet exemple, on vérifie seulement si le login est vide et s'il n'existe pas dans la base

		if($this->requete->desc == ''){
			$valide=false;
			$form->desc->set_error(true);
			$form->desc->set_error_message("champ vide !");
		}

		if($this->requete->adr == ''){
			$valide=false;
			$form->adr->set_error(true);
			$form->adr->set_error_message("champ vide !");
		}

		if($this->requete->ville == ''){
			$valide=false;
			$form->ville->set_error(true);
			$form->ville->set_error_message("champ vide !");
		}

		if($this->requete->codepostal == ''){
			$valide=false;
			$form->codepostal->set_error(true);
			$form->codepostal->set_error_message("champ vide !");
		}

		if($this->requete->mail == ''){
			$valide=false;
			$form->mail->set_error(true);
			$form->mail->set_error_message("champ vide !");
		}

		if($this->requete->site == ''){
			$valide=false;
			$form->site->set_error(true);
			$form->site->set_error_message("champ vide !");
		}

		if($this->requete->login == ''){
			$valide=false;
			$form->login->set_error(true);
			$form->login->set_error_message("champ vide !");
		}

		if($this->requete->pass1 == ''){
			$valide=false;
			$form->pass1->set_error(true);
			$form->pass1->set_error_message("champ vide !");
		}
	

			
		//Appel à la BD via objet MembreManager
		elseif( AssociationManager::chercherParLogin( $this->requete->login) !== false){
			$valide=false;
			$form->login->set_error(true);
			$form->login->set_error_message("Ce login est déja utilisé !");			
		 }
		
		
		//si un des tests a échoué
		if( $valide==false ){	
		
			$this->site->ajouter_message('contrôle form : remplir les champs (uniquement login dans cet exemple)',ALERTE);			

		
			//on pré-remplit avec les valeurs déjà saisies
			$form->populate();		
			//passe le formulaire dans le template sous le nom "form"
			$this->tpl->assign("form",$form);
		}
		//tous les tests ont été validés
		else{

			//création d'une instance d'Association
			$m=new Association(
				$this->requete->nom,
				$this->requete->desc,
				$this->requete->adr,
				$this->requete->adr2,
				$this->requete->ville,
				$this->requete->codepostal,
				$this->requete->mail,
				$this->requete->site,
				$this->requete->lienlogo,
				$this->requete->login,
				$this->requete->pass1
			);

			//enregistrement (insertion) dans la base
			AssociationManager::creer($m);

			//passe un message pour la page suivante
			$this->site->ajouter_message('Vous êtes enregistré');			

			//redirige vers le module par défaut
			$this->site->redirect('index');
		}
			



	}

}
?>
<?php
class Formulaire_event extends Module{

	public function init(){}

	public function action_index(){

		$this->set_title("Formulaire d'inscription");		


		
		//construction d'un formulaire manuellement
		//chaque champ est ajouté par appel de fonction
		$f=new Form("?module=Formulaire&action=valide","form1");
			$f->add_text("nom", "nom", "Nom")->set_required();
			$f->add_text("prenom", "prenom", "Prénom")->set_required();
			$f->add_text("login","login","Login")->set_required();					
			$f->add_password("pass1","pass1","Mot de passe")->set_required();		
			$f->add_password("pass2","pass2","retapez...")->set_required();	
			$f->add_text("mail","mail","M@il")->set_required();	
			$f->add_text("tel_port", "tel_port", "Téléphone portable");
			$f->add_text("adr", "adr", "Adresse 1")->set_required();
			$f->add_text("adr2", "adr2", "Adresse 2");
			$f->add_text("ville", "ville", "Ville")->set_required();
			$f->add_text("codepostal", "codepostal", "Code Postal")->set_required();


		//règles de validation automatiques
		$f->nom->set_validation("required");
		$f->prenom->set_validation("required");
		$f->login->set_validation("required");
		$f->pass1->set_validation("required");
		$f->pass2->set_validation("equals-field:pass1");
		$f->mail->set_validation("required");
		$f->adr->set_validation("required");
		$f->ville->set_validation("required");
		$f->codepostal->set_validation("required");		
	


		$f->add_submit("Valider","bntval")->set_value('Valider');		

		//exemple de pré-remplissage du formulaire avec des valeurs par défaut
		$f->populate(array("login"=>"Exemple", "rad1"=>"two", "nom"=>"Nom de Famille"));


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

		if($this->requete->login == ''){
			$valide=false;
			$form->login->set_error(true);
			$form->login->set_error_message("champ vide !");
		}
	
		//Appel à la BD via objet MembreManager
		elseif( MembreManager::chercherParLogin( $this->requete->login) !== false){
			$valide=false;
			$form->login->set_error(true);
			$form->login->set_error_message("login existant !");			
		 }
		


		//test upload fichier
		$fichier=$this->requete->file('pj');
		if( $fichier['size'] > 0 ){
			echo "Fichier : <pre>";
			print_r($fichier['name']);
			print_r($fichier['tmp_name']);
			print_r($fichier['type']);						
			echo "</pre>";
		}

		print_r($_REQUEST);


		//autres tests
		//...

		
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

			//création d'une instance de Membre
			$m=new Membre($this->requete->login,$this->requete->nom,$this->requete->pnom,
						$this->requete->mail,
						$this->requete->pass1
						);

			//enregistrement (insertion) dans la base
			MembreManager::creer($m);

			//passe un message pour la page suivante
			$this->site->ajouter_message('L\'utilisateur est enregistré');			

			//redirige vers le module par défaut
			$this->site->redirect('index');
		}
			



	}

}
?>
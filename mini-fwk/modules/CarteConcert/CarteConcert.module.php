<?php
		class CarteConcert extends Module{
			public function action_index() {

		$this->set_title("Concert");

		//création de variables PHP
		//on récupère de la base de données des éléments
		$donne = ConcertManager::chercherParidTypeLieu();
		//passe les variables au template		
		$this->tpl->assign('data',$donne);
			}
		}
?>
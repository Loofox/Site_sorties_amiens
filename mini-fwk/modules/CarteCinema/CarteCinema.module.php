<?php
		class CarteCinema extends Module{
			public function action_index() {

		$this->set_title("Cinema");

		//création de variables PHP
		//on récupère de la base de données des éléments
		$donne = CinemaManager::chercherParidTypeLieu();
		//passe les variables au template		
		$this->tpl->assign('data',$donne);
			}
		}
?>
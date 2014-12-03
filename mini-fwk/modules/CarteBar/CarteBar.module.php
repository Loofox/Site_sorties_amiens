<?php
		class CarteBar extends Module{
			public function action_index() {

		$this->set_title("Bar");

		//création de variables PHP
		//on récupère de la base de données des éléments
		$donne = BarManager::chercherParidTypeLieu();
		//passe les variables au template		
		$this->tpl->assign('data',$donne);
			}
		}
?>
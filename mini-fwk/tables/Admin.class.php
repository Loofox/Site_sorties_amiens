<?php

 class Admin{

		public $idAdmin;
		public $loginAdmin;
		public $passAdmin;
		
		
		public function __construct($idAdmin=NULL, $loginAdmin=NULL, $passAdmin=NULL){
				
			$this->idAdmin=$idAdmin;
			$this->loginAdmin = $loginAdmin;
			$this->passAdmin = $passAdmin;
		}

 }
 ?>
<?php

	App::uses("AppController", "Controller");

	class CategoriesController extends AppController
	{		
		public $uses = array("Category","CommentsToArticle","SiteHit"); 		

		public function isAlive()
		{
			echo "Categories is alive at " . date("d-M-Y h:i:s");
			exit();
		}

		public function index($subCategoryId)
		{
			$this -> log("CategoriesController -> index() -> START:".microtime(true),LOG_DEBUG);
			
			

			$this -> log("CategoriesController -> index() -> END:".microtime(true),LOG_DEBUG);			
		}

	}
?>
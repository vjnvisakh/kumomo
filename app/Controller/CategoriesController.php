<?php

	App::uses("AppController", "Controller");

	class CategoriesController extends AppController
	{		
		public $name = "Categories";
		public $uses = array("Category","CommentsToArticle","SiteHit"); 		

		public function isAlive()
		{
			echo "Categories is alive at " . date("d-M-Y h:i:s");
			exit();
		}

		public function index($subCategoryId)
		{
			$this -> log("CategoriesController -> index() -> START:".microtime(true),LOG_DEBUG);
			$this -> layout = "";
			
			// If the id is empty then redirect to the home page
			if(empty($subCategoryId))
			{
				$this -> redirect
				(
					array
					(
						"controller" => "homes",
						"action" => "index"
					)
				);
			}
			else
			{	
				// This is to fetch the articles for the subcategory
				$sql  = "";
				$sql .= " select a.* from articles_to_categories atc inner join articles a on atc.article_id = a.id and a.status = 'active'";
				$sql .= " and atc.category_id = $subCategoryId";

				$result = $this -> Category -> query($sql);

				// Send the result to the view file
				$this -> set("articles",$result);

				// This is to fetch the ads
				$sql = " SELECT * FROM ads WHERE status = 'active' AND photo <> ''";
				$result = $this -> Category -> query($sql);

				$this -> set("ads",$result);
			}
			
			$this -> log("CategoriesController -> index() -> END:".microtime(true),LOG_DEBUG);			
		}

	}
?>
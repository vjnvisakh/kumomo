<?php

	App::uses("AppController", "Controller");

	class CategoriesController extends AppController
	{		
		public $name = "Categories";
		public $uses = array("Article", "ArticlesToCategory", "Category", "CommentsToArticle", "SiteHit"); 		

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

		//+T
		public function getFeaturedSections()
		{
			$this -> layout = "";
			$categoryQuery = "SELECT count(*), atoc.category_id, c.title
								FROM articles_to_categories atoc
									INNER JOIN categories c ON atoc.category_id = c.id
								WHERE c.status = 'active'
								GROUP BY category_id
								ORDER BY 1 DESC
								LIMIT 4";
			$categoryList = $this -> ArticlesToCategory -> query($categoryQuery);

			//pr($categoryList);

			$featuredSectionList = array();
			$index = 0;

			foreach($categoryList as $category)
			{
				$categoryId = $category["atoc"]["category_id"];

				$featuredSectionList[$index]["category"]["id"] = $categoryId;
				$featuredSectionList[$index]["category"]["title"] = $category["c"]["title"];

				$articleQuery = "SELECT a.id,
										a.title,
										a.content,
										a.photo,
										a.photo_caption
									FROM articles a
										INNER JOIN articles_to_categories atoc ON a.id = atoc.article_id
									WHERE atoc.category_id = $categoryId AND a.status = 'active'
									LIMIT 5";
				$articleList = $this -> Article -> query($articleQuery);

				$featuredSectionList[$index]["articles"] = $articleList;
				$index++;
			}

			//pr($featuredSectionList);
			$this -> set("featuredSectionList", $featuredSectionList);
			$this -> render("/Elements/featured_section");
		}
		//-T
	}
?>
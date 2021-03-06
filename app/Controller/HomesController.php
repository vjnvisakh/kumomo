<?php

	App::uses("AppController", "Controller");

	class HomesController extends AppController
	{
		//+TANUSHREE - KM1#COMMIT#2 - Set the name, uses variables
		public $name = "Homes";
		public $uses = array("Category","CommentsToArticle","SiteHit"); 
		//+TANUSHREE - KM1#COMMIT#2 - Set the name, uses variables

		public function isAlive()
		{
			echo "Homes is alive at " . date("d-M-Y h:i:s");
			exit();
		}

		public function index()
		{
			header('Content-Type: text/html; charset=utf-8');
			$this -> layout = "";

			$this -> hitSite();

			$navbarElements = $this -> getNavbar();    
			$adList = $this -> getAdContentBySpaces();
			$articleList = $this -> getArticlesByCategory();

			$this -> set("navbarElements", $navbarElements);
			$this -> set("adList", $adList);
			$this -> set("articleList", $articleList);			
		}

		/**
		* This action is used to increase the hit counter of the website
		* It basically checks for the no of times the site has opened now
		* @author - Visakh Vijayan
		* @since - 10-Dec-2017
		*
		*/
		public function hitSite()
		{
			$this -> log("HomesController -> hitSite() -> START:".microtime(true),LOG_DEBUG);

			$date = date("Y-m-d");

			$sql  = "";
			$sql .= " SELECT id FROM site_hits WHERE today = '".$date."'";
			$result = $this -> SiteHit -> query($sql);

			if(!empty($result))
			{
				$sql  = "";
				$sql .= " UPDATE site_hits SET hits = hits + 1 WHERE id = ".$result[0]["site_hits"]["id"];
				$this -> SiteHit -> query($sql);
			}
			else
			{
				$siteHit["today"] = $date;
				$siteHit["hits"] = 1;
				$siteHit["created"] = $date;

				$this -> SiteHit -> create();
				$this -> SiteHit -> save($siteHit);
			}

			$this -> log("HomesController -> hitSite() -> END:".microtime(true),LOG_DEBUG);
			return;
		}

		// THIS ACTION IS USED TO VIEW THE ARTICLE
		public function article($articleId)
		{   
			$this -> layout = "article_layout";

			$getArticles  = "";
			$getArticles .= " SELECT * FROM articles WHERE id = $articleId";
			$article = $this -> Article -> query($getArticles);

			$this -> set("ID",$article[0]["articles"]["id"]);
			$this -> set("TITLE",$article[0]["articles"]["title"]);
			$this -> set("CONTENT",$article[0]["articles"]["content"]);
			$this -> set("CREATED",$article[0]["articles"]["created"]);
			$this -> set("PIC",$article[0]["articles"]["photo"]);
		}

		/**
		* This action is used to fetch the related articles for a category and article
		* @param - <id> [The article id]
		* @author - Visakh Vijayan
		* @since - 09-Dec-2017     
		* 
		**/        
		public function fetchRelatedArticles()
		{
			$this -> log("HomesController -> fetchRelatedArticles() -> START:".microtime(true),LOG_DEBUG);
			$requestData = $this -> request -> data;

			if(!empty($requestData))
			{
				$id = $requestData["id"];

				$getCategory  = "";
				$getCategory .= " SELECT category_id FROM articles_to_categories WHERE article_id = $id";
				$categoryId = $this -> Article -> query($getCategory);

				$categoryId = $categoryId[0]["articles_to_categories"]["category_id"];

				// SELECT THE RELATED ARTICLES
				$getArticles  = " SELECT * FROM articles a INNER JOIN articles_to_categories atc";
				$getArticles .= " ON a.id = atc.article_id and atc.category_id = $categoryId";
				$getArticles .= " AND a.id <> $id";

				$articles = $this -> Article -> query($getArticles);

				$articlesArray = [];
				$i = 0;

				$temp = "<div class='row' style='padding:2%'>";

				foreach($articles as $article)
				{                    
					$temp .= "<div class='col-lg-2' style='margin-right:5%'>";
					//$temp .= "<div class='row'>";
					//$temp .= "<img height='140' width='140' src='".$this->webroot."/images/articles/".$article["a"]["photo"]."' />";
					//$temp .= "</div>";
					$temp .= "<div class='row' style='background:#fff;'>";
					$temp .= "<a href='".$this -> webroot."Homes/article/".$article["a"]["id"]."'>";
					$temp .= "<span style='color:#222'>".$article["a"]["title"]."</span>";
					$temp .= "</a>";
					$temp .= "</div>";
					$temp .= "</div>";                    
					$i++;
				}

				$temp .= "</div>";

				echo json_encode($temp);
			}

			$this -> log("HomesController -> fetchRelatedArticles() -> START:".microtime(true),LOG_DEBUG);
			exit();
		}

		/**
		* This action is used to comment on a article
		* @param - <name> [name of the person who has commented]
		* @param - <email> [email of the person who has commented]
		* @param - <articleId> [article id of the article on which the comments are made]
		* @author - Visakh Vijayan
		* @since - 09-Dec-2017     
		*   
		**/
		public function commentOnArticle()
		{
			$this -> log("HomesController -> commentOnArticle() -> START:".microtime(true),LOG_DEBUG);
			$requestData = $this -> request -> data;
			$this -> log($requestData,LOG_DEBUG);

			if(!empty($requestData))
			{
				// Arranging the post data into a model
				$commentArr["name"] = $requestData["name"];
				$commentArr["article_id"] = $requestData["articleId"];
				$commentArr["email"] = $requestData["email"];
				$commentArr["comment"] = $requestData["comment"];
				$commentArr["created"] = date("Y-m-d h:i:s");
				$commentArr["status"] = "active";

				// Saving the data into the table
				$this -> CommentsToArticle -> create();
				$this -> CommentsToArticle -> save($commentArr);
			}
			else
			{

			}

			$this -> log("HomesController -> commentOnArticle() -> START:".microtime(true),LOG_DEBUG);
			exit();
		}

		/**
		* This action is used to fetch all the comments related to an article
		* It takes it according to the date last posted on
		* @param - <articleId> [id of the article for which the comments are required]
		* @author - Visakh Vijayan
		* @since - 09-Dec-2017        
		*
		**/
		public function fetchArticleComments()
		{
			$this -> log("HomesController -> commentOnArticle() -> START:".microtime(true),LOG_DEBUG);
			$requestData = $this -> request -> data;            
			$this -> layout = "";

			if(!empty($requestData))
			{
				$articleId = $requestData["articleId"];

				$comments = $this -> CommentsToArticle -> find
				(
					"all",array
					(
						"conditions" => array
						(
							"article_id" => $articleId,
							"status" => "active"
						),
						"order" => array
						(
							"created" => "desc"
						)
					)
				);

				$this -> set("COMMENTS",$comments);
			}
			else
			{

			}

			$this -> render("/Elements/comment_on_article");
			$this -> log("HomesController -> commentOnArticle() -> END:".microtime(true),LOG_DEBUG);
		}

		/**
		* This action is used to fetch the recent categories
		* It refreshes in real time too 
		* @author - Visakh Vijayan
		* @since - 09-Dec-2017        
		*
		**/
		public function fetchRecentCategories()
		{
			$this -> log("HomesController -> fetchRecentCategories() -> START:".microtime(true),LOG_DEBUG);
			$this -> layout = "";

			$sql  = "SELECT c.id, c.title, count(atc.article_id)
						FROM categories c
							INNER JOIN articles_to_categories atc ON c.id = atc.category_id
						WHERE atc.status = 'active'
						GROUP BY atc.category_id
						ORDER BY 2 DESC
						LIMIT 8";

			$categories = $this -> Article -> query($sql);

			$this -> set("LATEST_CATEGORIES",$categories);
			$this -> render("/Elements/recent_categories");

			$this -> log("HomesController -> fetchRecentCategories() -> END:".microtime(true),LOG_DEBUG);
		}

		/**
		* This action is used to render the carousel structure
		* 
		* @param <limit> [Number of articles to be displayed]
		* @author - Tanushree Chakravarty
		* @since - 09-Dec-2017        
		*
		**/

		public function getArticlesForCarousel()
		{
			$this -> layout = "";

			$limit = (is_numeric($_POST["limit"])) ? $_POST["limit"] : 5;

			$articleList = $this -> fetchLatestArticles($limit);

			$this -> set("articleList", $articleList);

			$this -> render("/Elements/carousel_articles");
		}

		/**
		* This action is used to fetch the articles to be displayed on the carousel
		* 
		* @param <limit> [Number of articles to be displayed]
		* @author - Tanushree Chakravarty
		* @since - 09-Dec-2017        
		*
		**/

		public function fetchLatestArticles($limit = 5)
		{
			$articleQuery = "SELECT *
							FROM articles as Article
							where status = 'active' and photo <> ''
							ORDER BY id DESC
							LIMIT $limit";

			$articleList = $this -> Article -> query($articleQuery);
		
			return $articleList;
		}

		/**
		 * This action is used to show the about us page of the website
		 * @author Visakh Vijayan
		 * @since 02-Jan-2018
		 */
		public function about()
		{
			$this -> log("HomesController -> about() -> START: " . microtime(true), LOG_DEBUG);
			
			// Selecting the layout file
			$this -> layout = "basic";

			$this -> log("HomesController -> about() -> END: " . microtime(true), LOG_DEBUG);
		}

		/**
		 * This action is used to show the editorial board page of the website
		 * @author Visakh Vijayan
		 * @since 02-Jan-2018
		 */
		public function editorialBoard()
		{
			$this -> log("HomesController -> editorialBoard() -> START: " . microtime(true), LOG_DEBUG);
			
			// Selecting the layout file
			$this -> layout = "basic";

			$this -> log("HomesController -> editorialBoard() -> END: " . microtime(true), LOG_DEBUG);
		}

		/**
		 * This action is used to show the editorial page of the website
		 * @author Visakh Vijayan
		 * @since 02-Jan-2018
		 */
		public function editorial()
		{
			$this -> log("HomesController -> editorial() -> START: " . microtime(true), LOG_DEBUG);
			
			// Selecting the layout file
			$this -> layout = "basic";

			$this -> log("HomesController -> editorial() -> END: " . microtime(true), LOG_DEBUG);
		}

		/**
		 * This action is used to show the contact page of the website
		 * @author Visakh Vijayan
		 * @since 02-Jan-2018
		 */
		public function contact()
		{
			$this -> log("HomesController -> contact() -> START: " . microtime(true), LOG_DEBUG);
			
			// Selecting the layout file
			$this -> layout = "basic";

			$this -> log("HomesController -> contact() -> END: " . microtime(true), LOG_DEBUG);
		}
	}

?>